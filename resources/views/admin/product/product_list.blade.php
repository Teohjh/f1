@extends('layouts.master')

@section('title','Product List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Product List</h4>
            <div class="mb-2">
                <form class="input-group mb-3" type="get" action="{{url('admin/product/search')}}">
                    <input class="form-control" name="query_product_name" type="serach" placeholder="Search For Product Name"/>
                    <button class="btn btn-outline-dark  " type="submit">Search</button>
                </form>
            </div>
            <a  href="{{url('admin/product/add')}}" class="btn btn-outline-primary openaddmodal float-end">Add Product</a>
        </div>
        <div class="card-body">
        
        <table class="table table-hover">
        <thead>
            <tr class="align-middle" style="text-align:center">
                <th scope="col"></th>
                <th scope="col">Product Code</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Stock Quantity</th>
                <th scope="col">Price (RM)</th>
                <th scope="col">Status</th>
                <th scope="col" colspan="2" style="text-align:center">Action</th>
            </tr>
            @foreach($products as $product)
            <tr class="align-middle" style="text-align:center">
                <td scope="col">
                    @if ($product->product_status == 'Shown')
                        <input type="checkbox" name="product_select" value="{{ $product->id }}">
                    @endif
                    @if ($product->product_status == 'Hide')
                        <input type="checkbox" disabled >
                    @endif
                    
                </td>
                <td scope="col">{{$product['product_code']}}</td>
                <td scope="col">
                    <img src=" {{asset('assets/image/product/' . $product->product_image)}}" width="110px" height="100px">
                </td>
                <td scope="col">{{$product['product_name']}}</td>
                <td scope="col">
                    @if ($product->product_stock_quantity == 0)
                        <p class="text-danger fw-bold">Out of Stock</p>
                    @endif
                    @if ($product->product_stock_quantity <= 10 && $product->product_stock_quantity > 0)
                        <p class="text-danger fw-bold">{{$product['product_stock_quantity']}}</p>
                        <p class="text-danger fw-bold">Low Quantity</p>
                    @endif
                    @if ($product->product_stock_quantity > 10)
                        {{$product['product_stock_quantity']}}
                    @endif
                </td>
                <td scope="col">{{$product['product_price']}}</td>
                <td scope="col">
                    @if ($product->product_status == 'Shown')
                        <p class="text-success">{{$product['product_status']}}</p>
                    @endif
                    @if ($product->product_status == 'Hide')
                        <p class="text-danger">{{$product['product_status']}}</p>
                    @endif
                </td>
                <td scope="col">
                <a href="{{url('admin/product/edit/'. $product->id)}}" class="btn btn-warning">Edit</a>
                </td>
                <td scope="col">
                   
                    @if ($product->product_status == 'Shown')
                    <form method="POST" action="{{url('admin/product/hide/'. $product->id)}}">
                        @csrf
                        <button class="btn btn-danger" type="submit" name="product_status" value="Hide">Hide</button>
                    </form>
                    @endif
                    @if ($product->product_status == 'Hide')
                    <form method="POST" action="{{url('admin/product/shown/'. $product->id)}}">
                        @csrf
                        <button class="btn btn-success" type="submit" name="product_status" value="Shown">Shown</button>
                    </form>
                    @endif
                    
                </td>
            </tr>
            @endforeach
        </thead>
        <tbody>
        </tbody>
        </table>

        </div>
    </div>
</div>



@endsection