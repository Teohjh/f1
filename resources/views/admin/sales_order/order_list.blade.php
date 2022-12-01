@extends('layouts.master')

@section('title','Order List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="">Order List</h3>
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
                <th scope="col">Order ID</th>
                <th scope="col">Consumer</th>
                <th scope="col">Total Amount (RM)</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
        </thead>
        <!-- list out all order -->
        <tbody name="order_show" id="order_show">
            @empty($order_list)
              <p class="text-warning"> No Order </p>  
            @endempty

            @foreach($order_list as $order)
            <tr class="align-middle" style="text-align:center">
                <td scope="col">{{$order->order_id}}</td>
                <td scope="col">
                    <?php
                        $consumer = DB::table('sales_orders')
                        ->where('sales_orders.provider_id','=',$order->provider_id)
                        ->get();
                        foreach($consumer as $consumer){
                            $consumer_name = $consumer->name;
                        }
                    ?>
                        {{$consumer_name}}
                </td>
                <td scope="col">{{$order->total_order_amount}}</td>
                <td scope="col">{{$order->order_status}}</td>
                <td scope="col">
                    <a href="{{url('admin/order/view/'. $order->order_id)}}" class="btn btn-info">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>

        </div>
    </div>
</div>


@endsection