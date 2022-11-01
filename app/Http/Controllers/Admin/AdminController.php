<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;

use Exception;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    // show admin account detail
    public function admin_account()
    {
        return view('admin.admin_account');
    }

    // allow admin to edit 
    public function admin_account_edit(Request $request){

        $admin = Admin::find(Auth::user()->id);

        $admin->admin_name = $request->get('admin_name');
        //check whether the input is Not empty for admin password
        if(!isEmpty($request->get('admin_password'))){
            $admin->admin_password = $request->get('admin_password');
        }
        //save edited data to database
        $respond = $admin->save();
    
        //return and show message
        if($respond){
            return redirect()->back()->with('success', 'You had edit successful.');
        }else{
            return redirect()->back()->with('fail','Error, no successful edit. Please try again');
        }

    }

    //login facebook and request permission
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->scopes([
           "public_profile", "pages_show_list", "pages_read_engagement", "pages_manage_posts", 
           "pages_manage_engagement", "pages_read_user_content", "pages_manage_metadata", "user_videos", 
           "user_posts","publish_video"
        ])->redirect();
    }

    //facebook callback back to web page and retrieve back data
    public function handleProviderFacebookCallback()
    {
      
       $auth_admin = Socialite::driver('facebook')->user();
        
        DB::table('admins')
              ->where('id', Auth::id())
              ->update([
                'token' => $auth_admin->token,
                'facebook_account_id'  =>  $auth_admin->id,
              ]);
        return redirect()->to('/admin/account');
    }

    public function facebook_page_id(Request $request)
    {
        $admin = Admin::find(Auth::id());

        $admin->facebook_page_id = $request->get('facebook_page_id');
        $admin->save();

        return redirect()->back();
    }

}
