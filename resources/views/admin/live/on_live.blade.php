@extends('layouts.master')

@section('title','On Live')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
                    
    <div class="card mt-4">
        <div class="card-body">
            {{$lives -> embed_code}}
        </div>
    </div>
</div>

   @endsection