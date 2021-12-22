@extends('layouts.admin')
@section('title','Project Version')
@section('css')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    @include('project.admin.include.project_page_tab', [
        'project'             => $project,
        'latestVersionNumber' => $latestVersion->version_number
    ])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project Versions <span class="badge badge-secondary">{{ $project->projectVersions->count() }}</span></h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.admin_projects.version.create', $project) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Version</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Version</th>
                                    <th>Description</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($project->projectVersions as $version)
                                    <tr>
                                        <td>
                                            {{ $version->version_number }}
                                        </td>
                                        <td>
                                            {{ $version->description }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.admin_projects.version.detail', [$project, $version]) }}" class="btn btn-secondary btn-action mr-1" data-toggle="tooltip" title="Notes"><i class="fas fa-sticky-note"></i></a>
                                            <a href="{{ route('admin.admin_projects.version.edit', $version) }}" class="btn btn-primary btn-edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="#" onclick="deleteConfirm('del{{ $version->id }}')" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="del{{ $version->id }}" action="{{ route('admin.admin_projects.version.destroy', $version) }}" method="POST">
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