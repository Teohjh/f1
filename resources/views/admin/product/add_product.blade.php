@extends('layouts.master')

@section('title','Add Product')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/product/add/store')}}" method="POST">
                @csrf

                <div class="mb-3">
                <label for="product_code"> Product Code </label>
                    <input type="text" class="form-control" placeholder="Enter Product Code"
                         name="product_code" value="{{old('product_code')}}">
                    <span class="text-danger">@error('product_name') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_name"> Product Name </label>
                    <input type="text" class="form-control" placeholder="Enter Product Name"
                         name="product_name" value="{{old('product_name')}}">
                    <span class="text-danger">@error('product_name') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_description"> Product Description </label>
                    <input type="text" class="form-control" placeholder="Enter Product Description"
                         name="product_description" value="{{old('product_description')}}">
                    <span class="text-danger">@error('product_description') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_image"> Product Image </label>
                     <input type="file" class="form-control" placeholder="Upload Product Image"
                     name="product_image" value="">
                    <span class="text-danger">@error('product_image') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_stock_quantity"> Stock Quantity </label>
                    <input type="text" class="form-control" placeholder="Enter Stock Quantity"
                         name="product_stock_quantity" value="{{old('product_stock_quantity')}}">
                    <span class="text-danger">@error('product_stock_quantity') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_price"> Product Price (RM)</label>
                    <input type="text" class="form-control" placeholder="Enter Product Price"
                         name="product_price" value="{{old('product_price')}}">
                    <span class="text-danger">@error('product_price') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success float-end">Add</button>
                </div>

            </form>
        </div>
    </div>
</div>

   @endsection