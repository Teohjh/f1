<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BidProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Consumer;
use App\Models\Live;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $posts = Post::count();
        $lives = Live::count();
        $consumers = Consumer::count();
        $product_shown = Product::where('product_status','Shown')->count();

        //function for get top 5 member for this month
        $sales_orders = $this->top_member_dashboard();
        $top_member_labels = array_keys($sales_orders);
        $top_member_data = array_values($sales_orders);
        // Generate random colours for the sales order data
        for ($i=0; $i<=count($sales_orders); $i++) {
            $sales_orders_colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        //function for get top 5 selling product
        $sell_product = $this->top_selling_product_dashboard();
        $sell_product_labels = array_keys($sell_product);
        $sell_product_data = array_values($sell_product);
        // Generate random colours for the sell product data
        for ($i=0; $i<=count($sell_product); $i++) {
            $sell_product_colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        //function for get recent sales
        $recent_sales = $this->recent_sales_dashboard();
        $recent_salest_labels = array_keys($recent_sales);
        $recent_sales_data = array_values($recent_sales);
        // Generate random colours for the sell product data
        for ($i=0; $i<=count($recent_sales); $i++) {
            $recent_sales_colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        //function for get sales activity
        $sales_activity = $this->sales_activity_dashboard();
        $sales_activity_labels = array_keys($sales_activity);
        $sales_activity_data = array_values($sales_activity);
        // Generate random colours for the sell product data
        for ($i=0; $i<=count($sales_activity); $i++) {
            $sales_activity_colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        return view('admin.admin_dashboard', compact('products','lives','product_shown',
        'consumers','posts','top_member_labels','top_member_data','sales_orders_colours','sell_product_labels',
        'sell_product_data','sell_product_colours','recent_salest_labels','recent_sales_data','recent_sales_colours',
        'sales_activity_labels','sales_activity_data','sales_activity_colours'));
    }

    //get top 5 higher purchase consumer from database
    public function top_member_dashboard(){

        $now = Carbon::now();
        $this_month = $now->month;

        $sales_orders = DB::table('sales_orders')
                  ->select('name', DB::raw('sum(total_amount) as total'))
                  ->whereMonth('created_at', $this_month)
                  ->groupBy('name')
                  ->pluck('total', 'name')->all();

        return $sales_orders;
    }

    //get top 5 selling product from database
    public function top_selling_product_dashboard(){

        $now = Carbon::now();
        $this_month = $now->month;

        $sales_orders = DB::table('bid_products')
                  ->select('product_name', DB::raw('sum(product_sales_quantity) as total'))
                  ->whereMonth('created_at', $this_month)
                  ->groupBy('product_name')
                  ->pluck('total', 'product_name')->all();
                  
        return $sales_orders;
    }

    //get recent sales for last 7 days from database
    public function recent_sales_dashboard(){

        $now = Carbon::today();
        $this_month = $now->month;
        $recent_7days = $now->subDays(7);    

        $recent_sales = DB::table('bid_products')
                  ->select('product_name', DB::raw('sum(product_sales_quantity) as total'))
                  //->whereMonth('created_at', $this_month)
                  //->where('created_at',$now)
                  ->whereDate('created_at','>=',$recent_7days)
                  ->groupBy('product_name')
                  ->pluck('total', 'product_name')->all();
                  
        return $recent_sales;
    }

    //get sales activity from database
    public function sales_activity_dashboard(){

        $sales_activity = DB::table('bid_products')
                  ->select('live_stream_id', DB::raw('sum(product_sales_quantity*product_price) as total'))
                  ->groupBy('live_stream_id')
                  ->pluck('total', 'live_stream_id')->all();
                  
        return $sales_activity;
    }
}
