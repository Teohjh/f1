@extends('layouts.master')

@section('title','Live Comment List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Live Comment List</h4>
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col">Live ID</th>
                <th scope="col">FB ID</th>
                <th scope="col">FB Name</th>
                <th scope="col">Comment</th>
            </tr>
            
            @foreach($comment as $comments)
           
            <tr class="align-middle" style="text-align:center">
                <td scope="col">{{$comments['live_stream_id']}}</td>
                <td scope="col">{{$comments['provider_id']}}</td>
                <td scope="col">{{$comments['name']}}</td>
                <td scope="col">{{$comments['comment']}}</td>
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