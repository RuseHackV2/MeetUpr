<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Guard;
use Socialite;
use App\User;

class AuthController extends Controller
{
    private $auth;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
        
    }

    public function sendRequest() {
        return Socialite::driver('facebook')->redirect();
    }

    public function requestCallback() {
        $fbUser = Socialite::driver('facebook')->user();
        $userId = \DB::table('users')->where('facebook_id', $fbUser->id)->select('id')->get();

        if(!empty($userId)) {
            $user = User::find($userId[0]->id);
            $this->auth->login($user, true);
        }
        else {
            $user = new User();
            $user->name = $fbUser->name;
            $user->email = $fbUser->email;
            $user->avatar = $fbUser->avatar;
            $user->facebook_id = $fbUser->id;
            $user->facebook_token = $fbUser->token;
            $user->save();

            $this->auth->login($user, true);
        }

        return redirect('/home');
    }

    public  function testAuth()
    {
        $user = User::find(2);
        $this->auth->login($user, true);
        return redirect('/home');
    }

    public  function testAuth1()
    {
        $user = User::find(5);
        $this->auth->login($user, true);
        return redirect('/home');
    }

    public function logout()
    {
        $this->auth->logout();
        return redirect('/home');
    }
}
