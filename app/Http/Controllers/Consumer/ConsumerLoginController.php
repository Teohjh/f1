<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Consumer;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class ConsumerLoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectToConsumer = RouteServiceProvider::CONSUMER_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:consumer')->except('logout');
    }

    public function guard()
    {
     return Auth::guard('consumer');
    }

    public function login()
    {

        return view("consumer.consumer_login");
    }

    public function consumer_login_success(Request $request)
    {
        $password = NULL;
        
        if (Auth::guard('consumer')->attempt(['email'=> $request->email, 'password'=> $password])) {

            $user = auth()->guard('consumer')->user();
            return redirect()->intended('/consumer/index');
        }
        else{
            return redirect()
                ->back()
                ->with('status','authentication failed, please try again!');
        }
        
    }

    public function facebookRedirect(){
        return Socialite::driver('facebook')->redirect();
    }


    public function facebookCallback(){
        try{
            //if Authentication is successfull.
            $consumer = Socialite::driver('facebook')->user();
            /**
             *  Below are fields that are provided by
             *  every provider.
             */
            $provider_id = $consumer->getId();
            $name = $consumer->getName();
            $email = $consumer->getEmail();
            $avatar = $consumer->getAvatar();
            //$consumer->getNickname(); is also available
            // return the user if exists or just create one.
            $consumer = Consumer::firstOrCreate([
                'provider_id' => $provider_id,
                'name'        => $name,
                'email'       => $email,
                'avatar'      => $avatar,
            ]);
            /**
             * Authenticate the user with session.
             * First param is the Authenticatable User object
             * and the second param is boolean for remembering the
             * user.
             */ 
            //Auth::login($consumer,true);
            //Success
            //$user = auth()->guard('consumer')->user();
            // return redirect()->route('consumer-index');
            //$consumer = auth()->guard('consumer')->user();
            //return view("consumer.consumer_index");
            if (Auth::guard('consumer')->attempt([$email])) {

                $user = auth()->guard('consumer')->user();
                return redirect()->intended('/consumer/index');
            }

        }catch(\Exception $e){
            //Authentication failed
            return redirect()
                ->back()
                ->with('status','authentication failed, please try again!');
        }
    }

    
    //consumer logout page
    public function consumer_logout(Request $request) {
        Auth::logout();
        return redirect('/consumer/login');
      }

}
