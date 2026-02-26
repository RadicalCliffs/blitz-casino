<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function google_index()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $user = Socialite::driver('google')->user();
        $objSocial = new \App\Service\SocialService(); 
        if ($user = $objSocial->saveSocialData($user, 'https://google.com/', 'google')) {
            \Auth::login($user);
            return redirect('/');
        }

        return back(400);
    }
}
