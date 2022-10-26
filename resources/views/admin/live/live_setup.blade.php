@extends('layouts.master')

@section('title','Live Setup')

@section('admin_content')

<!-- Add Product Modal -->
<div class="modal fade" name="AddProductModal" id="AddProductModal" tabindex="-1" aria-labelledby="AddProductModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-75">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="AddPostModalLabel">Add Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table id="product_select" class="table table-hover datatable" name="product_select">
                <thead>
                     <tr class="align-middle" style="text-align:center">
                        <th scope="col"></th>
                        <th scope="col">Product Code</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Stock Quantity</th>
                        <th scope="col">Price (RM)</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <!-- list out all product -->
                <tbody>
                    @foreach($products as $product)
                    <tr class="align-middle" style="text-align:center">
                        <td scope="col">
                            @if ($product->product_status == 'Shown')
                                <input type="checkbox" name="product_select" value="{{ $product->id }}">
                            @endif
                            @if ($product->product_status == 'Hide')
                                <input type="checkbox" disabled >
                            @endif
                            
                        </td>
                        <td scope="col">{{$product['product_code']}}</td>
                        <td scope="col">
                            <img src=" {{asset('assets/image/product/' . $product->product_image)}}" width="110px" height="100px">
                        </td>
                        <td scope="col">{{$product['product_name']}}</td>
                        <td scope="col">
                            @if ($product->product_stock_quantity == 0)
                                <p class="text-danger fw-bold">Out of Stock</p>
                            @endif
                            @if ($product->product_stock_quantity <= 10 && $product->product_stock_quantity > 0)
                                <p class="text-danger fw-bold">{{$product['product_stock_quantity']}}</p>
                                <p class="text-danger fw-bold">Low Quantity</p>
                            @endif
                            @if ($product->product_stock_quantity > 10)
                                {{$product['product_stock_quantity']}}
                            @endif
                        </td>
                        <td scope="col">{{$product['product_price']}}</td>
                        <td scope="col">
                            @if ($product->product_status == 'Shown')
                                <p class="text-success">{{$product['product_status']}}</p>
                            @endif
                            @if ($product->product_status == 'Hide')
                                <p class="text-danger">{{$product['product_status']}}</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-success float-end" id="add_product" name="add_product">Add</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Add Product Modal -->

<!-- Page content-->
<div class="container-fluid px-4">
                    
    <div class="card mt-4">
        <div class="card-header">
            <h3 class=""><i class="fa fa-podcast" style="color:red"></i>  Live Setup</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/live/setup/successful')}}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="fb_link"> Facebook Live ID </label>
                    <input type="text" class="form-control" value=" " readonly>
                    <a href="{{route('get_live_stream')}}" class="btn btn-info float-end " title="click"> <i class="fa fa-key" aria-hidden="true"></i></a>
                </div>

                <!-- Add Product for prepare to sell -->
                <div class="mb-3">
                    <label for="product_add"> Product Upload </label>
                    <a  href="#AddProductModal" type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#AddProductModal">Add Product</a>
                    <br>
                    <table id="product_show" class="table table-hover datatable" name="product_show">
                        <thead>
                             <tr class="align-middle" style="text-align:center">
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price (RM)</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody name="product_show" id="product_show">
                            <tr>
                            
                            </tr>
                        </tbody>
                        </table>
                </div>
                <br><br>
                <div class="mb-5">
                    <button type="submit" class="btn btn-success float-end">Start Live</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    
    $( document ).ready(function() {
       
        $('body').on('click', '.get_product', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('get_product')}}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {id: id},
                success: function (data) {
                    $('.addbody').html(data);
                    $('#AddProductModal').modal('show');
                },
            });
        });
        
        $("#add_product").click(function(){
            $('input[name=product_select]').change(function() {
                $('#product_show').val(
                    $('[name=product_select]:checked').map(function() {
                        return $(this).val();
                    }).get().join(',')
                );
            });
        });

        //set the function
        $("#add_product_old").click(function(){
            /* check for your table where to send the data from the current table then
            use the selector for the checkboxes when clicked */
            $('#product_select input[type="checkbox"]:checked').each(function(){

                var getRow = $(this).parents('tr'); //variable for the entire row
                var value = (getRow.find('td:eq(2)').html()); //data for names
                var value1 = (getRow.find('td:eq(3)').html()); //data for specialty
                var value3 = (getRow.find('td:eq(1)').html()); //data for prc


                $('#product_show tr:last').append('<tr><td></td><td><input type="text" class="form-control" name="name[' + id + ']" id="prc" value="' + value3 + '" readonly></td><td><input type="text" class="form-control" value="' + value + '" id="names" name="image[' + id + ']" readonly></td> <td><input type="text" class="form-control" value="' + value1 + '" id="specialties" name="price[' + id + ']" readonly></td> </tr>');
                /* then append your row (include the variables to the value of the textboxes. 
                 I use textboxes for it may able to save the data in the database later. :) */

                $("#AddProductModal").modal('hide');

            });
        });

        
    });
 </script>
@endpush