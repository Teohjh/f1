@extends('layouts.master')

@section('title','On Live')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
                    
    <div class="card mt-4">
        <div class="card-body">
            <!--
            <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F100084224632628%2Fvideos%2F'{{$lives -> embed_code}}'%2F&width=1280" 
            width="580" height="320" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" 
            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
            -->
            <div class="fb-video" data-href="{{$lives -> embed_code}}"  
                data-allowfullscreen="true" data-width="500"></div>
                <p>{{$lives -> embed_code}}</p>

                <div class="fb-video"
    data-href="https://www.facebook.com/FacebookDevelopers/posts/10151471074398553"
    data-width="500"
    data-allowfullscreen="true"></div>
        </div>
       
    </div>
</div>

   @endsection