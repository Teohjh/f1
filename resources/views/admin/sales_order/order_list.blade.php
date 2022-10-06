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