<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\Live;
use App\Models\Comment;
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

    //get live on from facebook
    public function getLiveNow(){

        $token = Auth::user()->token;
        $page_token = Auth::user()->facebook_page_access_token;

        $link = "https://graph.facebook.com/me/live_videos?status=LIVE_NOW&access_token=$page_token";
        //$link = "https://graph.facebook.com/me/live_videos?access_token=$page_token";

        $collection = Http::get($link);
        $item = $collection['data'];

        foreach ($item as $key) {

            $live_status = $key['status'];
            $live_stream_id = $key['id'];

            if ($live_status == "LIVE"){

                if(Live::where('live_stream_id',$live_stream_id)->exists()){

                    DB::table('lives')
                    ->where('live_stream_id', $live_stream_id)
                    ->update([
                    'embed_html' =>  $key['embed_html'],
                    'live_status' => $live_status,
                    'stream_url' =>  $key['stream_url'],
                    'secure_stream_url' =>  $key['secure_stream_url'],
                    ]);
                    
                }
                else{
                    //save live
                    $live = new Live();
                    $live->live_stream_id = $live_stream_id;
                    $live->embed_html = $key['embed_html'];
                    $live->live_status = $live_status;
                    $live->stream_url = $key['stream_url'];
                    $live->secure_stream_url = $key['secure_stream_url'];
                    $live->save();
                }
            }
            else{

               return redirect()->to('/admin/live/setup');
            }
               
        }
        

        return redirect()->to('/admin/live/setup');
    }

    //get live on from facebook
    public function getEndLive($live_stream_id){

        $token = Auth::user()->token;
        $page_token = Auth::user()->facebook_page_access_token;

      //  $link = "https://graph.facebook.com/me/live_videos?status=LIVE_NOW&access_token=$page_token";
        //$link = "https://graph.facebook.com/me/live_videos?access_token=$page_token";

       // $collection = Http::get($link);
       // $item = $collection['data'];


        DB::table('lives')
        ->where('live_stream_id', $live_stream_id)
         ->update([
                'live_status' => "VOD",
         ]);
               

        return redirect()->route('live_setup');
    }

    //get live from facebook
    public function getLive(){

        $token = Auth::user()->token;
        $page_token = Auth::user()->facebook_page_access_token;

        //$link = "https://graph.facebook.com/me/live_videos?status=LIVE_NOW&access_token=$page_token";
        $link = "https://graph.facebook.com/me/live_videos?access_token=$page_token";

        $collection = Http::get($link);
        $item = $collection['data'];

        foreach ($item as $key) {

            $live_status = $key['status'];
            $live_stream_id = $key['id'];

            if ($live_status == "LIVE"){

                if(Live::where('live_stream_id',$live_stream_id)->exists()){

                    DB::table('lives')
                    ->where('live_stream_id', $live_stream_id)
                    ->update([
                    'embed_html' =>  $key['embed_html'],
                    'live_status' => $live_status,
                    'stream_url' =>  $key['stream_url'],
                    'secure_stream_url' =>  $key['secure_stream_url'],
                    ]);
                    
                }
                else{
                    //save live
                    $live = new Live();
                    $live->live_stream_id = $live_stream_id;
                    $live->embed_html = $key['embed_html'];
                    $live->live_status = $live_status;
                    $live->stream_url = $key['stream_url'];
                    $live->secure_stream_url = $key['secure_stream_url'];
                    $live->save();
                }
            }
            else{
                $live_stream_id = null;
               return redirect()->to('/admin/live');
            }
               
        }

        return redirect()->to('/admin/live');
    }

    //get comment from live stream and filter for the bid code
    public function getComment($live_stream_id){

        $token = Auth::user()->token;
        $page_token = Auth::user()->facebook_page_access_token;

        $link = "https://graph.facebook.com/$live_stream_id/comments?access_token=$page_token";

        $collection = Http::get($link);
        $item = $collection['data'];

        foreach ($item as $key) {

            $consumer = $key['from'];
            $comment_id = $key['id'];

            if (isset($live_stream_id)){

                if(Comment::where('comment_id',$comment_id)->exists()){

                    
                }
                else{
                    $comment = $key['message'];
                   //if($comment == "A001+1"){
                        //save live
                        $comment = new Comment();
                        $comment->live_stream_id = $live_stream_id;
                        $comment->comment_id = $comment_id;
                        $comment->provider_id = $consumer['id'];
                        $comment->name = $consumer['name'];
                        $comment->comment = $key['message'];
                        $comment->comment_date_time = $key['created_time'];
                        $comment->save();
                   // }
                    
                }
            }
            else{

                //return redirect()->route('ongoing_live', [$live_stream_id]);
                return redirect()->action('App\Http\Controllers\Admin\LiveController@ongoing_live',['live_stream_id' => $live_stream_id]);
       
            }
               
        }
        

        //return redirect()->route('ongoing_live', [$live_stream_id]);
        return redirect()->action('App\Http\Controllers\Admin\LiveController@ongoing_live',['live_stream_id' => $live_stream_id]);
       
    }

    //get all comment from database
    public function comment_list(){

        $comment = Comment::all();

        return view('admin.live.live_comment_list',['comment'=>$comment]);

    }
    
}
