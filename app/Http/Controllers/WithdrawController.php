<?php

namespace App\Http\Controllers;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use App\SystemWithdraw;
use App\User;
use App\Payment;
use App\Setting;
use App\Withdraw;
use Illuminate\Support\Facades\Redis;

class WithdrawController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->redis = Redis::connection();
        $this->setting = Setting::first();
    }

    public function go(Request $r){
        //return response(['error' => '???and????? ??and?in???on? Error. ????inand?? ?????and??']);
        $sum = $r->sum;
        $wallet = $r->wallet;
        $system = $r->system;


        if(!is_numeric($sum)){
            return response(['success' => false, 'mess' => 'inin??and?? ????????? ????? in?in?Yes']);
        }

        if(\Auth::guest()){return response(['success' => false, 'mess' => '?in???and???????' ]);}

        $user = \Auth::user();

        if($wallet == ''){
            return response(['success' => false, 'mess' => 'inin??and?? ????????? ????? ????????']);
        }

        if($user->type_balance == 1){
            return response(['success' => false, 'mess' => '????????and???? on ???????? Balance']);
        }

        if($user->sum_to_withdraw > 0){
            return response(['success' => false, 'mess' => 'From??????? ??? '.$user->sum_to_withdraw]);
        }

        $countSystemWithdraw = SystemWithdraw::where('id', $system)->count();
        if($countSystemWithdraw == 0){
            return response(['success' => false, 'mess' => '????and?? ?and????? in?in?Yes']);
        }

        if (\Cache::has('action.user.' . $user->id)) return response(['success' => false, 'mess' => '??to??and?? 2 ???.']);
        \Cache::put('action.user.' . $user->id, '', 2);

        $systemWithdraw = SystemWithdraw::where('id', $system)->first();
        $minWithdraw = $systemWithdraw->min_sum;
        $nameWithdraw = $systemWithdraw->name;
        $comm_percent = $systemWithdraw->comm_percent;
        $comm_rub = $systemWithdraw->comm_rub;
        $img = $systemWithdraw->img;

        if($nameWithdraw == 'Qiwi'){ 
            $first_n = ['7', '+', '3'];
             if (!in_array($wallet[0], $first_n)){ 
                return response(['success' => false, 'mess' => 'inin??and?? ????????? ????? ????????']);
            }
        }
        if($sum < $minWithdraw){
            return response(['success' => false, 'mess' => '?and?and????on Sum in?in?Yes '.$minWithdraw]);
        }

        if($sum > (in_array($user->status, [0, 1]) ? 300 : ($user->status == 2 ? 500 : ($user->status == 3 ? 600 : ($user->status == 4 ? 750 : ($user->status == 5 ? 1000 : 2000))))) and $user->bonus_up == 1){
            return response(['success' => false, 'mess' => '????and????on? Sum in?in?Yes ? Bonus? '.(in_array($user->status, [0, 1]) ? 300 : ($user->status == 2 ? 500 : ($user->status == 3 ? 600 : ($user->status == 4 ? 750 : ($user->status == 5 ? 1000 : 2000))))).'?']);
        }

        if($user->balance < $sum){
            return response(['success' => false, 'mess' => '??to???????? ??????in']);
        }

        $setting = Setting::first();
        $dep_withdraw = $setting->dep_withdraw;

        $user_deps = Payment::where('status', 1)->where('user_id', $user->id)->whereDate('created_at', '>', Carbon::now()->subDays(7))->sum('sum');

        if($user_deps < $dep_withdraw && $user->admin != 3){
            return response(['success' => false, 'mess' => '??? in?in?Yes ????????? ?and?and????on? Sum ????????and? for 7 ???? - 100. (? in?? '.$user_deps.'?)']);
        }

        $count_w = Withdraw::where('status', 0)->where('user_id', $user->id)->count();
        if($count_w > 0){
            return response(['success' => false, 'mess' => '? in?? ???? Withdrawal? in ?????From??']);
        }


        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }


        $hist_balance = array(
            'user_id' => $user->id,
            'type' => '???in?? on Withdrawal',
            'balance_before' => $user->balance,
            'balance_after' => $user->balance - $sum,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);


        $lastbalance = $user->balance;
        $newbalance = $lastbalance - $sum;
        if($newbalance < 1){
            $user->bonus_up = 0;
        }
        $user->balance -= $sum;
        if($user->sum_to_withdraw < 0){
            $user->sum_to_withdraw = 0;
        }
        $user->save();

        


        $id_user = $user->id;
        $mult = 0;

        // $wallets_user = [];
        // $wallets = Withdraw::where('user_id', $id_user)->get();
        // foreach ($wallets as $w) {
        //     $wallets_user[] = $w->wallet;
        // }
        // $wallets_user = array_unique($wallets_user);


        // $mults_wallet = [];
        // $wallets_other = Withdraw::whereIn('wallet', $wallets_user)->where('user_id', '!=', $id_user)->get();
        // foreach ($wallets_other as $wallet_other) {
        //     $mults_wallet[] = $wallet_other->user_id;
            
        // }

        // $mults_new_wallet = array_unique($mults_wallet);
        // $user_mult_wallet = count($mults_new_wallet);

        // if($user_mult_wallet > 0){
        //     $mult = 1;
        // }     

        

        $withdraw = Withdraw::create(array(
            'user_id' => $user->id,
            'login' => $user->name,
            'avatar' => $user->avatar,
            'ps' => $nameWithdraw,
            'wallet' => $wallet,
            'mult' => $mult,
            'sum' => ($sum - ($sum * ($comm_percent / 100))) - $comm_rub,
            'sum_full' => $sum,
            'date' => date('d.m.Y H:i'),
            'status' => 0,
            'img_system' => $img
        ));

        return response(['success' => true, 'lastbalance' => $lastbalance, 'newbalance' => $newbalance, 'withdraw' => $withdraw]);


    }

    public function cansel(Request $r){
        $id = $r->id;
        if(\Auth::guest()){return response(['success' => false, 'mess' => '?in???and???????' ]);}

        $user = \Auth::user();

        $count_w = Withdraw::where('id', $id)->count();
        if($count_w == 0){
            return response(['success' => false, 'mess' => '? in?? ???? Withdrawal? in ?????From??']);
        }

        $info = Withdraw::where('id', $id)->first();
        $user_id = $info->user_id;
        if($user_id != $user->id){
            return response(['success' => false, 'mess' => 'Error']);
        }
        if(in_array($info->status, [3,4,5])){
             return response(['success' => false, 'mess' => 'in?? Withdrawal From???in??????. From???and?? ??????']);
        }
        if($info->status != 0){
             return response(['success' => false, 'mess' => 'Error']);
        }
        
        if (\Cache::has('action.user.' . $user->id)) return response(['success' => false, 'mess' => '??to??and?? 2 ???.']);
        \Cache::put('action.user.' . $user->id, '', 2);

 $sum_full = $info->sum_full;
        if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }


        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Cancel in?in?Yes',
            'balance_before' => $user->balance,
            'balance_after' => $user->balance + $sum_full,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);


       
        $lastbalance = $user->balance;
        $newbalance = $lastbalance + $sum_full;
        $user->balance += $sum_full;
        $user->save();

        $info->status = 2;
        $info->save();

        return response(['success' => true, 'lastbalance' => $lastbalance, 'newbalance' => $newbalance]);
    }

    public function withdrawRub(Request $r) {
        $status = 0;

        switch($r->status) {
            case 1:
                $status = 3;
            break;

            case 22:
                $status = 4;
            break;

            case 2:
                $status = 1;
            break;

            case 3:
                $status = 5;
            break;
        }

        Withdraw::where('id', $r->order_id)->update(['status' => $status]);

        return 'OK';
    }
}
