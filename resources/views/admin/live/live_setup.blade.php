@extends('layouts.master')

@section('title','Live Setup')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
                    
    <div class="card mt-4">
        <div class="card-header">
            <h3 class=""><i class="fa fa-podcast" style="color:red"></i>  Live Setup</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('#')}}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="fb_link"> Facebook Live Link </label>
                    <input type="text" class="form-control" placeholder="Enter Live Link"
                        name="fb_link" value="{{old('fb_link')}}">
                    <span class="text-danger">@error('fb_link') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                    <label for="live_description"> Live Description </label>
                    <input type="text" class="form-control" placeholder="Enter Live Description"
                        name="live_description" value="{{old('live_description')}}">
                    <span class="text-danger">@error('live_description') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                    <label for="product_add"> Product Upload </label>
                    <button class="btn btn-primary" id="btnAddProduct" type="button">Add Product</button>
                    <table id="datatable" class="table table-hover datatable">
                        <thead>
                             <tr class="align-middle" style="text-align:center">
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price (RM)</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        </table>
                </div>
                <br><br>
                <div class="mb-5">
                    <button type="submit" class="btn btn-success float-end">Start Live</button>
                </div>

            </form>
        </div>
    </div>
</div>

   @endsection