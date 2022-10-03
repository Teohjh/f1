@extends('layouts.master')

@section('title','Product List')

@section('admin_content')

            <!-- Page content-->
                <div class="container-fluid" style="width:1150px">
                    <h1 class="mt-4">Product List</h1>
                    
                    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
                       
                        <nav class="my-2 my-md-0 mr-md-3">
                            <!-- Navbar Search-->
                            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </form>

                            <a  href="{{url('/admin/product/add')}}" class="btn btn-outline-primary openaddmodal float-right">Add Product</a>
                        </nav>
                        
                    </div>
                    <div class="container">
                        <table id="datatable" class="table table-hover datatable">
                        <thead>
                            <tr>
                                <th scope="col">Product Code</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Action</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                    </div>
                </div>

@endsection