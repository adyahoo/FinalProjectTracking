@extends('layouts.project_manager')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="section-header" style="display: block">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <h1>{{ $project->name }}</h1>
            </div>
            <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
                <p>Latest Version v{{ $latestVersion->version_number }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project_manager.projects.detail', $project) }}">Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project_manager.projects.module.all', $project) }}">Modules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active-tab" href="{{ route('project_manager.projects.version.all', $project) }}">Version</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logs</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
                <a href="#" class="btn btn-icon btn-primary"><i class="fa fa-cog"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project Versions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>Version</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($project->project_versions as $version)
                                    <tr>
                                        <td>
                                            {{ $version->version_number }}
                                        </td>
                                        <td>
                                            {{ $version->description }}
                                        </td>
                                        <td>
                                            <a href="{{ route('project_manager.projects.version.detail', [$project, $version]) }}" class="btn btn-secondary btn-action mr-1" data-toggle="tooltip" title="Notes"><i class="fas fa-sticky-note"></i></a>
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

@section('script')
    <script src="{{ asset('templates/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
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
    <script>
        $(".btn-add").click(function(){
            let action = $(this).data('action');
            $('#title').text('Add Role')
            $('#form').attr('action', action);
            $("#form").attr("method", "post");
        });

        $(".btn-edit").click(function(){
            let action = $(this).data('action');
            let detail = $(this).data('detail');
            $('#title').text('Edit Role')
            $('#form').attr('action', action);
            $("#form").attr("method", "post");
            $("#method").attr("value", "put");
            $.get(detail, function (data) {
                $('#roleName').val(data.name);
                $('#privilege').val(data.privilege);
            });
        });
    </script>
@endsection