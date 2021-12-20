@extends('layouts.project_manager')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"/>
@endsection

@section('content')
    <div class="section-header" style="display: block">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <h1>{{ $project->name }}</h1>
            </div>
            <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
                <p>Latest Version v{{ $project->projectVersions->last()->version_number }}</p>
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
                        <a class="nav-link" href="{{ route('project_manager.projects.version.all', $project) }}">Version</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active-tab" href="{{ route('project_manager.projects.logs.all', $project) }}">Logs</a>
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
                    <h4>Project Logs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>Causer</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    @if($log->subject->projectVersion->project_id == $project->id)
                                        <tr>
                                            <td>
                                                <img alt="image" src="{{ asset('templates/stisla/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mb-2 mr-2" width="35" data-toggle="tooltip" title="{{ $log->causer->name }}">
                                                {{ $log->causer->name }}
                                            </td>
                                            <td>
                                                {{ $log->description }}
                                            </td>
                                            <td>
                                                {{ $log->created_at->format('d-m-Y') }} ({{ $log->created_at->format('H:i') }})
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
@endsection

@section('script')
    <script src="{{ asset('templates/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $("#table-1").dataTable({
            
        });
    </script>
@endsection