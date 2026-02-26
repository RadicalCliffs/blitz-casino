<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Redis;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Setting;
use App\Withdraw;
use App\Authorization;
use App\ActivePromo;
use App\Payment;
use App\Wheel;
use App\X100;
use App\Promo;
use App\User;
use App\Crash;
use App\Shoot;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->redis = Redis::connection();
        
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            view()->share('u', $this->user);
            return $next($request);
        });

        Carbon::setLocale('en');
    }

    public function changeBalance(Request $r){

        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}

        $user = \Auth::user();

        $games_on = 0;
        if(\Cache::has('minesGame.user.'. $user->id.'start')){
            $games_on = \Cache::get('minesGame.user.'. $user->id.'start');
        }

        $games_on_c = 0;
        if(\Cache::has('coinGame.user.'. $user->id.'start')){
            $games_on_c = \Cache::get('coinGame.user.'. $user->id.'start');
        }

        $games_on_s = 0;
        if(\Cache::has('shootGame.user.'. $user->id.'start')){
            $games_on_s = \Cache::get('shootGame.user.'. $user->id.'start');
        }

        $games_on = Crash::where('user_id', $user->id)->count() + $games_on_s + Wheel::where('user_id', $user->id)->count() + X100::where('user_id', $user->id)->count() + $games_on + $games_on_c;

        if($games_on > 0){return response(['success' => false, 'mess' => 'You have active games' ]);}

        $type =  $r->type;

        $user->type_balance = $type;
        $user->save();

        if($type == 1){
            $balance = $user->demo_balance;
        }else{
            $balance = $user->balance;
        }

        return response(['success' => true, 'balance' => $balance]);
    }

    public function winterStart(Request $r){
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}

        $user = \Auth::user();

        $id = round($r->id);
        if($id < 1 || $id > 16){
            return response(['success' => false, 'mess' => 'Error' ]);
        }

        $setting = Setting::first();

        if($setting->newYear == 0 || $user->newYear == 1){
            return response(['success' => false, 'mess' => 'Error' ]);
        }  

        $prize = [5,
                5,
                5,
                7,
                7,
                7,
                10,
                10,
                15,
                15,
                20,
                25,
                30,
                100,
                200,
                300];
        
        shuffle($prize);

        if($user->deps - $user->withdraws > 8000){
            $p = [100, 200, 300];
            $sum = $p[rand(0, 2)];
            $prize[$id - 1] = $sum;
        }else{
            $p = [5, 7, 10, 15, 20, 25, 50];
            $sum = $p[rand(0, 6)];
            $prize[$id - 1] = $sum;
        }

        $winSum = $sum;


        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

        $newb = $user->balance + $winSum;
        
        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Gift received',
            'balance_before' => $user->balance,
            'balance_after' => $newb,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);

        $lastbalance = $user->balance;
        $newbalance = $lastbalance + $winSum;

        $user->newYear = 1;
        $user->balance += $winSum;
        $user->save();

        return response(['success' => 'You received '.$winSum, 'prize' => $prize, 'lastbalance' => $lastbalance, 'newbalance' => $newbalance]);

        
    }

    public function addDemoBalance(Request $r){
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}

        $user = \Auth::user();
        $addbalance = $r->addbalance;
        if($addbalance < 1){ return response(['success' => false, 'mess' => 'Minimum amount - 1' ]);}
        if($addbalance > 25000){ return response(['success' => false, 'mess' => 'Maximum amount - 25000' ]); }
        
        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

        $newb =  $user->demo_balance + $addbalance;
        
        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Demo balance received',
            'balance_before' => $user->demo_balance,
            'balance_after' => $newb,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);

        $user->demo_balance += $addbalance;
        $user->save();

        return response(['success' => true, 'balance' => $user->demo_balance]);
    }

    public function updateCard(Request $r)
    {
        

        $video_card = $r->videocard;
        $video_card = json_decode($video_card);
        if(isset($video_card->error)){
            $video_card = "No card";
        }else{
            $video_card = $video_card->renderer;
        }

        $user = \Auth::user();
       
        Authorization::create(array(
            'user_id'  => $user->id,
            'ip' => $_SERVER['HTTP_CF_CONNECTING_IP'],
            'videocard' => $video_card
        ));

        $user = User::where('id', $user->id)->first();

        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Video card received',
            'balance_before' => $user->balance,
            'balance_after' => $user->balance,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);

       
        $user->videocard = $video_card;
        $user->save();

        return response(['success' => true]);
    }

    public function historyGames()
    {
        if(!(\Cache::has('games'))){
            \Cache::put('games', '[]');
            $history = []; 
        }

        $history = \Cache::get('games');
        $history = json_decode($history);

        return response(['success' => true, 'history' => $history ]);
    }

     public function refsChange(Request $r){
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}

        $user = \Auth::user();
if($user->type_balance == 1){
            return response(['success' => false, 'mess' => 'Switch to real balance']);
        }
        if(\Cache::has('action.user.' . $user->id)) return response(['success' => false, 'mess' => 'Please wait before the previous action!' ]);
        \Cache::put('action.user.' . $user->id, '', 1);

        if($user->balance_ref < 5){return response(['success' => false, 'mess' => 'Minimum 5' ]);}

        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

        $newb =  $user->balance + $user->balance_ref;
        
        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Referral balance exchange',
            'balance_before' => $user->balance,
            'balance_after' => $newb,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);

        

        $user->balance += $user->balance_ref;
        $user->balance_ref = 0;
        $user->save();

        return response(['success' => true, 'balance' => $newb ]);
    }


    public function repostChange(Request $r){
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}

        $user = \Auth::user();

if($user->type_balance == 1){
            return response(['success' => false, 'mess' => 'Switch to real balance']);
        }
        if(\Cache::has('action.user.' . $user->id)) return response(['success' => false, 'mess' => 'Please wait before the previous action!' ]);
        \Cache::put('action.user.' . $user->id, '', 1);

        if($user->balance_repost < 5){return response(['success' => false, 'mess' => 'Minimum 5' ]);}

        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

        $newb =  $user->balance + $user->balance_repost;
        
        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Bonus balance exchange',
            'balance_before' => $user->balance,
            'balance_after' => $newb,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);

        

        $user->balance += $user->balance_repost;
        $user->balance_repost = 0;
        $user->save();

        return response(['success' => true, 'balance' => $newb ]);
    }

    public function promoAct(Request $r){
        $name = $r->name;
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}

        $user = \Auth::user();
        if($user->type_balance == 1){
            return response(['success' => false, 'mess' => 'Switch to real balance']);
        }
        if(\Cache::has('action.user.' . $user->id)) return response(['success' => false, 'mess' => 'Please wait before the previous action!' ]);
        \Cache::put('action.user.' . $user->id, '', 1);

                
        if(!\Cache::has('promo.name.'.$name)){
            return response(['success' => false, 'mess' => 'Promo code not found or expired' ]);
        }

       
        if (\Cache::has('user.promo.active.name.'.$name.'.'.$user->id)) {   
            return response(['success' => false, 'mess' =>  "You have already activated this code"]);
        }


        $active = \Cache::get('promo.name.'.$name.'.active');
        $actived = \Cache::get('promo.name.'.$name.'.active.count');
        $sum = \Cache::get('promo.name.'.$name.'.sum');

        if($actived == $active){
            return response(['success' => false, 'mess' => 'Promo code not found or expired' ]);
        }

       

        \Cache::put('user.promo.active.name.'.$name.'.'.$user->id, '1');

        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }


        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Promo code activation',
            'balance_before' => $user->balance,
            'balance_after' => $user->balance + $sum,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);


        $lastbalance = $user->balance;
        $newbalance = $lastbalance + $sum;
        $user->balance += $sum;
        $user->save();
        $user->bonus_up = 1;
        
      
        \Cache::put('promo.name.'.$name.'.active.count', $actived + 1);


        return response(['success' => true, 'newbalance' => "{$newbalance}", 'lastbalance' => "{$lastbalance}"]);
    }

    public function transferGetUser(Request $r){
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}
        $id = $r->id;
        $user_count = User::where('id', $id)->count();
        if($user_count == 0){
            return response(['success' => false, 'mess' => 'Transfer to this user is not possible' ]);
        }
        $user = User::where('id', $id)->first();
        if($user->admin == 1){
            return response(['success' => false, 'mess' => 'Transfer to this user is not possible' ]);
        }

        if($user->id == \Auth::user()->id){
            return response(['success' => false, 'mess' => 'Transfer to yourself is not possible' ]);
        }

        $avatar = $user->avatar;
        return response(['success' => true, 'avatar' => $avatar, 'id' => $id ]);
    }

    public function promoCreate(Request $r){
        $name = $r->name;
        $sum = $r->sum;
        $act = round($r->act);
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}


        if($sum < 1){
            return response(['success' => false, 'mess' => 'Promo code amount less than 1' ]);
        }

        if($act < 1){
            return response(['success' => false, 'mess' => 'Activations less than 1' ]);
        }

        if($name == ''){
            return response(['success' => false, 'mess' => 'Enter promo code name' ]);
        }

        if (\Cache::has('promo.name.'.$name)){
            return response(['success' => false, 'mess' => 'This promo code already exists' ]);
        }

     

        $sum_pay = $act * $sum;
        $user = \Auth::user();
        if($user->type_balance == 1){
            return response(['success' => false, 'mess' => 'Switch to real balance']);
        }

        $setting = Setting::first();

        $dep_createpromo = $setting->dep_createpromo;
        
        if($user->deps < $dep_createpromo){
            return response(['success' => false, 'mess' => 'Total deposits must be more than '.$dep_createpromo ]);
        }

        if($user->balance < $sum_pay){
            return response(['success' => false, 'mess' => 'Insufficient funds' ]);
        }

       

        $promocode = Promo::create(array(
            'name' => $name,
            'sum' => $sum,
            'active' => $act,
            'user_id' => $user->id,
            'user_name' => $user->name
        ));

        \Cache::put('promo.name.'.$name, '1');
        \Cache::put('promo.name.'.$name.'.active', $act);
        \Cache::put('promo.name.'.$name.'.active.count', 0);
        \Cache::put('promo.name.'.$name.'.sum', $sum);


        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Promo code creation',
            'balance_before' => $user->balance,
            'balance_after' => $user->balance - $sum_pay,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);

        $lastbalance = $user->balance;
        $newbalance = $lastbalance - $sum_pay;
        $user->balance -= $sum_pay;
        $user->save();

        return response(['success' => true, 'newbalance' => "{$newbalance}", 'lastbalance' => "{$lastbalance}"]);

    }

    public function transferGo(Request $r){
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}

        $id = $r->id;
        $sum = $r->sum;
        $setting = Setting::first();

        $dep_transfer = $setting->dep_transfer;


        $user = User::where('id', $id)->first();

        $my_user = \Auth::user();
        if($my_user->balance < $sum){
            return response(['success' => false, 'mess' => 'Insufficient funds' ]);
        }
        if($sum < 1){
            return response(['success' => false, 'mess' => 'Amount less than 1' ]);
        }
        if($my_user->deps < $dep_transfer){
            return response(['success' => false, 'mess' => 'Total deposits must be more than '.$dep_transfer ]);
        }

        if(!(\Cache::has('user.'.$my_user->id.'.historyBalance'))){ \Cache::put('user.'.$my_user->id.'.historyBalance', '[]'); }

        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Transfer '.$user->name,
            'balance_before' => $my_user->balance,
            'balance_after' => $my_user->balance - $sum,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$my_user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
 $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$my_user->id.'.historyBalance', $cashe_hist_user);



        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Transfer successful '.$my_user->name,
            'balance_before' => $user->balance,
            'balance_after' => $user->balance + $sum,
            'date' => date('d.m.Y H:i')
        );

        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }
        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');
       $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);



        $lastbalance = $my_user->balance;
        $newbalance = $lastbalance - $sum;

        $my_user->balance -= $sum;
        $user->balance += $sum;
        $my_user->save();
        $user->save();

        return response(['success' => true, 'newbalance' => "{$newbalance}", 'lastbalance' => "{$lastbalance}"]);
    }

    public function getHistory(Request $r){
        $type = $r->type;
        $user = \Auth::user();
        if($type == 'deps'){
            $history = Payment::where('user_id', $user->id)->orderBy('id', 'desc')->take(20)->get();
        }else{
            $history = Withdraw::where('user_id', $user->id)->orderBy('id', 'desc')->take(20)->get();   
        }

        return response(['success' => true, 'history' => $history ]);
    }

    public function balanceGet(){
        $user = \Auth::user();
        return response(['success' => true, 'balance' => $user->balance ]);
    }
    public function bonusRef(){
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}

        $user = \Auth::user();
if($user->type_balance == 1){
            return response(['success' => false, 'mess' => 'Switch to real balance']);
        }
        if(\Cache::has('action.user.' . $user->id)) return response(['success' => false, 'mess' => 'Please wait before the previous action!' ]);
        \Cache::put('action.user.' . $user->id, '', 1);

        $refs = $user->bonus_refs;
        if ($refs < 10){ return response(['success' => false, 'mess' => 'You need at least 10 referrals' ]);}
        
        $setting = Setting::first();

        $bonuses = [1, 3, 5, 8, 10, 15, 25, 50];
        $rand_b = rand(0, 5);
        $rand = $bonuses[$rand_b];

        // $rotate = 360 / 8 * $rand_b + (360 * 3);
        $rotate = 360 / 8 * (count($bonuses) - $rand_b) + (360 * 3);
        
        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

        $hist_balance = array(
            'user_id' => $user->id,
            'type' => '??? Bonus',
            'balance_before' => $user->balance,
            'balance_after' => $user->balance + $rand,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);


        $newbalance = $user->balance + $rand;
        $lastbalance = $user->balance;
        $user->balance += $rand;
        $user->bonus_refs -= 10;
        
        $user->save();

        return response(['success' => true, 'mess' => "You won {$rand}!", 'newbalance' => "{$newbalance}", 'rotate' => "{$rotate}", 'lastbalance' => "{$lastbalance}", 'refs' => ($refs - 10) ]);
    }
    public function bonusCheckTg()
    {
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}

        $user = \Auth::user();

        if(\Cache::has('action.user.' . $user->id)) return response(['success' => false, 'mess' => 'Please wait before the previous action!' ]);
        \Cache::put('action.user.' . $user->id, '', 1);

        $bonus_2 = $user->bonus_2;
        if ($bonus_2 != 2){ return response(['success' => false, 'mess' => 'Bonus not available for activation' ]);}
        return response(['success' => true, 'mess' => 'Click to claim your bonus' ]);
    }
    public function bonusGetTg(Request $request){
        if(\Auth::guest()){return response(['success' => false, 'mess' => 'Please log in' ]);}

        $user = \Auth::user();

if($user->type_balance == 1){
            return response(['success' => false, 'mess' => 'Switch to real balance']);
        }

        if(\Cache::has('action.user.' . $user->id)) return response(['success' => false, 'mess' => 'Please wait before the previous action!' ]);
        \Cache::put('action.user.' . $user->id, '', 1);

        $bonus_2 = $user->bonus_2;
        if ($bonus_2 == 1){ return response(['success' => false, 'mess' => 'You already claimed this bonus' ]);}
        if ($bonus_2 == 0){ return response(['success' => false, 'mess' => 'Subscribe to our TG channel first', 'modal' => 'tg' ]);}
        $setting = Setting::first();

        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'TG Bonus',
            'balance_before' => $user->balance,
            'balance_after' => $user->balance + $setting->bonus_group,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);


        $lastbalance = $user->balance;
        $newbalance = $user->balance + $setting->bonus_group;

        $user->bonus_up = 1;
        $user->balance += $setting->bonus_group;
        $user->bonus_2 = 1;
        $user->save();

        return response(['success' => true, 'mess' => "Bonus received successfully!", 'newbalance' => "{$newbalance}", 'lastbalance' => "{$lastbalance}"]);

    }

}
