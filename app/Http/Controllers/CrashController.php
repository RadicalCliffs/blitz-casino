<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redis;
use Auth;
use App\User;
use App\Crash;
use DB;
use App\Setting;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class CrashController extends Controller
{
   public function __construct()
   {
    parent::__construct();
    $this->redis = Redis::connection();
}

public function boom(Request $request) {

    $user = Auth::user();
    if(!$user){
       return response(['error'=>'Please log in']);
   }

   if(Setting::first()->crash_status != 3)  return response(['error'=>'Game has ended or started']);

   $client = new Client(new Version2X('https://localhost:2083', [
    'headers' => [
        'X-My-Header: websocket rocks',
        'Authorization: Bearer 12b3c4d5e6f7g8h9i'
    ],
    'context' => ['ssl' => ['verify_peer_name' =>false, 'verify_peer' => false]]
]));

   $client->initialize();
   $client->emit('boomCrash', ['boom' => '1']);
   $client->close();

   return response(['success' => true, 'mess' => 'Success' ]);

}

public function winner(Request $request) {
    $color = $request->coeff;

    $set = Setting::first();


    if ($color < 1 or $color > 1000) {
        return response(['success' => false, 'mess' => 'From 1 to 1000']);
    }

    if ($set->crash_status == 0) {
        $set->crash_boom = $color;
        $set->save();
        return response(['success' => true, 'mess' => 'Adjustment to ' . $color]);
    } else {
        return response(['success' => false, 'mess' => 'Round in progress, cannot adjust']);
    }
}


public function bet(Request $request){


    $user = Auth::user();
    $set = Setting::first();
    $bet = $request->bet;
    $auto = $request->auto;

    if(!$user) return response(['error'=>'Please log in']);

    if($user->admin != 1){ 
        // return response(['error'=>'Technical maintenance']);
    }

    

    if(Setting::first()->crash_status)  return response(['error'=>'Game has ended or started']);
    if($bet < 1) return response(['error'=>'Minimum bet amount is 1']);
    if($bet > 10000) return response(['error'=>'Maximum bet amount is 10000']);
    if($auto < 1.1) return response(['error'=>'Auto withdraw from 1.1']);

    $userBalance = $user->type_balance == 0 ? $user->balance : $user->demo_balance;

    if($userBalance < $bet) return response(['error'=>'Insufficient funds']);
    if(Crash::where(['user_id'=>$user->id])->count() >= 1) return response(['error'=>'Maximum 1 bet per round']);



    if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

    $hist_balance = array(
        'user_id' => $user->id,
        'type' => 'Bet in Crash',
        'balance_before' => $userBalance,
        'balance_after' => $userBalance - $bet,
        'date' => date('d.m.Y H:i:s')
    );

    $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

    $cashe_hist_user = json_decode($cashe_hist_user);
    $cashe_hist_user[] = $hist_balance;
    $cashe_hist_user = json_encode($cashe_hist_user);
    \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);

    $lastbalance = $userBalance;
    $newbalance = $userBalance - $bet;

    // $user->balance -= $bet;
    $user->type_balance == 0 ? $user->balance -= $bet : $user->demo_balance -= $bet;
    $user->sum_bet += $bet;
    $user->save();
    if ($user->type_balance == 1){
        $set->youtube_crash = 1;
    }else{
        $set->crash_bank += ($bet * 0.9);
        $set->crash_profit += ($bet * 0.1);
    }

    if($set->crash_bank < 0){
        $set->crash_bank = 150;
    }
    $set->save();




    $zal = Crash::create([
        'user_id'=>$user->id,
        'bet'=>$bet,
        'img'=>$user->avatar,
        'login'=>$user->name,
        'auto'=>$auto,
        'win' => $auto * $bet
    ]);

    $callback = [
        'id'=>$zal->id,
        'bet'=>$bet,
        'img'=>$user->avatar,
        'login'=>$user->name,
    ];
    $this->redis->publish('crashBet', json_encode($callback));
    return response(['success'=>'Bet accepted', 'lastbalance' => $lastbalance, 'newbalance' => $newbalance]);
}


public function winCrash(){
    $setting = Setting::first();


    $crash = Crash::all();


    foreach ($crash as $k) {

        $bet = $k->bet;
        $result = $k->result;
        $user_id = $k->user_id;

        $user = User::where('id', $user_id)->first();


        if($result == 0){
            $user->sum_to_withdraw -= $bet;
            $user->lose_games += 1;
            $user->save();
        }else{

            $winUser = $result * $bet;

            $text_win = 'Win in Crash - x'.$result;

            $win = $winUser;

            $userBalance = $user->type_balance == 0 ? $user->balance : $user->demo_balance;

            if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

            $hist_balance = array(
                'user_id' => $user->id,
                'type' => $text_win,
                'balance_before' => $userBalance,
                'balance_after' => $userBalance + $win,
                'date' => date('d.m.Y H:i:s')
            );

            $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

            $cashe_hist_user = json_decode($cashe_hist_user);
            $cashe_hist_user[] = $hist_balance;
            $cashe_hist_user = json_encode($cashe_hist_user);
            \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);

            $user->win_games += 1;

            $sumW = $winUser - $bet;
            $user->sum_to_withdraw -= $sumW;

            $user->sum_win += $win;
            if($user->max_win < $win ){
                $user->max_win = $win;
            }

            // $callback = ['user_id' => $user->id, 'lastbalance' => $userBalance, 'newbalance' => $userBalance + $win];

            // $user->type_balance == 0 ? $user->balance += $win : $user->demo_balance += $win;
            $user->save();  

            // $this->redis->publish('updateBalance', json_encode($callback)); 




        }
    }

    return true;
}

public function give(Request $request){
    //return response(['error' => 'An unknown error occurred. Refresh the page']);
    $user = Auth::user();
    if(!$user){
       return response(['error'=>'Please log in']);
   }

   if(Setting::first()->crash_status != 3)  return response(['error'=>'Game has ended or started']);

   $my_crash_c = Crash::where('user_id', $user->id)->count();
   if($my_crash_c == 0){
    return response(['error'=>'You have no active bet']);
}

$my_crash = Crash::where('user_id', $user->id)->first();
if ($my_crash->result != 0){
    return response(['error'=>'You have already cashed out']);
}

$id_game = $my_crash->id;


$client = new Client(new Version2X('https://localhost:2083', [
    'headers' => [
        'X-My-Header: websocket rocks',
        'Authorization: Bearer 12b3c4d5e6f7g8h9i'
    ],
    'context' => ['ssl' => ['verify_peer_name' =>false, 'verify_peer' => false]]
]));

$client->initialize();
$client->emit('giveCrash', [
    'gameId' => $id_game
]);
$client->close();

    // $set = Setting::first();



    // $crash_result = Setting::first()->crash_result;
    // $bet = $my_crash->bet;
    // $res = $bet * $crash_result;
    // $game = $my_crash->id;

    // $set->crash_bank -= $res;
    // $set->save();

    // $callback = [
    //     'id'=>$game,
    //     'win'=>$res,
    // ];

    // $this->redis->publish('crashGive', json_encode($callback));


    // Crash::where('user_id', $user->id)->update(['result' => $res]);


return response(['success'=>'Cashing out...']);


}

public function get(){
    $history = Crash::get();
    $last = DB::table('crash_history')->orderBy('id','desc')->take(7)->get();
    $status = Setting::first()->crash_status;

    $user = Auth::user();
    $give = 0;
    $bet = 1;
    $auto = 2;
    if($user){
        $my_crash = Crash::where('user_id', $user->id)->first();
        $my_crash_c = Crash::where('user_id', $user->id)->count();
        if ($my_crash_c > 0){
            $bet = $my_crash->bet;
            $auto = $my_crash->auto;
            if($status != 0 and $my_crash->result == 0){
                $give = 1;
            }else{
                $give = 2;
            }
        }
    }
    return response(['success'=>true,'history'=>$history,'last'=>$last, 'auto' => $auto, 'status' => $status, 'give' => $give, 'bet' => $bet]);
}

}
