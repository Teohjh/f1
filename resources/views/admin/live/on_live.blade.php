@extends('layouts.master')

@section('title','On Live')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
                    
    <div class="card mt-4">
        <div class="card-body">
            <input type="hidden" class="form-control" name="id" value="{{$lives->live_stream_id}}">
            <div class="mb-3">
                <a href="{{url('admin/live/get_comment/'. $lives->live_stream_id)}}" type="button" class="btn btn-outline-success float-end">Reload Comment</a>
                <br>
            </div>
            <div class="fb-video" data-href=""  
                data-allowfullscreen="true" data-width="500"></div>
        </div>

        <br>
        <div class="card">
            <div class="card-body">
                <!-- Add Product for prepare to sell -->
                <div class="mb-3">
                    
                    <a  href="#AddProductModal" type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#AddProductModal">Add Product</a>
                    <br><br>
                    <table id="product_show" class="table table-hover datatable" name="product_show">
                        <thead>
                             <tr class="align-middle" style="text-align:center">
                                <th scope="col">Product Code</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price (RM)</th>
                                <th scope="col">Stock Quantity</th>
                                <th scope="col">Sales Quantity</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <!-- list out all bid product -->
                        <tbody name="product_show" id="product_show">
                            @foreach($bid_product as $bid_products)
                            <?php
                            $product_code = $bid_products->product_code;
                                $product = DB::table('products')
                                    ->where('products.product_code','=',$product_code)
                                    ->get();
                            ?>
                            <tr class="align-middle" style="text-align:center">
                                <td scope="col">{{$product_code}}</td>
                                <td scope="col">No Image</td>
                                <td scope="col">{{$bid_products->product_name}}</td>
                                <td scope="col">{{$bid_products->product_price}}</td>
                                @foreach($product as $products)
                                <td scope="col">{{$products->product_stock_quantity}}</td>
                                @endforeach
                                <td scope="col">{{$bid_products->product_sales_quantity}}</td>
                                <td scope="col">
                                    <!-- bid product allow to start bid or delete bid product-->
                                    @if($bid_products->start_bid == "1" && $bid_products->end_bid == "0")
                                    <form method="POST" action="{{url('admin/live/start_bid/'. $bid_products->bid_id)}}">
                                        @csrf
                                        <button class="btn btn-success" type="submit" name="start_bid">Start Bid</button>
                                        <a href="#" class="btn btn-secondary" title="click" style="pointer-events: none"> End Bid</a>
                                        <a href="{{url('admin/live/delete_bid/'. $bid_products->bid_id)}}" class="btn btn-dark" title="click"> <i class="fa fa-trash" aria-hidden="true"></i></a> 
                                    </form>
                                    <!-- bid product had start to bid -->
                                    @elseif($bid_products->start_bid == "0" && $bid_products->end_bid == "0")
                                    <form method="POST" action="{{url('admin/live/end_bid/'. $bid_products->bid_id)}}">
                                        @csrf
                                        <a href="#" class="btn btn-secondary" title="click"  style="pointer-events: none">Start Bid</a>
                                        <button class="btn btn-danger" type="submit" name="end_bid">End Bid</button>
                                        <a href="{{url('admin/live/delete_bid/'. $bid_products->bid_id)}}" class="btn btn-dark" title="click" style="pointer-events: none"> <i class="fa fa-trash" aria-hidden="true"></i></a> 
                                    </form>
                                    <!-- bid product had ready end to bid -->
                                    @elseif($bid_products->start_bid == "0" && $bid_products->end_bid == "1")
                                    <a href="#" class="btn btn-secondary" title="click"  style="pointer-events: none">Start Bid</a>
                                    <a href="#" class="btn btn-secondary" title="click"style="pointer-events: none"> End Bid</a>
                                    <a href="{{url('admin/live/delete_bid/'. $bid_products->bid_id)}}" class="btn btn-dark" title="click" style="pointer-events: none"> <i class="fa fa-trash" aria-hidden="true"></i></a> 
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <a href="{{url('admin/live/end_live/'. $lives->live_stream_id)}}" type="button" class="btn btn-outline-danger float-end">End Live</a>
    </div>
</div>

   @endsection