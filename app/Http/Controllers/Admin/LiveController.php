<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Live;
use App\Models\Product;
use App\Models\BidProduct;
use Cohensive\Embed\Embed;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LiveController extends Controller
{
    
    public function live_setup(Request $request)
    {
        $products = Product::all();
        $lives = Live::all();
        $lives_count = Live::count();

        return view('admin.live.live_setup', compact('products','lives','lives_count'));
    }

    public function save_live(Request $request)
    {
        $request->validate([
            'live_stream_id' => 'required',
        ]);

        $live_stream_id = $request->live_stream_id;

        /*$live = new Live();
        $live->embed_code = $request->embed_code;
        $live->live_description = $request->live_description;
        $live->live_date = $request->live_date;
        $live->live_time = $request->live_time;
        $respond = $live->save();
        if($respond){
            return redirect()->route('start_live', ['id' => $live->id]);
        }else{
            return back()->with('fail','Error. Please try again');
        }*/
        return redirect()->route('ongoing_live', [$live_stream_id]);
    }

    public function save_bid_product(Request $request)
    {

        foreach($request->product_select as $product_select){
            //$product = DB::table('products')
                //->where('id', $product_select);
            $product = DB::select('select * from products where id = :id', ['id' => $product_select]);
            foreach($product as $products){

                BidProduct::updateOrCreate(
                    ['live_stream_id'=> $request->live_stream_id,
                    'product_code'=> $products->product_code,
                    'product_name'=> $products->product_name,
                    'product_sales_quantity'=>0,
                    'product_description'=>$products->product_description,
                    'product_price' =>$products->product_price,   
                     ],
                );
            }


            /*save image into public folder
            if($product->hasFile('product_image')){
                $product_image = time().'-'.$request->product_image->getClientOriginalName();
                $product->product_image->move('assets\image\bid_product', $product_image);
            }*/
        }
    
        $live_stream_id = $request->live_stream_id;
        //$url = route('ongoing_live',[$live_stream_id]);
        // redirect($url);
        return redirect()->action('App\Http\Controllers\Admin\LiveController@ongoing_live',['live_stream_id' => $live_stream_id]);
        //return redirect('/admin/live/'.$live_stream_id.);
    }

    public function on_live(Request $request, $live_stream_id)
    {
        $lives = Live::find($live_stream_id);
        $product = Product::all();
        $bid_product = BidProduct::find($live_stream_id);

        return view('admin.live.on_live', compact('lives','bid_product','product'));
    }

    public function ongoing_live($live_stream_id)
    {
         $lives = Live::find($live_stream_id);
        $bid_product = DB::select('select * from bid_products where live_stream_id = :live_stream_id', ['live_stream_id' => $live_stream_id]);
        
        return view('admin.live.on_live', compact('lives','bid_product'));
    }

    public function live_list()
    {
        $live = Live::all();

        return view('admin.live.live_list',['live'=>$live]);
    }

    public function get_product(){
        $data = Product::all();

        
    }

    public function bid_product_list()
    {
        $bid_product = BidProduct::all();

        return view('admin.live.live_list_bid',['bid_product'=>$bid_product]);
    }

}
