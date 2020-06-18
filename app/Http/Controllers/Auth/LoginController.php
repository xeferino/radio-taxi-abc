<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     *
     * @version 1.0
     *
     * @author Jose Lozada <josegregoriolozadae@gmail.com>
     * @copyright josegregoriolozadae@gmail.com
     *
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('rut', $request->rut)->where('password', $request->password)->first();
        if ($user) {
            Auth::login($user);
            return response()->json(['success' => true, 'url' => 'company'], 200);
        } else {
            return response()->json(['error' => 'invalid'], 200);
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flash("credencials", "logout successfull");
        session()->flash("label", "success");
        return redirect()->intended('login');
    }

}
