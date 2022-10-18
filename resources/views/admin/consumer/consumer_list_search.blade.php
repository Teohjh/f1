@extends('layouts.master')

@section('title','Consumer List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class=""> <a href="javascript:history.back()" style="color:#000000"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>   Consumer List</h4>
            <div class="mb-2">
                <form class="input-group mb-3" type="get" action="{{url('admin/consumer/search')}}">
                    <input class="form-control" name="query" type="serach" placeholder="Search For Consumer Name"/>
                    <button class="btn btn-outline-dark  " type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col">FB ID</th>
                <th scope="col">FB Image</th>
                <th scope="col">FB Name</th>
                <th scope="col">FB Email</th>
            </tr>
            @foreach($consumers as $consumer)
            <tr class="align-middle" style="text-align:center">
                <td scope="col">{{$consumer['provider_id']}}</td>
                <td scope="col">
                    <img src="{{$consumer['avatar']}}" width="60px" height="60px">
                </td>
                <td scope="col">{{$consumer['name']}}</td>
                <td scope="col">{{$consumer['email']}}</td>
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