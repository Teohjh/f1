@extends('layouts.master')

@section('title','Facebook Post List')

@section('admin_content')

<!-- Add Post Modal -->
<div class="modal fade" id="AddPostModal" tabindex="-1" aria-labelledby="AddPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="AddPostModalLabel">Add Post</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="formsubmit" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($data) && !empty($data->id))
                    <input type="hidden" name="id" value="{{ encrypt($data->id) }}">
                @endif
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" name="message" id="message" cols="" rows="5"
                        required>{{ $data->message ?? '' }}</textarea>
                </div>
                <div class="form-group row">
                    &nbsp;&nbsp; Image
                    <div class="col-md-12">
                        <div class="avatar-upload" style="margin: 2px;">
                            <div class="avatar-edit">
                                <input type="file" name="image" id="image" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add <samp class="spinner"></samp></button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
<!-- End Add Post Modal -->

<!-- Add Edit Modal -->
<div class="modal fade" id="EditPostModal" tabindex="-1" aria-labelledby="EditPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="EditPostModalLabel">Edit Post</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

                    <input type="hidden" name="id">
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" name="message" id="message" cols="" rows="5"
                        required></textarea>
                </div>
                <div class="form-group row">
                    &nbsp;&nbsp; Image
                    <div class="col-md-12">
                        <div class="avatar-upload" style="margin: 2px;">
                            <div class="avatar-edit">
                                <input type="file" name="image" id="image" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_post" id="update_post">Edit <samp class="spinner"></samp></button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
<!-- End Edit Post Modal -->

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
            <a  href="{{route('getPostPage')}}" type="button" class="btn btn-outline-primary">Get Post From Facebook</a>
            <a  href="#AddPostModal" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#AddPostModal">Add Post</a>
        </div>
        <div class="card-body">
        
        <table id="post_table" class="table table-hover post_table">
        <thead>
             <tr class="align-middle" style="text-align:center">
                <th scope="col">#</th>
                <th scope="col">Date | Time</th>
                <th scope="col">Image</th>
                <th scope="col">message</th>
                <th scope="col">status</th>
            </tr>
            
            @foreach($posts as $post)
            <tr class="align-middle" style="text-align:center">
                <td scope="col">{{$post['id']}}</td>
                <td scope="col">{{$post['date_time']}}</td>
                <td scope="col">
                    @if(empty($post['image']))
                         <p class="text-danger">No Image</p>
                    @elseif(($post['image'] !=" "))
                        <img src=" {{asset('assets/image/post/' . $post->image)}}" width="110px" height="100px">
                    @endif
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
              
            </tr>
            @endforeach
            @if($posts->isEmpty())
            <tr class="align-middle" style="text-align:center">
                <td colspan="6" style="color:#ff0000">No Post</td>
            </tr>
            @endif
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
    
    $( document ).ready(function() {
       
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
                        $('#AddPostModal').modal('hide');
                        
                        //$("#post_table").ajax.reload();
                        window.location.reload();
                    }
                }
            });
        });
        $(document).on('click', '.edit_post', function (e) {
            e.preventDefault();
            var id = $(this).val();
            // alert(id);
            $('#EditPostModal').modal('show');
            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "/admin/facebook/post/getmodal/edit/" + id,
                success: function (response) {
                    if (response.status >= 400) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#EditPostModal').modal('hide');
                    } else {
                        // console.log(response.post.name);
                        $('#EditPostModal #name').val(response.post.name);
                        $('#EditPostModal #image').val(response.post.image);
                        $('#EditPostModal #message').val(response.post.message);
                        $('#id').val(id);
                    }
                }
            });
            $('.btn-close').find('input').val('');

        });
        $(document).on('click', '.update_post', function (e) {
            e.preventDefault();

            $(this).text('Updating..');
            var id = $('#id').val();
            // alert(id);

            var data = {
                'name': $('#name').val(),
                'message': $('#message').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/admin/facebook/post/getmodal/update/" + id,
                data: data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 400) {
                        $('#update_msgList').html("");
                        $('#update_msgList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#update_msgList').append('<li>' + err_value +
                                '</li>');
                        });
                        $('.update_post').text('Update');
                    } else {
                        $('#update_msgList').html("");

                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#EditPostModal').find('input').val('');
                        $('.update_post').text('Update');
                        $('#EditPostModal').modal('hide');

                        window.location.reload();
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
    });
 </script>
@endpush