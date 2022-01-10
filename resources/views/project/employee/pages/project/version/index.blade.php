@extends('layouts.employee')

@section('title','Project Version List')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    @include('project.employee.include.project_page_tab_version', [
        'project'        => $project,
        'requestVersion' => $request->version
    ])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project Versions <span class="badge badge-secondary">{{ $project->projectVersions->count() }}</span></h4>
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
                                            <a href="{{ route('employee.projects.version.detail', [$project, $version]) }}" class="btn btn-secondary btn-action mr-1" data-toggle="tooltip" title="Notes"><i class="fas fa-sticky-note"></i></a>
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
    <script>
        $("#table-1").dataTable({
        });
    </script>
@endsection