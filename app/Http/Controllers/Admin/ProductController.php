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
/*
        if($request->hasFile('product_image'))
        {
            //get filename with the ectension
            $file = $request->file('product_image');

            //get just the filename
            $extension = $file->getClientOriginalName();
            $fileName = time().'.'.$extension;

            //get the filename to store
            $destinationPath = public_path().'/assests/image/product/';

            $file->move($destinationPath, $fileName);
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save( storage_path('/assests/image/product/' . $filename ) );
            $person->image = $filename;
            $person->save();
          };
*/
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

        /*
        $this->validate($request, [
            'product_code' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_image' => 'required',
            'product_stock_quantity'  => 'required',
            'product_price' => 'required'
        ]);

        
        if($request->hasFile('product_image'))
        {
            $path= 'assets/image/product/'.$products->product_image;
            if(File::exits($path))
            {
                File::delete($path);
            }
            $file = $request->file('product_image');
            $ext  = $file->getClientOriginalExtension();
            $filename = time().".".$ext;
            $file->move('assets/image/product/'.$filename);
            $products->product_image = $filename;
        }*/
        
        $products->product_code = $request->get('product_code');
        $products->product_name = $request->get('product_name');
        $products->product_description = $request->get('product_description');
        //$products->product_image = $request->get('product_image');
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
            // do the rest part...
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
             // do the rest part...
             return view('admin.product.add_product');
         }
    }
    
}
