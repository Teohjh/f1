<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    //retrieve data and show all product
    public function product_list()
    {
        $data = Product::all();

        //return and pass product information
        return view('admin.product.product_list',['products'=>$data]);
    }

    // add product page
    public function product_add()
    {
        return view('admin.product.add_product');
    }

    //add product into product database
    public function product_store(Request $request)
    {
        //validate for input data that require
        $request->validate([
            'product_code' => 'required|unique:products,product_code',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_image' => 'required',
            'product_stock_quantity'  => 'required',
            'product_price' => 'required'
        ]);

        //save image into public folder
        if($request->hasFile('product_image')){
            $product_image = time().'-'.$request->product_image->getClientOriginalName();
            $request->product_image->move('assets\image\product', $product_image);
        }

        //save product
        $product = new Product();
        $product->product_code = $request->product_code;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_image = $product_image;
        $product->product_stock_quantity = $request->product_stock_quantity;
        $product->product_price = $request->product_price;
        $respond = $product->save();
    
        //return and show message
        if($respond){
            return back()->with('success', 'You added product successful.');
        }else{
            return back()->with('fail','Error, Fail to add. Please try again');
        }
    }

    //edit product page for the specific selected product
    public function product_edit($id)
    {
        //find the specific product and pass value to edit page
        $products = Product::find($id);
        return view('admin.product.edit_product', compact('products'));
    }

    //update the product data to database
    public function product_update(Request $request)
    {
        $products = Product::find($request->id);

        //save the new image into public folder
        if($request->hasFile('edit_product_image')){

            //delete the previous image that store in public folder for replace the new image
            $old_product_image = 'assets/image/product/'.$products->product_image;
            if(File::exists($old_product_image))
            {
                File::delete($old_product_image);
            }
            
            //save new image
            $edit_product_image = time().'-'.$request->edit_product_image->getClientOriginalName();
            $request->edit_product_image->move('assets\image\product', $edit_product_image);
            $products->product_image = $edit_product_image;
            $products->save();
        }
        
        //update product data into database
        $products->product_code = $request->get('product_code');
        $products->product_name = $request->get('product_name');
        $products->product_description = $request->get('product_description');
        $products->product_price = $request->get('product_price');
        $products->product_stock_quantity = $request->get('product_stock_quantity');

        //update the status to 'hide' when the stock quantity is 0
        if($products->product_stock_quantity ==  0){
            $products->product_status =  'Hide';
        }

        $respond = $products->save();
    
        //return and show message
        if($respond){
            return redirect()->back()->with('success', 'You had edit and update product successful.');
        }else{
            return redirect()->back()->with('fail','Error, no successful update. Please try again');
        }
    }

    //search product within product name
    public function product_search()
    {
        //base on the input data to find the data and show in table
        $search_text = $_GET['query_product_name'];
        $products = Product::where('product_name', 'LIKE', '%'.$search_text. '%')->get();

        //pass data and return to search product list
        return view('admin.product.search_product',compact('products'));
    }

    //update product status from shown to hide
    public function product_update_status_hide($id)
    {
        
        $products = Product::find($id);

        if( isset($products) && !is_null($products)) {

            // update status to hide
            $products->product_status =  'Hide';

            $respond = $products->save();
    
            if($respond){
                return redirect()->back()->with('success', 'Updated to Hide');
            }else{
                return redirect()->back()->with('fail','Error, Fail to update. Please try again');
            }
        
        } else {
            
            return view('admin.product.add_product')->with('fail','Errror, Unavailable');
        }
        
    }

    //update product status from hide to shown
    public function product_update_status_shown($id){
        $products = Product::find($id);
 
         if( isset($products) && !is_null($products)) {

            //if stock quantity is 0 and state out of stock, admin was not allow to update status
            if($products->product_stock_quantity ==  0){
                return redirect()->back()->with('fail','Out of Stock, Not allow to update status.');
            }

            //update status to shown
             $products->product_status =  'Shown';
             $respond = $products->save();
    
            if($respond){
                return redirect()->back()->with('success', 'Updated to Shown');
            }else{
                return redirect()->back()->with('fail','Error, Fail to update. Please try again');
            }
        
        } else {
            
            return view('admin.product.add_product')->with('fail','Errror, Unavailable');
        }
    }
    
}
