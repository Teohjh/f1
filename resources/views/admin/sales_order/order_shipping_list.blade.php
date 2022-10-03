@extends('layouts.master')

@section('title','Order Shipping')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class=""><i class="fa fa-truck" style="color:#FDA766"></i>  Order Shipping </h3>
            
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col">Order Date</th>
                <th scope="col">Order ID</th>
                <th scope="col">FB ID</th>
                <th scope="col">FB Name</th>
                <th scope="col">Status</th>
                <th scope="col">Shipping Status</th>
                <th scope="col">Total Amount (RM)</th>
            </tr>
           
        </thead>
        <tbody>
        </tbody>
        </table>

        </div>
    </div>
</div>



@endsection