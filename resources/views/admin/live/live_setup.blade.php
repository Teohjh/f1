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
            <!--<form class="form_add_product_old" action="{{ route('save_bid_product', ["a"]) }}" method="POST" enctype="multipart/form-data">
                @csrf-->
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            @if($live_stream_id = "NO LIVE ON")
                <button type="submit" class="btn btn-primary">Add <samp class="spinner"></samp></button>
            @else
                <button type="submit" class="btn btn-primary">Add <samp class="spinner"></samp></button>
            @endif
        </div>
    </div>
    </div>
</div>
<!-- End Add Product Modal -->

<!-- Page content-->
<div class="container-fluid px-4">
    <!--Message shown when Live ID didn't retrieve from Facebook-->
    @if(session()->has('fail'))
    <div class="card mt-4" id="message_show">
        <div class="card-body"> 
            <div class="alert alert-danger">
                {{ session()->get('fail') }}
                <button id="close" type="button" class="close float-right" data-dismiss="alert" aria-label="Close" style="float: right">
                    <span aria-hidden="true" class="float-right">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <div class="card mt-4">
        <div class="card-header">
            <h3 class=""><i class="fa fa-podcast" style="color:red"></i>  Live Setup</h3>
        </div>
        <div class="card-body">
                <div class="mb-3">
                <form action="{{ route('save_bid_product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--Get live ID from database -->
                    @foreach($lives as $live)
                        <?php
                        //Find the live_id that status live_on
                            if($live->live_status == "LIVE")
                            {
                                $live_stream_id = $live->live_stream_id;
                            }else{
                                $live_stream_id = "NO LIVE ON";
                            }
                        ?>
                    @endforeach     

                    <!--Input live_id -->
                    <label for="fb_link"> Facebook Live ID </label>
                    <input type="text" class="form-control" name="live_stream_id" id="live_stream_id" value="{{($live_stream_id)}}" readonly>
                    <br>
                    <a href="{{route('get_live_stream')}}" class="btn btn-secondary float-end " title="click"> <i class="fa fa-rss" aria-hidden="true"></i>  Input Facebook Live </a>
                </div> 
                <br>  
        </div>   
            <div class="card-body">
                <!-- Add Product for prepare to sell -->
                <div class="mb-3">
                    <label for="product_add"> Add Bid Product </label>
                    <a  href="#AddProductModal" type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#AddProductModal">Add Product</a>                    <br>
                    <table id="product_show" class="table table-hover datatable" name="product_show">
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
                                        <input type="checkbox" name="product_select[]" value="{{ $product->id }}">
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
                </div>
                <br><br>
                <div class="mb-5">
                    <!--<a href="{{url('admin/live/'. $live_stream_id)}}" type="button" class="btn btn-success float-end">Go Live</a>-->
                    <button type="submit" class="btn btn-success float-end">Go Live</button>
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

        //close the message when the button with id="close" is clicked
        $("#close").on("click", function (e) {
            e.preventDefault();
            $("#message_show").fadeOut(1000);
        });
        
        $('body').on('submit', '.form_add_product', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                data: new FormData(this),
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('.spinner').html('<i class="fa fa-spinner fa-spin"></i>')
                },
                success: function (data) {
                    if (data.status == 400) {
                        $('.spinner').html('');
                        
                    }
                    if (data.status == 200) {
                        $('.spinner').html('');
                        $('#AddProductModal').modal('hide');
                        
                        window.location.reload();
                    }
                }
            });

        });
    });
 </script>
@endpush