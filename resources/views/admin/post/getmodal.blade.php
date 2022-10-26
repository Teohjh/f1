<form class="formsubmit" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($data) && !empty($data->id))
        <input type="hidden" name="id" value="{{ encrypt($data->id) }}">
    @endif
    <div class="form-group">
        <label>name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $data->name ?? '' }}" required>
    </div>
    <div class="form-group">
        <label>message</label>
        <textarea class="form-control" name="message" id="message" cols="" rows="5"
            required>{{ $data->message ?? '' }}</textarea>
    </div>
    <div class="form-group row">
        &nbsp;&nbsp; image
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
        <button type="submit" class="btn btn-primary">Submit <samp class="spinner"></samp></button>
    </div>

</form>

{{-- Add Post Modal --}}
<div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddStudentModalLabel">Add Student Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="formsubmit" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($data) && !empty($data->id))
                        <input type="hidden" name="id" value="{{ encrypt($data->id) }}">
                    @endif
                    <div class="form-group">
                        <label>name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $data->name ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label>message</label>
                        <textarea class="form-control" name="message" id="message" cols="" rows="5"
                            required>{{ $data->message ?? '' }}</textarea>
                    </div>
                    <div class="form-group row">
                        &nbsp;&nbsp; image
                        <div class="col-md-12">
                            <div class="avatar-upload" style="margin: 2px;">
                                <div class="avatar-edit">
                                    <input type="file" name="image" id="image" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit <samp class="spinner"></samp></button>
                    </div>
                
                </form>
        </div>
    </div>
</div>
{{--End Add Post Modal --}}

{{-- Edit Post Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit & Update Student Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <ul id="update_msgList"></ul>

                <input type="hidden" id="stud_id" />

                <div class="form-group mb-3">
                    <label for="">Full Name</label>
                    <input type="text" id="name" required class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Course</label>
                    <input type="text" id="course" required class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" id="email" required class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Phone No</label>
                    <input type="text" id="phone" required class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary update_student">Update</button>
            </div>

        </div>
    </div>
</div>
{{-- End Edit Post Modal --}}