@extends('layouts.project_manager')

@section('title','Blogs')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="section-header">
        <h1>Blogs</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>My Blogs</h4>
                        <a href="{{ route('project_manager.blogs.create') }}" class="btn btn-primary btn-round ml-auto btn-add text-white">
                            <i class="fa fa-plus"></i>
                            Add Blog
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">
                                            No.
                                        </th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Published At</th>
                                        <th>View Count</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($blog->status == $blog->statusOption['waiting_for_review'])
                                                        badge-primary
                                                    @elseif($blog->status == $blog->statusOption['draft'])
                                                        badge-light
                                                    @elseif($blog->status == $blog->statusOption['published'])
                                                        badge-success
                                                    @elseif($blog->status == $blog->statusOption['rejected'])
                                                        badge-danger
                                                    @endif
                                                ">
                                                    {{ $blog->status }}
                                                </span>
                                            </td>
                                            <td>
                                                @empty($blog->published_at)
                                                    Not published yet
                                                @else
                                                    {{ $blog->published_at }}
                                                @endempty
                                            </td>
                                            <td>{{ $blog->view_count }}</td>
                                            <td>
                                                <a href="{{ route('project_manager.blogs.preview', $blog->slug) }}" class="btn btn-primary btn-edit"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('project_manager.blogs.edit', $blog) }}" class="btn btn-info btn-edit"><i class="fa fa-pencil-alt"></i></a>
                                                <a onclick="deleteConfirm('del{{ $blog->id }}')" class="btn btn-danger text-white" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <form id="del{{ $blog->id }}" action="{{ route('project_manager.blogs.destroy', $blog) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
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

@section('script')
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
        window.deleteConfirm = function(formId) {
            swal({
                title: 'Delete Confirmation',
                icon: 'warning',
                text: 'Do you want to delete this?',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('#'+formId).submit();
                }
            });
        }
    </script>
    <script>
        $("#table-1").dataTable({
        });
    </script>
@endsection