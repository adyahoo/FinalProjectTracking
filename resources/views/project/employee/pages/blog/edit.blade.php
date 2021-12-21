@extends('layouts.employee')

@section('title','Update Blog')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{route('employee.blogs.all')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Edit Blog</h1>
    </div>
    <div class="section-body">
        <form action="{{route('employee.blogs.update', $blog)}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <h2 class="section-title">Edit Blog</h2>
            <p class="section-lead">On this page, you can edit your blog.</p>
            <div class="card">
                <div id="accordion">
                    <div class="accordion">
                        <div class="card-header" data-toggle="collapse" data-target="#panel-body-1">
                            <h4>Edit Meta Data</h4>
                            <i class="fa fa-angle-down ml-auto"></i>
                        </div>
                        <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Meta Title <sup style="color: red">*optional</sup></label>
                                    <input name="meta_title" value="{{ $blog->meta_title }}" type="text" class="form-control" placeholder="Input Meta Title">
                                    @error('meta_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Meta Description <sup style="color: red">*optional</sup></label>
                                    <textarea style="height: 200px" name="meta_description" value="" type="text" class="form-control" placeholder="Input Meta Description">{{ $blog->meta_description }}</textarea>
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
                            <h4>Edit Thumbnail</h4>
                            <i class="fa fa-angle-down ml-auto"></i>
                        </div>
                        <div class="accordion-body collapse show" id="panel-body-2" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group text-center">
                                    <div class="col-sm-12">
                                        <label for="image-upload">Choose Thumbnail</label>
                                        <div class="col-md-6 col-lg-6 mx-auto">
                                            <input name="image" class="form-control" value="{{ old('image') }}" type="file" onchange="showPreview(event);" accept="image/jpg, image/jpeg, image/gif"/>
                                            @if($blog->image)
                                                <img id="thumbnail" class="img-fluid" id="propic" src="{{ Storage::url('blog_images/'.$blog->image) }}" alt="">
                                            @else
                                                <img id="thumbnail" class="img-fluid" id="propic" src="https://via.placeholder.com/1920x1080" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
                            <h4>Edit Your Blog</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                <div class="col-sm-12 col-md-7">
                                    <input value="{{ $blog->title }}" name="title" type="text" class="form-control" placeholder="Input Blog Title">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Slug <sup style="color: red">*optional</sup></label>
                                <div class="col-sm-12 col-md-7">
                                    <input value="{{ str_replace('-', '', $blog->slug) }}" name="slug" type="text" class="form-control" placeholder="Input Slug">
                                    @error('slug')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="blog_category_id" class="form-control selectric">
                                        <option value="">Select Blog Category</option>
                                        @foreach ($categories as $blog_category)
                                            <option {{ $blog->blog_category_id == $blog_category->id ? 'selected' : '' }} value="{{$blog_category->id}}">{{$blog_category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('blog_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <textarea name="content" class="summernotes">{{ $blog->content }}</textarea>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="status" class="form-control selectric">
                                        <option {{ $blog->status == $blog->statusOption['draft'] ? 'selected' : '' }} value="{{ $blog->statusOption['draft'] }}">{{ $blog->statusOption['draft'] }}</option>
                                        <option {{ $blog->status == $blog->statusOption['waiting_for_review'] ? 'selected' : '' }} value="{{ $blog->statusOption['waiting_for_review'] }}">{{ $blog->statusOption['published'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">Edit Blog</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('templates/stisla/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("thumbnail");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
    <script>
        $(".summernotes").summernote({
            dialogsInBody: true,
            minHeight    : 1000,
        });
    </script>
    @if (Session::has('success'))
        <script>
            swal("Success!", "{{ Session::get('success') }}", "success").then(function(){
                window.location.reload(window.location.href)
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            var msg = "{{ implode(' \n', $errors->all(':message')) }}";
            swal("Error!", msg , "error");
        </script>
    @endif
@endsection