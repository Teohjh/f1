
@extends('layouts.master')

@section('title','Sales Order List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
     <!--Message shown when sales order didn't select after click  'Turn Order' -->
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
            <h3 class="">Sales Order List</h3>
            <div class="mb-2">
                <form class="input-group mb-3" type="get" action="{{url('#')}}">
                    <input class="form-control" name="query" type="serach" placeholder="Search For FB Name"/>
                    <button class="btn btn-outline-dark  " type="submit">Search</button>
                </form>
            </div>
        </div>
        <form action="{{ route('turn_order') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <button type="submit" class="btn btn-success float-end">Turn Order</button>
        </div>
        
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col"></th>
                <th scope="col">Live ID</th>
                <th scope="col">Product Code</th>
                <th scope="col">Product</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Comment</th>
                <th scope="col">Quantity</th>
                <th scope="col">Amount (RM) </th>
                <th scope="col">Status </th>
            </tr>
        </thead>
        <!-- list out all bid product -->
        <tbody>
            @foreach($sales_order as $sales_orders)
            <?php
                $bid_id = $sales_orders->bid_id;
            ?>
            <tr class="align-middle" style="text-align:center">
                <td scope="col">
                    @if ($sales_orders->status == 'Unpaid')
                        <input type="checkbox" name="sales_order_select[]" value="{{ $sales_orders->sales_order_id }}">
                    @endif
                    @if ($sales_orders->status == 'Paid')
                        <input type="checkbox" disabled >
                    @endif
                </td>
                <td scope="col">{{$sales_orders->live_stream_id}}</td>
                <td scope="col">{{$sales_orders->product_code}}</td>
                <td scope="col">
                    <img src=" {{asset('assets/image/product/' . $sales_orders->product_image)}}" width="110px" height="100px"/><br>
                    {{$sales_orders->product_name}}
                </td>
                <td scope="col">{{$sales_orders->name}}</td>
                <td scope="col">{{$sales_orders->comment}}</td>
                <td scope="col">{{$sales_orders->quantity}}</td>
                <td scope="col">{{$sales_orders->total_amount}}</td>
                <?php
                    $status = $sales_orders->status;
                ?>
                @if($status == "Unpaid")
                <td scope="col"><p style="color:red;">{{$sales_orders->status}}</p></td>
                @elseif($status == "Paid")
                <td scope="col"><p style="color:green;">{{$sales_orders->status}}</p></td>
                @endif
            </tr>
            @endforeach
        </tbody>
        </form>
        </table>

        </div>
    </div>
</div>



@endsection

@push('scripts')
<script>
    
    $( document ).ready(function() {
       
        //close the message when the button with id="close" is clicked
        $("#close").on("click", function (e) {
            e.preventDefault();
            $("#message_show").fadeOut(1000);
        });
        
    });
 </script>
@endpush