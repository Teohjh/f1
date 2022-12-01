<!-- Checkout Order Page -->
@extends('layouts.master')

<!-- Page Title -->
@section('title','View Order')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">

    <!--Message shown when order had modify successful -->
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

    <!--Message shown when order had modify fail-->
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

    <!-- View Order -->
    <div class="card mt-4">
        <div class="card-header">
            <h4 class=""> <a href="javascript:history.back()" style="color:#000000"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a> View Order</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/order/view/update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="order_id" class="form-control" name="order_id" value="{{$orders-> order_id}}">
                @foreach ($shipping as $shippings)
                @foreach ($payment as $payments)
                <input type="hidden" id="payment_id" class="form-control" name="payment_id" value="{{$payments-> payment_id}}">
                <input type="hidden" id="shipping_id" class="form-control" name="shipping_id" value="{{$shippings-> shipping_id}}">
                <h5> Personal Detail </h5>
                <!-- Input First Name ---->
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 col-form-label"> First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter First Name"
                        name="fname" value="{{$shippings-> fname}}">
                        <span class="text-danger">@error('fname') {{$message}} @enderror </span>
                    </div>
                </div>
                <br>
                 <!-- Input Last Name ---->
                <div class="form-group row">
                    <label for="lname" class="col-sm-2 col-form-label"> Last Name </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Last Name"
                         name="lname" value="{{$shippings-> lname}}">
                        <span class="text-danger">@error('lname') {{$message}} @enderror </span>
                    </div>
                </div>
                <br>
                 <!-- Input Contact No ---->
                <div class="form-group row">
                    <label for="contact_no" class="col-sm-2 col-form-label"> Contact No </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Contact No"
                         name="contact_no" value="0{{$shippings-> contact_no}}">
                    <span class="text-danger">@error('contact_no') {{$message}} @enderror </span>
                    </div>
                </div>
                <br>
                 <!-- Input Address ---->
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label"> Address </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Address"
                         name="address" value="{{$shippings-> address}}">
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
                    <input type="text" class="form-control" name="city" value="{{$shippings-> city}}"
                        placeholder="Enter City" />
                    <span class="text-danger">@error('city') {{$message}} @enderror </span>
                    <span class="input-group-text" 
                        style="border-left: 0; border-right: 0;">
                        State
                    </span>
                    <input type="text" class="form-control"  name="state" value="{{$shippings-> state}}"   
                        placeholder="Enter State" />
                    <span class="text-danger">@error('state') {{$message}} @enderror </span>
                    <span class="input-group-text" 
                        style="border-left: 0; border-right: 0;">
                        Postcode
                    </span>
                    <input type="text" class="form-control"  name="postcode" value="{{$shippings-> postcode}}"   
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
                        @if($payments->payment_slip)
                            <img src=" {{asset('assets/image/payment/' . $payments->payment_method)}}" width="110px" height="100px">
                        @else
                            <p class="text-danger"> No Bank Slip Image</p>
                        @endif
                    </div>
                </div>
                <br>
                <!-- Payment Method ---->
                <div class="form-group row">
                    <label for="payment_method" class="col-sm-2 col-form-label"> Payment Method </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name="payment_method" value="{{$payments-> payment_method}}" readonly>
                    </div>
                </div>
                <br>
                <!-- Payment Amount ---->
                <div class="form-group row">
                    <label for="payment_amount" class="col-sm-2 col-form-label"> Payment Amount </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="payment_amount" value="{{$payments-> payment_amount}}" readonly>
                    </div>
                </div>
                <hr>
                <!-- Input Shipping Detail ---->
                <h5> Shipping </h5>
                <!-- Select Shipping Method ---->
                <div class="form-group row">
                    <label for="shipping_method" class="col-sm-2 col-form-label"> Shipping Method </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="shipping_method" value="{{$shippings-> shipping_method}}" readonly>
                    
                    </div>
                </div>
                <br>
                <!------ Shipping Status ------->
                <div class="form-group row">
                    <label for="shipping_status" class="col-sm-2 col-form-label"> Shipping Status </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="shipping_status" 
                    value="{{$shippings-> shipping_status}}" readonly>
                    </div>
                </div>
                <br>
                <!------ Shipping Tracking No. ------->
                <div class="form-group row">
                    <label for="tracking_no" class="col-sm-2 col-form-label"> Tracking No. </label>
                    <div class="col-sm-10">
                    @if ($shippings->shipping_status == 'Received')
                    <input type="text" class="form-control" name="tracking_no" 
                    value="{{$shippings-> tracking_no}}" readonly>
                    @elseif ($shippings->shipping_status == 'Packed')
                    <input type="text" class="form-control" name="tracking_no" 
                    value="{{$shippings-> tracking_no}}" readonly >
                    @else
                    <input type="text" class="form-control" name="tracking_no" placeholder="Enter Tracking No."
                    value="{{$shippings-> tracking_no}}" >
                    @endif
                    </div>
                </div>
                @endforeach
                @endforeach
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
                    <button type="submit" class="btn btn-warning float-end">Edit Order Detail</button>
                </div>
                <br>
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