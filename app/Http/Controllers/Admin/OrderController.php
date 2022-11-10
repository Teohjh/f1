<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\SalesOrder;
use App\Models\ShippingOrder;
use App\Models\Payment;

class OrderController extends Controller
{
    //return to checkout page
    public function order_checkout($order_id){

        $order = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.order_id')
            ->join('sales_orders', 'order_items.sales_order_id', '=', 'sales_orders.sales_order_id')
            ->join('bid_products', 'sales_orders.bid_id', '=', 'bid_products.bid_id')
            ->where('order_items.order_id','=',$order_id)
            ->select('order_items.*', 'sales_orders.*','orders.provider_id','bid_products.*',
            'orders.total_order_amount')
            ->get();

        return view('admin.sales_order.order_detail',(compact('order','order_id')));
    }

    //select item from sales order page to request to checkout 
    public function turn_order(Request $request){

        $order = new Order();
        $total_order_amount = 0;
        $order->total_order_amount = 0;
        $order->save();
        
        
        foreach($request->sales_order_select as $sales_order_select){
            $sales_order = DB::select('select * from sales_orders where sales_order_id = :sales_order_id', ['sales_order_id' => $sales_order_select]);

            foreach($sales_order as $sales_orders){

                $orders = DB::table('orders')
                ->orderBy('order_id', 'desc')
                ->first();

                $id = $orders->order_id;

                DB::table('orders')
                    ->where('order_id',$id)
                    ->update([
                      'provider_id' => $sales_orders->provider_id
                     ]);
                
                DB::table('sales_orders')
                    ->where('sales_order_id',$sales_orders->sales_order_id)
                    ->update([
                      'status' => "Paid"
                     ]);
                

                $order_item = new OrderItem();
                $order_item->order_id = $id;
                $order_item->sales_order_id = $sales_orders->sales_order_id;
                $order_item->save();

                $total_order_amount = $total_order_amount + $sales_orders->total_amount;
               
            }
        }
        DB::table('orders')
                    ->where('order_id',$id)
                    ->update([
                      'total_order_amount' => $total_order_amount
                     ]);

                     return redirect()->action('App\Http\Controllers\Admin\OrderController@order_checkout',['order_id' => $id]);
    }

    //save and checkout order
    public function save_checkout(Request $request){

        $order = Order::find($request->order_id);

        $shippping_order = new ShippingOrder();
        $shippping_order->order_id = $request->order_id;
        $shippping_order->provider_id = $order->provider_id;
        $shippping_order->fname = $request->fname;
        $shippping_order->lname = $request->lname;
        $shippping_order->contact_no = $request->contact_no;
        $shippping_order->address = $request->address;
        $shippping_order->city = $request->city;
        $shippping_order->state = $request->state;
        $shippping_order->postcode = $request->postcode;
        $shippping_order->shipping_method = $request->shipping_method;
        if($request->shipping_method == "Self Collect"){
            $shippping_order->shipping_status = "Received";

            DB::table('orders')
            ->where('order_id',$request->order_id)
            ->update([
            'order_status' => "Completed"
                     ]);

        }
        $shippping_order->save();

        $payment = new Payment();
        $payment->order_id = $request->order_id;
        $payment->payment_slip = $request->payment_slip;
        $payment->payment_method = $request->payment_method;
        $payment->payment_amount = $request->payment_amount;
        $payment->save();

        return redirect()->action('App\Http\Controllers\Admin\OrderController@order_list');
    }

    //order list
    public function order_list()
    {
        /*$order_list = DB::table('orders')
            ->join('consumers', 'orders.provider_id', '=', 'consumers.provider_id')
            ->select('consumers.*','orders.*')
            ->get();*/
        
            $order_list = DB::table('orders')
            ->get();

        return view('admin.sales_order.order_list',(compact('order_list')));   
    }

    //shipping list
    public function shipping_list()
    {
        $shipping_list = DB::table('shipping_orders')
            ->join('orders', 'shipping_orders.order_id', '=', 'orders.order_id')
            ->select('shipping_orders.*','orders.*')
            ->get();

        return view('admin.sales_order.order_shipping_list',(compact('shipping_list')));   
    }

}
