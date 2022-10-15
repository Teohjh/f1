@extends('layouts.master')

@section('title','Facebook Post List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Facebook Post</h4>
            <form class="input-group mb-3" type="get" action="{{url('#')}}">
                <input class="form-control mr-sm-2" name="query" type="serach" placeholder="Search For Live ID"/>
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>

            <a  href="{{url('admin/live/setup')}}" class="btn btn-outline-primary openaddmodal float-end">Live Setup</a>
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col">#</th>
            <th scope="col">image</th>
            <th scope="col">name</th>
            <th scope="col">message</th>
            <th scope="col">status</th>
            <th scope="col">action</th>
            </tr>
            @foreach($posts as $post)
            @if($post::count() == 0)
            <tr>
                <td>no data
                </td>
            </tr>
            @endif
            <tr class="align-middle" style="text-align:center">
                <td scope="col">
                   
                </td>
                <td scope="col">{{$post['name']}}</td>
                <td scope="col">
                    <img src=" {{asset('assets/image/product/' . $post->image)}}" width="110px" height="100px">
                </td>
                <td scope="col">{{$post['message']}}</td>
                <td scope="col">
                    @if ($post->status == 'active')
                        <p class=" badge badgesize badge-success right changestatus text-success">{{$post['status']}}</p>
                    @endif
                    @if ($post->status == 'inactive')
                        <p class=" badge badgesize badge-success right changestatus text-danger">{{$post['status']}}</p>
                    @endif
                </td>
                <td scope="col">
                    <a href="#" data-toggle="modal" class="btn btn-success btn-sm openaddmodal" ><i class="fas fa-pencil-alt"></i></a> 
                    <a href="#" data-toggle="modal" class="btn btn-danger btn-sm delete_record" ><i class="fas fa-trash-alt"></i></a>
                    <a href="#"   class="btn btn-info btn-sm publishToProfile" ><i class="fab fa-facebook-square"></i></a>
                </td>
                
            </tr>
            @endforeach
           
        </thead>
        <tbody>
        </tbody>
        </table>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
   $( document ).ready(function() {
        
   });
 </script>
@endpush