<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Live;
use App\Models\Product;
use Cohensive\Embed\Embed;

class LiveController extends Controller
{
    
    public function live_setup(Request $request)
    {
        $products = Product::all();
        return view('admin.live.live_setup', compact('products'));
    }

    public function live_list_bid()
    {
        return view('admin.live.live_list_bid');
    }

    public function save_live(Request $request)
    {
        $request->validate([
            //'embed_code' => 'required',
            'live_description' => 'required',
        
        ]);
        $live = new Live();
        $live->embed_code = $request->embed_code;
        $live->live_description = $request->live_description;
        $live->live_date = $request->live_date;
        $live->live_time = $request->live_time;
        $respond = $live->save();
        if($respond){
            return redirect()->route('start_live', ['id' => $live->id]);
        }else{
            return back()->with('fail','Error. Please try again');
        }
    }

    public function start_live($id)
    {
        $lives = Live::find($id);
        return view('admin.live.on_live', compact('lives'));
    }

    public function live_list()
    {
        $live = Live::all();

        return view('admin.live.live_list',['live'=>$live]);
    }

    public function get_product(){
        $data = Product::all();

        
    }
}
