<!-- Checkout Order Page -->
@extends('layouts.master')

<!-- Page Title -->
@section('title','Order')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">

    <!--Message shown when order had successful checkout -->
    @if(session()->has('success'))
    <div class="card mt-4" id="message_show">
        <div class="card-body"> 
            <div class="alert alert-success">
                {{ session()->get('success') }}
                <button id="close" type="button" class="close float-right" data-dismiss="alert" aria-label="Close" style="float: right">
                    <span aria-hidden="true" class="float-right">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!--Message shown when order had fail checkout-->
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

    <!-- Checkout -->
    <div class="card mt-4">
        <div class="card-header">
            <h4 class=""> <a href="javascript:history.back()" style="color:#000000"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a> Checkout</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/sales/checkout/save')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="order_id" class="form-control" name="order_id" value="{{$order_id}}">
                <h5> Personal Detail </h5>
                <!-- Input First Name ---->
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 col-form-label"> First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter First Name"
                        name="fname" value="{{old('fname')}}">
                        <span class="text-danger">@error('fname') {{$message}} @enderror </span>
                    </div>
                </div>
                <br>
                 <!-- Input Last Name ---->
                <div class="form-group row">
                    <label for="lname" class="col-sm-2 col-form-label"> Last Name </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Last Name"
                         name="lname" value="{{old('lname')}}">
                        <span class="text-danger">@error('lname') {{$message}} @enderror </span>
                    </div>
                </div>
                <br>
                 <!-- Input Contact No ---->
                <div class="form-group row">
                    <label for="contact_no" class="col-sm-2 col-form-label"> Contact No </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Contact No"
                         name="contact_no" value="{{old('contact_no')}}">
                    <span class="text-danger">@error('contact_no') {{$message}} @enderror </span>
                    </div>
                </div>
                <br>
                 <!-- Input Address ---->
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label"> Address </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Address"
                         name="address" value="{{old('address')}}">
                    <span class="text-danger">@error('address') {{$message}} @enderror </span>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-10">
                    </div>
                </div>
                 <!-- Input City | State | Postcode ---->
                <div class="input-group">
                    <span class="input-group-text">City</span>
                    <input type="text" class="form-control" name="city" value="{{old('city')}}"
                        placeholder="Enter City" />
                    <span class="text-danger">@error('city') {{$message}} @enderror </span>
                    <span class="input-group-text" 
                        style="border-left: 0; border-right: 0;">
                        State
                    </span>
                    <input type="text" class="form-control"  name="state" value="{{old('state')}}"   
                        placeholder="Enter State" />
                    <span class="text-danger">@error('state') {{$message}} @enderror </span>
                    <span class="input-group-text" 
                        style="border-left: 0; border-right: 0;">
                        Postcode
                    </span>
                    <input type="text" class="form-control"  name="postcode" value="{{old('postcode')}}"   
                        placeholder="Enter Postcode" />
                    <span class="text-danger">@error('postcode') {{$message}} @enderror </span>
                </div>
                <hr>
                <!-- Input Payment Detail ---->
                <h5> Payment </h5>
                 <!-- Upload Payment Slip If got ---->
                <div class="form-group row">
                    <label for="payment_slip" class="col-sm-2 col-form-label"> Upload Payment Slip </label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control" placeholder="Upload Payment Slip"
                         name="payment_slip" value="{{old('payment_slip')}}">
                    <span class="text-danger">@error('payment_slip') {{$message}} @enderror </span>
                    </div>
                </div>
                <br>
                <!-- Payment Method ---->
                <div class="form-group row">
                    <label for="payment_method" class="col-sm-2 col-form-label"> Payment Method </label>
                    <div class="col-sm-10">
                        <select id="payment_method" name="payment_method" class="form-control">
                            <option selected>Choose Payment Method</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="E-wallet">E-wallet</option>
                            <option value="Cash">Cash</option>
                          </select>
                    <span class="text-danger">@error('payment_method') {{$message}} @enderror </span>
                    </div>
                </div>
                <br>
                <!-- Payment Amount ---->
                <div class="form-group row">
                    <label for="payment_amount" class="col-sm-2 col-form-label"> Payment Amount </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Payment Amount"
                         name="payment_amount" value="{{old('payment_amount')}}">
                    <span class="text-danger">@error('payment_amount') {{$message}} @enderror </span>
                    </div>
                </div>
                <hr>
                <!-- Input Shipping Detail ---->
                <h5> Shipping </h5>
                <!-- Select Shipping Method ---->
                <div class="form-group row">
                    <label for="shipping_method" class="col-sm-2 col-form-label"> Shipping Method </label>
                    <div class="col-sm-10">
                        <select id="shipping_method" name="shipping_method" class="form-control">
                            <option selected>Choose Shipping Method</option>
                            <option value="Self Collect">Self Collect</option>
                            <option value="GDex">GDex</option>
                            <option value="J&T">J&T</option>
                            <option value="Pos Laju">Pos Laju</option>
                          </select>
                    <span class="text-danger">@error('payment_method') {{$message}} @enderror </span>
                    </div>
                </div>
                <hr>
                <h5> Product </h5>
                <table id="product_show" class="table table-hover datatable" name="product_show">
                    <thead>
                         <tr class="align-middle" style="text-align:center">
                            <th scope="col"></th>
                            <th scope="col">Live ID</th>
                            <th scope="col">Product</th>
                            <th scope="col">Bid Code</th>
                            <th scope="col">Price (RM)</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                        </tr>
                    </thead>
                    <!-- list out all order product -->
                    <tbody name="product_show" id="product_show">
                        @foreach($order as $order)
                        <input type="hidden" id="order_id" class="form-control" name="order_id" value="{{$order->order_id}}">
                        <tr class="align-middle" style="text-align:center">
                            <td scope="col"> </td>
                            <td scope="col">{{$order->live_stream_id}}</td>
                            <td scope="col">
                                <img src=" {{asset('assets/image/product/' . $order->product_image)}}" width="110px" height="100px"/><br>
                                {{$order->product_name}}
                            </td>
                            <td scope="col">{{$order->product_code}}</td>
                            <td scope="col">{{$order->product_price}}</td>
                            <td scope="col">{{$order->quantity}}</td>
                            <td scope="col">{{$order->total_amount}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td scope="col" colspan="6" style="font-weight:bold">Total Amount</td>
                            <td scope="col" >{{$order->total_order_amount}}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success float-end">Turn Order</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    //close the message after add
    $(document).ready(function () {
        
        $("#message_show").hide().fadeIn(1000);

        //close the message when the button with id="close" is clicked
        $("#close").on("click", function (e) {
            e.preventDefault();
            $("#message_show").fadeOut(1000);
        });
    });
</script>
@endpush