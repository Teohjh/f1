@extends('layouts.master')

@section('title','Order List')

@section('admin_content')

            <!-- Page content-->
                <div class="container-fluid" style="width:1150px">
                    <h1 class="mt-4">Order List</h1>
                    
                </div>

                <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
                       
                    </div>
                    <div class="container">
                        <table id="datatable" class="table table-hover datatable">
                        <thead>
                            <tr>
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
@endsection