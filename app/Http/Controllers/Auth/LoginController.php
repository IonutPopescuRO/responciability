<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
	 
    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
	
    public function handleProviderCallbackFacebook()
    {
        $user = Socialite::driver('facebook')->user();

        // $user->token;
    }
	 
    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
	
    public function handleProviderCallbackGoogle()
    {
        $user = Socialite::driver('google')->user();

        // $user->token;
    }
	 
    public function redirectToProviderTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }
	
    public function handleProviderCallbackTwitter()
    {
        $user = Socialite::driver('twitter')->user();

        // $user->token;
    }
	 
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $creds=$request->only($this->username(), 'password');
        $creds['accepted']= 1;
        return $creds;
    }

}
