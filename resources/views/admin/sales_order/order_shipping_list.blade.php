@extends('layouts.master')

@section('title','Order Shipping')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class=""><i class="fa fa-truck" style="color:#FDA766"></i>  Order Shipping </h3>
            <form class="input-group mb-3" type="get" action="{{url('#')}}">
                <input class="form-control mr-sm-2" name="query" type="serach" placeholder="Search For FB Name"/>
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col"></th>
                <th scope="col">Order ID</th>
                <th scope="col">Tracking No</th>
                <th scope="col">Consumer</th>
                <th scope="col">Order Status</th>
                <th scope="col">Shipping Method</th>
                <th scope="col">Shipping Status</th>
                <th scope="col">Total Amount (RM)</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <!-- list out all shipping order -->
        <tbody name="order_shipping_show" id="order_shipping_show">
            @empty($shipping_list)
              <p class="text-danger"> No Order Shipping </p>  
            @endempty

            @foreach($shipping_list as $shipping_lists)
            <tr class="align-middle" style="text-align:center">
                <td scope="col"></td>
                <td scope="col">{{$shipping_lists->order_id}}</td>
                <td scope="col">{{$shipping_lists->tracking_no}}</td>
                <td scope="col">
                    <?php
                        $consumer = DB::table('sales_orders')
                        ->where('sales_orders.provider_id','=',$shipping_lists->provider_id)
                        ->get();
                        foreach($consumer as $consumer){
                            $consumer_name = $consumer->name;
                        }
                    ?>
                        {{$consumer_name}}
                </td>
                <td scope="col">{{$shipping_lists->order_status}}</td>
                <td scope="col">{{$shipping_lists->shipping_method}}</td>
                <td scope="col">{{$shipping_lists->shipping_status}}</td>
                <td scope="col">{{$shipping_lists->total_order_amount}}</td>
                <td scope="col">
                    <a href="{{url('#')}}" class="btn btn-warning">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>

        </div>
    </div>
</div>



@endsection