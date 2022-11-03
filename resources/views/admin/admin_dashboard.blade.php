@extends('layouts.master')

@section('title','Dashboard')

@section('admin_content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
            <div class="col-xl-3 col-md-6">
             <div class="card text-white mb-4" style="background-color: #C5E90B">
                <div class="card-body">Total Product
                    <h2>{{$products}}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{url('admin/product')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background-color: #86DC3D">
                    <div class="card-body">Total Product Shown
                        <h2>{{$product_shown}}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{url('admin/product')}}">View Details</a>
                         <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                     </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background-color: #378805">
                    <div class="card-body">Total Live Session
                        <h2>{{$lives}}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{url('admin/live')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background-color: #26580F">
                    <div class="card-body">Total Consumers
                    <h2>{{$consumers}}</h2>
                    </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{url('admin/consumer_list')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
                </div>
            </div>
            </div>
            <div class="row">
                 <div class="mb-4">
                    <div class="card-body"><canvas id="recentSales" height="100px"></canvas></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-body"><canvas id="topSalesProduct" height="50px"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-body"><canvas id="topMember" height="150px"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <canvas id="myChart" height="100px"></canvas>
        </div>
    </div>
</div>

@include('admin.dashboard.bar_chart')
@include('admin.dashboard.top_member_dashboard')
@include('admin.dashboard.top_selling_product')
@include('admin.dashboard.recent_sales')

@endsection