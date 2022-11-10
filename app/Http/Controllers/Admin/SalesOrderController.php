<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Live;
use App\Models\Comment;
use App\Models\SalesOrder;

class SalesOrderController extends Controller
{
    public function sales_order_list()
    {

        $sales_order = DB::table('sales_orders')
            ->join('bid_products', 'sales_orders.bid_id', '=', 'bid_products.bid_id')
            ->join('comments', 'sales_orders.comment_id', '=', 'comments.comment_id')
            ->select('sales_orders.*', 'bid_products.product_name', 
            'bid_products.product_code', 'bid_products.product_image', 'comments.comment')
            ->get();

        return view('admin.sales_order.sales_list', compact('sales_order'));
    }
}
