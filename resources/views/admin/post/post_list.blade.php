@extends('layouts.master')

@section('title','Facebook Post List')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Facebook Post</h4>
            <form class="input-group mb-3" type="get" action="{{url('#')}}">
                <input class="form-control mr-sm-2" name="query" type="serach" placeholder="Search For Live ID"/>
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>

            <a  href="{{url('admin/live/setup')}}" class="btn btn-outline-primary openaddmodal float-end">Live Setup</a>
            <a  href="javascript:void(0)" data-id="" class="btn btn-outline-primary openaddmodal">Add Post</a>
        </div>
        <div class="card-body">
        
        <table id="datatable" class="table table-hover datatable">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col">#</th>
            <th scope="col">image</th>
            <th scope="col">name</th>
            <th scope="col">message</th>
            <th scope="col">status</th>
            <th scope="col">action</th>
            </tr>
            @foreach($posts as $post)
            @if($post::count() == 0)
            <tr>
                <td>no data
                </td>
            </tr>
            @endif
            <tr class="align-middle" style="text-align:center">
                <td scope="col">
                   
                </td>
                <td scope="col">{{$post['name']}}</td>
                <td scope="col">
                    <img src=" {{asset('assets/image/product/' . $post->image)}}" width="110px" height="100px">
                </td>
                <td scope="col">{{$post['message']}}</td>
                <td scope="col">
                    @if ($post->status == 'active')
                        <p class=" badge badgesize badge-success right changestatus text-success">{{$post['status']}}</p>
                    @endif
                    @if ($post->status == 'inactive')
                        <p class=" badge badgesize badge-success right changestatus text-danger">{{$post['status']}}</p>
                    @endif
                </td>
                <td scope="col">
                    <a href="javascript:void(0)" data-toggle="modal" class="btn btn-success btn-sm openaddmodal" ><i class="fas fa-pencil-alt"></i></a> 
                    <a href="#" data-toggle="modal" class="btn btn-danger btn-sm delete_record" ><i class="fas fa-trash-alt"></i></a>
                    <a href="javascript:void(0)"   class="btn btn-info btn-sm publishToProfile" ><i class="fab fa-facebook-square"></i></a>
                </td>
                
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

@push('scripts')
<script>
    $('body').on('click', '.openaddmodal', function () {
            var id = $(this).data('id');
            if (id == '') {
                $('.modal-title').text("Create");
            } else {
                $('.modal-title').text("Update");
            }
            $.ajax({
                url: "{{ route('getmodal')}}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {id: id},
                success: function (data) {
                    $('.addbody').html(data);
                    $('.add_modal').modal('show');
                },
            });
        });
        $('body').on('submit', '.formsubmit', function (e) {
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
                        $('.add_modal').modal('hide');
                        
                        //$("#datatable").DataTable().ajax.reload();
                    }
                }
            });
        });
        $('body').on('click','.publishToProfile',function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('page')}}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data:{id:id},
                success:function(data){
                    if (data.status == 200) {
                        $.confirm({
                            title: 'Success!',
                            content: data.msg,
                            autoClose: 'cancelAction|3000',
                            buttons: {
                                cancelAction: function (e) {}
                            }
                        })
                    }
                    if (data.status == 400) {
                        $.alert({
                            title: 'Alert!',
                            content: data.msg,
                        });
                    }
                }
            });
        });
 </script>
@endpush