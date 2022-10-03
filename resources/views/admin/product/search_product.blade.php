@extends('layouts.master')

@section('title','Product List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="">Product List</h3>
            <br>
            <form class="form-inline my-2 my-lg-0" type="get" action="{{url('admin/product/search')}}">
                <input class="form-control mr-sm-2" name="query" type="serach" placeholder="Search For Product Name"/>
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>
            <a  href="{{url('admin/product/add')}}" class="btn btn-outline-primary openaddmodal float-end mb-2 m-2">Add Product</a>
            <a  href="{{url('admin/product')}}" class="btn btn-outline-success openaddmodal float-end mb-2 m-2">All Product</a>
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Product Code</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Stock Quantity</th>
                <th scope="col">Price</th>
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
                    <img src=" {{asset('assets/image/product/' . $product->product_image)}}" width="60px" height="60px">
                </td>
                <td scope="col">{{$product['product_name']}}</td>
                <td scope="col">{{$product['product_stock_quantity']}}</td>
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
                    <a href="{{url('admin/product/hide/'. $product->id)}}" class="btn btn-danger">Hide</a>
                    
                    @endif
                    @if ($product->product_status == 'Hide')
                    <a href="{{url('admin/product/shown/'. $product->id)}}" class="btn btn-success">Shown</a>
                    
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