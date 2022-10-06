@extends('layouts.master')

@section('title','Order List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="">Order List</h3>
            
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col">Order ID</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Product Quantity</th>
                <th scope="col">Amount (RM)</th>
                <th scope="col">Action</th>
            </tr>
           
        </thead>
        <tbody>
        </tbody>
        </table>

        </div>
    </div>
</div>


@endsection