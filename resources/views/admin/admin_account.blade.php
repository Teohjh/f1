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
                    <form action="{{url('admin/account/edit')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="admin_name">Admin Name</label>
                        <input type="text" class="form-control" name="admin_name" value="{{ Auth::user()->admin_name }}">
                        <br>
                        <label for="admin_email">Admin Email</label>
                        <input type="text" class="form-control" name="admin_email" value="{{ Auth::user()->admin_email }}" readonly>
                        <br>
                        <label for="admin_name">Admin Password</label>
                        <input type="password" class="form-control" name="admin_password" value="">

                    <div class="mb-3">
                        <br>
                        <button type="submit" class="btn btn-success float-end">Edit</button>
                    </div>
    
                    </form>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h4>Facebook Account Link</h4>

                    <label for="fb_token">Facebook Account Token</label>
                    <input type="text" class="form-control" value="{{Auth::user()->token ??''}}" readonly>
                    <a href="{{route('facebook')}}" class="btn btn-info float-end " title="click"> <i class="fa fa-key" aria-hidden="true"></i></a>
                    
                    <br>

                    <label for="fb_token">Facebook Page Account Token</label>
                    <input type="text" class="form-control" value="{{Auth::user()->facebook_page_access_token ??''}}" readonly>
                    <a href="{{route('facebook_page_access_token')}}" class="btn btn-info float-end " title="click"> <i class="fa fa-key" aria-hidden="true"></i></a>
                    
                    <br>

                    <label for="facebook_page_id">Facebook Page ID</label>
                    <!--
                    <form class="input-group" action="{{route('facebook_page_id')}}" method="POST">
                    @csrf
                        <input type="text" class="form-control facebook_page_id" name="facebook_page_id" placeholder="Enter Facebook Page ID" value="{{Auth::user()->facebook_page_id ??''}}" required>
                        <button class="btn btn-info" type="submit"><i class="fa fa-upload" aria-hidden="true"></i></button>
                    </form>-->

                    <input type="text" class="form-control" value="{{Auth::user()->facebook_page_id ??''}}" readonly>
                    <a href="{{route('facebook_page_id')}}" class="btn btn-info float-end " title="click"> <i class="fa fa-upload" aria-hidden="true"></i></a>

                    
                </div>
            </div>
        </div>
    </div>
</div>

   @endsection

   @push('script')
    <script>
        
    </script>
        
    @endpush