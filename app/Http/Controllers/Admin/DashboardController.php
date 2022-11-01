<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BidProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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

        /*$bid_product = BidProduct::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count', 'month_name');
 
        $labels = $bid_product->keys();
        $data = $bid_product->values();*/

        return view('admin.admin_dashboard', compact('products','lives','product_shown','consumers','posts'));
    }
}
