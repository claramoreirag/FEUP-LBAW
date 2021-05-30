<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect;
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
    protected $redirectTo = '/authuserfeed';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getUser(){
        return $request->user();
    }

    public function home() {
        return route('authuserfeed');
    }


    protected function authenticated(Request $request, $user)
    {
        if($user->isAdmin()) {
            return redirect()->intended('/admin/reports');
        } 
        else {
            if($user->state()=="Active"){
                return redirect()->intended('/authuserfeed');
            }
            else if($user->state()=="Suspended"){
                return redirect()->intended('/login/suspended');
            }
            else{
                return redirect()->intended('/login/banned');
            }
        }
    }

}
