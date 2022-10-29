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
                            <tr class="align-middle" style="text-align:center">
                                <td scope="col">{{$bid_products->product_code}}</td>
                                <td scope="col">No Image</td>
                                <td scope="col">{{$bid_products->product_name}}</td>
                                <td scope="col">{{$bid_products->product_price}}</td>
                                <td scope="col"></td>
                                <td scope="col">{{$bid_products->product_sales_quantity}}</td>
                                <td scope="col">
                                    <a href="#" class="btn btn-success" title="click">Start Bid</a>
                                    <a href="#" class="btn btn-secondary" title="click" style="pointer-events: none"> End Bid</a>
                                    <a href="#" class="btn btn-dark" title="click"> <i class="fa fa-trash" aria-hidden="true"></i></a>
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