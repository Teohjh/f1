<?php

namespace App\Http\Controllers\Admin;

use App\Models\FacebookPage;
use App\Http\Controllers\Controller;
use Exception;
use Facebook\Facebook;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Admin;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FacebookPageController extends Controller
{
    protected $facebook;

    public function __construct()
    {
        $this->facebook = new Facebook([
            'app_id' => config('services.facebook.app_id'),
            'app_secret' => config('services.facebook.app_secret'),
            'default_graph_version' => 'v15.0'
        ]);
    }

    public function test_graph_api(){

        $token = Auth::user()->token;
        $page_token = Auth::user()->name;

        $link = "https://graph.facebook.com/5410290569040611/accounts?access_token=$token";
        //$link = "https://graph.facebook.com/me/live_videos?status=LIVE_NOW&access_token=$page_token";

        $collection = Http::get($link);
        $item = $collection['data'];

        foreach ($item as $key) {
         
             DB::table('admins')
             ->where('id', Auth::user()->id)
             ->update([
               'name' => $key['access_token']
             ]);
               
        }

        return view('admin.admin_testing',['collection' => $item]);
    }
    
    public function store_fb_email(Request $request)
    {
        $fb_page = new FacebookPage();
        $fb_page->email = $request->email;
        $respond = $fb_page->save();
        if($respond){
            return back()->with('success', 'Successful.');
        }else{
            return back()->with('fail','Error. Please try again');
        }
    }

    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->scopes([
           "public_profile", "pages_show_list", "pages_read_engagement", "pages_manage_posts", 
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
                'name' => $auth_admin->email,
                'facebook_app_id'  =>  $auth_admin->id,
              ]);
        return redirect()->to('/facebook/get_page_access_token');
    }

    public function getPageAccessToken(){

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $this->facebook->get('/me/accounts', Auth::user()->token);
       } catch(FacebookResponseException $e) {
           // When Graph returns an error
           echo 'Graph returned an error: ' . $e->getMessage();
           exit;
       } catch(FacebookSDKException $e) {
           // When validation fails or other local issues
           echo 'Facebook SDK returned an error: ' . $e->getMessage();
           exit;
       }
    
       try {
            $admin = Admin::find(Auth::id());
            $page_id = $admin->facebook_page_id;

           $pages = $response->getGraphEdge()->asArray();
           foreach ($pages as $key) {
               if ($key['id'] == $page_id) {

                DB::table('admins')
                ->where('id', Auth::id())
                ->update([
                  'name' => $key['access_token']
                ]);
                   return $key['access_token'];
               }
           }
       } catch (FacebookSDKException $e) {
           dd($e); // handle exception
       }

        /*
        $user_access_token = Auth::user()->token;

        $pages_respone = $this->facebook->get('/me/accounts', $user_access_token);
        $pages = $pages_respone->getGraphEdge()->asArray();

        return array_map(function ($item) {
            DB::table('admins')
                ->where('id', Auth::id())
                ->update([
                  'name' => $item['access_token']
                ]);

            return [
                'provider' => 'facebook',
                'access_token' => $item['access_token'],
                'id' => $item['id'],
                'name' => $item['name'],
                'image' => "https://graph.facebook.com/{$item['id']}/picture?type=large"
            ];
        }, $pages);
        

        array_map(function ($item) {
            $admin = Admin::find(Auth::id());
            $page_id = $admin->facebook_page_id;

            if ($item['id'] == $page_id) {
                DB::table('admins')
                ->where('id', )
                ->update([
                  'name' => $item['access_token']
                ]);
            }
        }, $pages);

        $admin = Admin::find(Auth::id());
        $page_id = $admin->facebook_page_id;

        foreach ($pages as $key) {
            if ($key['id'] == $page_id) {
                DB::table('admins')
                ->where('id', Auth::id())
                ->update([
                  'name' => $key['access_token']
                ]);
            }
        }*/

        

        return redirect()->to('/admin/account');

    }

    /*
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->scopes([
           "public_profile, pages_show_list", "pages_read_engagement", "pages_manage_posts", "pages_manage_metadata", "user_videos", "user_posts"
        ])->redirect();
    }

    public function handleProviderFacebookCallback()
    {
      
       $auth_user = Socialite::driver('facebook')->user();
        
        DB::table('users')
              ->where('id', Auth::id())
              ->update([
                'token' => $auth_user->token,
                'facebook_app_id'  =>  $auth_user->id,
              ]);
        return redirect()->to('/admin/profile');
    }

    public function facebook_page_id(Request $request)
    {
        $input = $request->all();
        $rules = [
            'facebook_page_id'=> 'required'
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            $arr = ['status' =>400, "msg" => $validator->errors()->first(), 'result'=>[]];
        }else {
            try {
                $user = User::find(Auth::id());
                $user->facebook_page_id = $request->facebook_page_id;
                $user->save();
                $msg ='page id update successfully';
                $arr = array("status" => 200, "msg" => $msg );
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2]))
                {
                    $msg = $ex->errorInfo[2];
                }
                $arr = array("status" => 400, "msg" => $msg,"result" => array() );
            }
        }
        return Response::json($arr);
        
    }*/
    

}
