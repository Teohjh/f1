<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\Live;
use Exception;
use App\Providers\FacebookRepository;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Facebook\Facebook;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    protected $facebook;

    public function __construct()
    {
        $this->facebook = new FacebookRepository();
    }

    public function redirectToProvider()
    {
        return redirect($this->facebook->redirectTo());
    }
    
    public function handleProviderCallback()
    {
        if (request('error') == 'access_denied') 
            //handle error

        $accessToken = $this->facebook->handleCallback(); 
        
        //use token to get facebook pages
        return redirect()->to('/admin/account');
    }


    //get page id and page name from facebook page account
    public function getPage(){

        $page_token = Auth::user()->facebook_page_access_token;

        $link = "https://graph.facebook.com/me?fields=id,name&access_token=$page_token";

        $collection = Http::get($link);
        $id = $collection['id'];
        $name = $collection['name'];

        DB::table('admins')
             ->where('id', Auth::user()->id)
             ->update([
               'facebook_page_id' => $id
             ]);


        return redirect()->to('/admin/account') -> with('id','name');
    }

    //get page access token from facebook
    public function getPageAccessToken(){

        $token = Auth::user()->token;
        $page_token = Auth::user()->facebook_page_access_token;

        $link = "https://graph.facebook.com/5410290569040611/accounts?access_token=$token";
        //$link = "https://graph.facebook.com/me/live_videos?status=LIVE_NOW&access_token=$page_token";

        $collection = Http::get($link);
        $item = $collection['data'];

        foreach ($item as $key) {
         
            $page_access_token = $key['access_token'];

             DB::table('admins')
             ->where('id', Auth::user()->id)
             ->update([
               'facebook_page_access_token' => $page_access_token
             ]);
               
        }

        return redirect()->to('/admin/account') -> with('page_access_token');
    }

    //get post page data from facebook page account
    public function getPostPage(){

        $page_token = Auth::user()->facebook_page_access_token;
        $page_id = Auth::user()->facebook_page_id;

        $link = "https://graph.facebook.com/me/feed?access_token=$page_token";

        $collection = Http::get($link);
        $item = $collection['data'];

        foreach ($item as $key) {

            $fb_post_id = $key['id'];

            if(isset($key['message'])){
                $message = $key['message'];
            }
            else if(isset($key['story'])){
                $message = $key['story'];
            }

            $date_time = $key['created_time'];

            $post_exist = Post::find($fb_post_id);

            if(Post::where('fb_post_id',$fb_post_id)->exists()){

            }
            else{
                //save product
                $post = new Post();
                $post->fb_post_id = $fb_post_id;
                $post->message = $message;
                $post->date_time = $date_time;
                $post->fb_page_id = $page_id;
                $post->save();
            }

            

             /*DB::table('posts')
             ->where('id', Auth::user()->id)
             ->update([
               'fb_post_id' => $fb_post_id,
               'message' => $message,
               'date_time' => $date_time,
               'facebook_page_id' => $page_id,
             ]);*/
               
        }

        return redirect()->to('/admin/facebook/post');
    }

    //get live from facebook
    public function getLiveNow(){

        $token = Auth::user()->token;
        $page_token = Auth::user()->facebook_page_access_token;

        //$link = "https://graph.facebook.com/me/live_videos?status=LIVE_NOW&access_token=$page_token";
        $link = "https://graph.facebook.com/me/live_videos?access_token=$page_token";

        $collection = Http::get($link);
        $item = $collection['data'];

        foreach ($item as $key) {

            $status = $key['status'];
            $live_stream_id = $key['id'];

            //if ($status == "LIVE"){
                //save live
                $live = new Live();
                $live->live_stream_id = $live_stream_id;
                $live->embed_html = $key['embed_html'];
                $live->status = $status;
                $live->stream_url = $key['stream_url'];
                $live->secure_stream_url = $key['secure_stream_url'];
                $live->save();
            //}
            //else{

               // return redirect()->to('/admin/live/setup');
            //}
               
        }

        return redirect()->to('/admin/live/setup', compact('live_stream_id'));
    }
    
}
