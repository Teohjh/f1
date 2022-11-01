
@extends('layouts.master')

@section('title','Sales Order List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="">Sales Order List</h3>
            <div class="mb-2">
                <form class="input-group mb-3" type="get" action="{{url('#')}}">
                    <input class="form-control" name="query" type="serach" placeholder="Search For FB Name"/>
                    <button class="btn btn-outline-dark  " type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col"></th>
                <th scope="col">Live ID</th>
                <th scope="col">Product Code</th>
                <th scope="col">Product</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Comment</th>
                <th scope="col">Quantity</th>
                <th scope="col">Amount (RM) </th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <!-- list out all bid product -->
        <tbody>
            @foreach($sales_order as $sales_orders)
            <?php
                $bid_id = $sales_orders->bid_id;
            ?>
            <tr class="align-middle" style="text-align:center">
                <td scope="col"></td>
                <td scope="col">{{$sales_orders->live_stream_id}}</td>
                <td scope="col">{{$sales_orders->product_code}}</td>
                <td scope="col">
                    <p style="color: red">No Image</p>
                    {{$sales_orders->product_name}}
                </td>
                <td scope="col">{{$sales_orders->name}}</td>
                <td scope="col">{{$sales_orders->comment}}</td>
                <td scope="col">{{$sales_orders->quantity}}</td>
                <td scope="col">{{$sales_orders->total_amount}}</td>
                <?php
                    $status = $sales_orders->status;
                ?>
                @if($status = "Unpaid")
                <td scope="col"><p style="color:red;">{{$status}}</p></td>
                @elseif($status = "Paid")
                <td scope="col"><p style="color:green;">{{$status}}</p></td>
                @endif
            </tr>
            @endforeach
        </tbody>
        </table>

        </div>
    </div>
</div>



@endsection