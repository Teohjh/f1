<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
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
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectToAdmin = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
            $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
     return Auth::guard('admin');
    }

     public function admin_login()
    {
        return view('admin.admin_login');
    }

    public function admin_login_success(Request $request)
    {

        $this->validate($request, [
            'admin_email'   => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['admin_email' => $request->admin_email, 'password' => $request->password], $request->get('remember'))) {

            $user = auth()->guard('admin')->user();
            return redirect()->intended('/admin/dashboard');
        }
        return back()->withInput($request->only('admin_email', 'remember'));
    }

}
