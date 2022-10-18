@extends('layouts.master')

@section('title','On Live')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
                    
    <div class="card mt-4">
        <div class="card-body">
            <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F100084224632628%2Fvideos%2F'{{$lives -> embed_code}}'%2F&width=1280" 
            width="580" height="320" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" 
            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
        </div>
       
    </div>
</div>

   @endsection