@extends('layouts.master')

@section('title','List of Bid')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="">List of Bid</h3>
            <div class="mb-2">
                <form class="input-group mb-3" type="get" action="{{url('#')}}">
                    <input class="form-control" name="query" type="serach" placeholder="Search For Product Name"/>
                    <button class="btn btn-outline-dark  " type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col">Live ID</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Product Code</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity Sold</th>
                <th scope="col">Price (RM) </th>
            </tr>
           
        </thead>
        <tbody>
        </tbody>
        </table>

        </div>
    </div>
</div>



@endsection