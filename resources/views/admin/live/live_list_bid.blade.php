@extends('layouts.master')

@section('title','List of Bid')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="">List of Bid</h3>
            <div class="mb-2">
                <form class="input-group mb-3" type="get" action="{{url('#')}}">
                    <input class="form-control" name="query" type="serach" placeholder="Search For Product Name"/>
                    <button class="btn btn-outline-dark  " type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col">Live ID</th>
                <th scope="col">Product Code</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Description</th>
                <th scope="col">Quantity Sold</th>
                <th scope="col">Price (RM) </th>
                <th scope="col">Total Price Sold(RM) </th>
            </tr>
        </thead>
        <!-- list out all bid product -->
        <tbody>
            @foreach($bid_product as $bid_products)
            <tr class="align-middle" style="text-align:center">
                <td scope="col">{{$bid_products['live_stream_id']}}</td>
                <td scope="col">{{$bid_products['product_code']}}</td>
                <td scope="col">{{$bid_products['product_name']}}</td>
                <td scope="col">No Image</td>
                <td scope="col">{{$bid_products['product_description']}}</td>
                <td scope="col">{{$bid_products['product_sales_quantity']}}</td>
                <td scope="col">{{$bid_products['product_price']}}</td>
                <?php
                    $total_price = $bid_products['product_price']*$bid_products['product_sales_quantity'];
                ?>
                <td scope="col">{{$total_price}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>

        </div>
    </div>
</div>



@endsection