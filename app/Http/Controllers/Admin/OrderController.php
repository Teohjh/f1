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

use function PHPUnit\Framework\isEmpty;

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

        //if there have no any sales order had choose
        if(!($request->sales_order_select)){
            return redirect()->back()->with('fail','Please select sales order.');
        }

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

        //validate for input data that require
        $request->validate([
            'order_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'contact_no' => 'required',
            'address'  => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'shipping_method' => 'required'
        ]);

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

    //view order detail for the specific selected order
    public function view_order($order_id)
    {

        $order = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.order_id')
            ->join('sales_orders', 'order_items.sales_order_id', '=', 'sales_orders.sales_order_id')
            ->join('bid_products', 'sales_orders.bid_id', '=', 'bid_products.bid_id')
            ->where('order_items.order_id','=',$order_id)
            ->select('order_items.*', 'sales_orders.*','orders.provider_id','bid_products.*',
            'orders.total_order_amount')
            ->get();

        //find the specific order and pass value to order detail page
        $orders = Order::find($order_id);

        $shipping = DB::table('shipping_orders')
        ->join('orders', 'shipping_orders.order_id', '=', 'orders.order_id')
        ->where('shipping_orders.order_id','=',$order_id)
        ->select('shipping_orders.*')
        ->get();
        
        $payment = Payment::where('order_id', $order_id)->get();
        
        return view('admin.sales_order.view_order_detail', compact('orders','order','shipping','payment'));

    }

     //edit order detail for the specific selected order
     public function update_order(Request $request)
     {

        //validate for input data that require
        $request->validate([
            'order_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'contact_no' => 'required',
            'address'  => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'shipping_method' => 'required'
        ]);

        DB::table('shipping_orders')
            ->where('shipping_id',$request->get('shipping_id'))
            ->update([
                'fname' => $request->get('fname'),
                'lname' => $request->get('lname'),
                'contact_no' => $request->get('contact_no'),
                'address' => $request->get('address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'postcode' => $request->get('postcode'),
                'shipping_method' => $request->get('shipping_method'),
            ]);
           
        return redirect()->back();
     }

     //update shipping status from processing to packed
    public function update_status_packed($shipping_id)
    {
        
        $shipping = ShippingOrder::find($shipping_id);

        if( isset($shipping) && !is_null($shipping)) {

            // update status to packed
            $shipping->shipping_status =  'Packed';

            $respond = $shipping->save();
    
            if($respond){
                return redirect()->back()->with('success', 'Updated to Packed');
            }else{
                return redirect()->back()->with('fail','Error, Fail to update. Please try again');
            }
        
        } else {
            
            return redirect()->back()->with('fail','Error, Unavailable');
        }
        
    }

     //update shipping status from processing to packed
    public function update_status_received($shipping_id)
    {
        
        $shipping = ShippingOrder::find($shipping_id);

        if( isset($shipping) && !is_null($shipping)) {

            // update status to packed
            $shipping->shipping_status =  'Received';
            $respond = $shipping->save();

            $order_status = "Completed";

            DB::table('orders')
            ->where('order_id',$shipping->order_id)
            ->update([
                'order_status' => $order_status,
            ]);
    
            if($respond){
                return redirect()->back()->with('success', 'Updated to Received');
            }else{
                return redirect()->back()->with('fail','Error, Fail to update. Please try again');
            }
        
        } else {
            
            return redirect()->back()->with('fail','Error, Unavailable');
        }
        
    }
}
