@extends('layouts.master')

@section('title','Live Session List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Live Session List</h4>
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
                <th scope="col">Live ID</th>
                <th scope="col">Live Date/Time</th>
                <th scope="col">Live Description</th>
                <th scope="col">Action</th>
            </tr>
            @foreach($live as $lives)
            <tr class="align-middle" style="text-align:center">
                <td scope="col">{{$lives['id']}}</td>
                <td scope="col">{{$lives['fb_live_id']}}</td>
                <td scope="col">
                    {{$lives['live_date']}} /  {{$lives['live_time']}}
                </td>
                <td scope="col">{{$lives['live_description']}}</td>
                <td scope="col">{{$lives['status']}}</td>
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