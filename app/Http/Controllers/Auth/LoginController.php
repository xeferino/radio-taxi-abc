<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
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
    protected $redirectTo = RouteServiceProvider::HOME;


    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('rut', 'password');
        $user = User::where('rut', $request->rut)->first();
        if($user){
            if (Auth::attempt($credentials)) {
                return response()->json(['success' => true, 'url' => 'company'], 200);
                /* session()->flash("connect","login successfully");
                redirect('company'); */
            }else{
                return response()->json(['error' => 'invalid'], 200);
            }
        }else{
            return response()->json(['error' => 'user'], 200);
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flash("credencials","logout successfull");
        session()->flash("label","success");
        return redirect()->intended('login');
    }

}
