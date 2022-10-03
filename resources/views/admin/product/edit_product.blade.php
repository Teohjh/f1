@extends('layouts.master')

@section('title','Edit Product')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Edit Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/product/update/.$products -> id')}}" method="POST">

                @method('PUT')
                @csrf

                <div class="mb-3">
                <label for="product_code"> Product Code </label>
                    <input type="text" class="form-control" placeholder="Enter Product Code"
                         name="product_code" value="{{$products -> product_code}}">
                    <span class="text-danger">@error('product_name') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_name"> Product Name </label>
                    <input type="text" class="form-control" placeholder="Enter Product Name"
                         name="product_name" value="{{$products -> product_name}}">
                    <span class="text-danger">@error('product_name') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_description"> Product Description </label>
                    <input type="text" class="form-control" placeholder="Enter Product Description"
                         name="product_description" value="{{$products -> product_description}}">
                    <span class="text-danger">@error('product_description') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_image"> Product Image </label>
                    @if($products->product_image)
                        <img src=" {{asset('assets/image/product/' . $products->product_image)}}" width="60px" height="60px">
                    @endif
                    <!--
                     <input type="file" class="form-control" placeholder="Upload Product Image"
                     name="product_image" value="{{$products -> product_image}}">
                    <span class="text-danger">@error('product_image') {{$message}} @enderror </span>
                    !-->
                </div>

                <div class="mb-3">
                <label for="product_stock_quantity"> Stock Quantity </label>
                    <input type="text" class="form-control" placeholder="Enter Stock Quantity"
                         name="product_stock_quantity" value="{{$products -> product_stock_quantity}}">
                    <span class="text-danger">@error('product_stock_quantity') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_price"> Product Price (RM)</label>
                    <input type="text" class="form-control" placeholder="Enter Product Price"
                         name="product_price" value="{{$products -> product_price}}">
                    <span class="text-danger">@error('product_price') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-warning float-end">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>

   @endsection