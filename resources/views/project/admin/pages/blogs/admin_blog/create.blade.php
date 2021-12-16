@extends('layouts.admin')
@section('title','Admin Blog')
@section('css')
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Create New Post</h1>
</div>

<div class="section-body">
    <h2 class="section-title">Create New Post</h2>
    <p class="section-lead">
    On this page you can create a new post and fill in all fields.
    </p>
    <div class="card">
        <div id="accordion">
            <div class="accordion">
            <div class="card-header" data-toggle="collapse" data-target="#panel-body-1">
                <h4>Add Meta</h4>
                <i class="fa fa-angle-down ml-auto"></i>
            </div>
            <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
                <div class="card-body">
                    <div class="form-group">
                        <label>Meta Title <span style="color: red">*optional</span></label>
                        <input name="meta_title" value="" type="text" class="form-control" placeholder="Input Meta Title">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Meta Description <span style="color: red">*optional</span></label>
                        <textarea style="height: 200px" name="meta_description" value="" type="text" class="form-control" placeholder="Input Meta Description"></textarea>
                        @error('meta_description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div id="accordion">
            <div class="accordion">
            <div class="card-header" data-toggle="collapse" data-target="#panel-body-2" >
                <h4>Add Thumbnail</h4>
                <i class="fa fa-angle-down ml-auto"></i>
            </div>
            <div class="accordion-body collapse show" id="panel-body-2" data-parent="#accordion">
                <div class="card-body">
                    <div class="form-group text-center">
                        <div class="col-sm-12">
                            <div id="image-preview" class="image-preview w-50 mx-auto">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="image" id="image-upload" />
                            </div>
                        </div>
                        <span class="text-danger">p</span>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Write Your Blog</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                        <div class="col-sm-12 col-md-7">
                            <input name="title" type="text" class="form-control" placeholder="Input Blog Title">
                        </div>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric">
                            <option>Tech</option>
                            <option>News</option>
                            <option>Political</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" class="summernotes"></textarea>
                        @error('content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric">
                                <option>Publish</option>
                                <option>Draft</option>
                                <option>Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary">Create Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('templates/stisla/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
<script>
    $.uploadPreview({
        input_field: "#image-upload",   // Default: .image-upload
        preview_box: "#image-preview",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Choose File",   // Default: Choose File
        label_selected: "Change File",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
    });
</script>
<script>
    $(".summernotes").summernote({
        dialogsInBody: true,
        minHeight    : 1000,
    });
</script>
@if (Session::has('success'))
    <script>
        swal("Success!", "{{ Session::get('success') }}", "success");
    </script>
@endif

@if($errors->any())
    <script>
        var msg = "{{ implode(' \n', $errors->all(':message')) }}";
        swal("Error!", msg , "error");
    </script>
@endif

@endsection