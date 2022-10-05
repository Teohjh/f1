@extends('layouts.master')

@section('title','Account Setting')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            
            <h2 class=""><i class="fa fa-cogs" aria-hidden="true" style="color:#303f34"> </i>   Account Setting</h2>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <h4>Admin Account</h4>
                    <label for="admin_name">Admin Name</label>
                    <input type="text" class="form-control" name="admin_name" value="{{ Auth::user()->admin_name }}">

                    <label for="admin_email">Admin Email</label>
                    <input type="text" class="form-control" name="admin_email" value="{{ Auth::user()->admin_email }}">

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h4>Facebook Account Link</h4>
                    <label for="fb_id">Facebook Fan Account</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>

   @endsection