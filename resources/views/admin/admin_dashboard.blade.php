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
             <div class="card bg-primary text-white mb-4">
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
                <div class="card bg-warning text-white mb-4">
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
                <div class="card bg-success text-white mb-4">
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
                <div class="card bg-danger text-white mb-4">
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
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <canvas id="myChart" height="100px"></canvas>
        </div>
    </div>
</div>

@include('admin.dashboard.bar_chart')
@endsection