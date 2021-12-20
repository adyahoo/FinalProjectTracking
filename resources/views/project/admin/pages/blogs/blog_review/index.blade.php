@extends('layouts.admin')
@section('title','Blog Review')
@section('css')
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-header">
    <h1>Blog Review Management</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Waiting for Review Data</h4>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th style="width: 10%">
                                        No.
                                    </th>
                                    <th>Blog Title</th>
                                    <th>Blog Category</th>
                                    <th>Status</th>
                                    <th>Written by</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviewBlogs as $blog)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>{{$blog->title}}</td>
                                        <td>{{$blog->blogCategory->name}}</td>
                                        <td>
                                            <span class="badge badge-warning">{{$blog->status}}</span>
                                        </td>
                                        <td>{{$blog->user->name}}</td>
                                        <td>
                                            <a title="Preview Blog" href="{{route('admin.blog.preview', $blog->slug)}}" class="btn btn-primary btn-edit"><i class="fa fa-eye"></i></a>
                                            <a title="Review Blog" data-id="{{$blog->id}}" data-action="{{route('admin.review.review', $blog)}}" href="#" class="btn btn-info btn-add" data-toggle="modal" data-target="#modal"><i class="fa fa-star"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Blog Review Data</h4>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-2">
                            <thead>
                                <tr>
                                    <th style="width: 10%">
                                        No.
                                    </th>
                                    <th>Blog Title</th>
                                    <th>Blog Category</th>
                                    <th>Status</th>
                                    <th>Written by</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>{{$blog->title}}</td>
                                        <td>{{$blog->blogCategory->name}}</td>
                                        <td>
                                            @if($blog->status == 'Published')
                                                <span class="badge badge-success">{{$blog->status}}</span>
                                            @else
                                                <span class="badge badge-danger">{{$blog->status}}</span>
                                            @endif
                                        </td>
                                        <td>{{$blog->user->name}}</td>
                                        <td>
                                            <a title="Preview Blog" href="{{route('admin.blog.preview', $blog->slug)}}" class="btn btn-primary btn-edit"><i class="fa fa-eye"></i></a>
                                            <a title="Review Blog" data-id="{{$blog->id}}" data-action="{{route('admin.review.review', $blog)}}" href="#" class="btn btn-info btn-add" data-toggle="modal" data-target="#modal"><i class="fa fa-star"></i></a>
                                            <a title="Show Review List Detail" href="{{route('admin.review.show', $blog)}}" href="#" class="btn btn-secondary btn-edit"><i class="fa fa-list"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
        <form id="form" action="" method="" enctype="multipart/form-data">
            @csrf
            <input id="method" type="hidden" name="_method" value="" />
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="title" class="modal-title">Blog Review Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="Published">Publish</option>
                            <option value="Rejected">Reject</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Review</label>
                        <textarea name="reviews" class="summernotes"></textarea>
                        @error('reviews')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="hidden" value="" name="blog_id" id="blog_id">
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id" id="user_id">
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('templates/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
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
<script>
    $("#table-1").dataTable({
        
    });
</script>
<script>
    $("#table-2").dataTable({
        
    });
</script>
<script>
    $(".summernotes").summernote({
        dialogsInBody: true,
        minHeight: 250,
        toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['paragraph', 'ul', 'ol'],
            ]
        ]
    });
</script>
<script>
    $(".btn-add").click(function(){
        let action = $(this).data('action');
        let id     = $(this).data('id');
        $('#title').text('Add Review')
        $('#form').attr('action', action);
        $("#form").attr("method", "post");
        $('#blog_id').val(id);
    });
</script>
@endsection