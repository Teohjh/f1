<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function product_list()
    {
        $data = Product::all();

        return view('admin.product.product_list',['products'=>$data]);
    }

    public function product_add()
    {
        return view('admin.product.add_product');
    }

    public function product_store(Request $request)
    {
        $request->validate([
            'product_code' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_image' => 'required',
            'product_stock_quantity'  => 'required',
            'product_price' => 'required'
        ]);

        if($request->hasFile('product_image')){
            $product_image = time().'-'.$request->product_image->getClientOriginalName();
            $request->product_image->move('assets\image\product', $product_image);
        }

        $product = new Product();
        $product->product_code = $request->product_code;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_image = $product_image;
        $product->product_stock_quantity = $request->product_stock_quantity;
        $product->product_price = $request->product_price;
        $respond = $product->save();
    
        if($respond){
            return back()->with('success', 'You added product successful.');
        }else{
            return back()->with('fail','Error. Please try again');
        }
    }

    public function product_edit($id)
    {
        $products = Product::find($id);
        return view('admin.product.edit_product', compact('products'));
    }

    public function product_update(Request $request)
    {
        $products = Product::find($request->id);

        if($request->hasFile('edit_product_image')){

            $old_product_image = 'assets/image/product/'.$products->product_image;
            if(File::exists($old_product_image))
            {
                File::delete($old_product_image);
            }
            
            $edit_product_image = time().'-'.$request->edit_product_image->getClientOriginalName();
            $request->edit_product_image->move('assets\image\product', $edit_product_image);
            $products->product_image = $edit_product_image;
            $products->save();
        }
        
        $products->product_code = $request->get('product_code');
        $products->product_name = $request->get('product_name');
        $products->product_description = $request->get('product_description');
        $products->product_price = $request->get('product_price');
        $products->product_stock_quantity = $request->get('product_stock_quantity');
        $products->save();

        //return view('admin.product.product_list')->with('status',"Product had successful updated.");
        return redirect()->back();
    }

    public function product_search()
    {
        $search_text = $_GET['query_product_name'];
        $products = Product::where('product_name', 'LIKE', '%'.$search_text. '%')->get();

        return view('admin.product.search_product',compact('products'));
    }

    public function product_update_status_hide($id)
    {
        
        $products = Product::find($id);

        if( isset($products) && !is_null($products)) {
            $products->product_status =  'Hide';
            $products->save();
            
            return redirect()->back();
        
        } else {
            
            return view('admin.product.add_product');
        }
        
    }


    public function product_update_status_shown($id){
        $products = Product::find($id);
 
         if( isset($products) && !is_null($products)) {
             $products->product_status =  'Shown';
             $products->save();
             
             return redirect()->back();
         
         } else {
             
             return view('admin.product.add_product');
         }
    }
    
}
