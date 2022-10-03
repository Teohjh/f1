@extends('layouts.master')

@section('title','List of Bid')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="">List of Bid</h3>
            
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
            </tr>
           
        </thead>
        <tbody>
        </tbody>
        </table>

        </div>
    </div>
</div>



@endsection