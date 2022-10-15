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


class AdminController extends Controller
{
    public function admin_account()
    {
        return view('admin.admin_account');
    }

    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->scopes([
           "id","name","public_profile", "pages_show_list", "pages_read_engagement", "pages_manage_posts", 
           "pages_manage_metadata", "user_videos", "user_posts","publish_video"
        ])->redirect();
    }

    public function handleProviderFacebookCallback()
    {
      
       $auth_admin = Socialite::driver('facebook')->user();
        
        DB::table('admins')
              ->where('id', Auth::id())
              ->update([
                'token' => $auth_admin->token,
                'facebook_app_id'  =>  $auth_admin->id,
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
