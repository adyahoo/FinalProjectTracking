@extends('layouts.project_manager')

@section('content')
    <div class="section-header" style="display: block">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <h1>{{ $project->name }}</h1>
            </div>
            <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
                <p>Latest Version v1.0.0</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active-tab" href="#">Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Modules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Version</a>
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
                <div class="card-header d-block">
                    <div class="row">
                        <div class="col-11">
                            <h4>{{ $title }}</h4>
                        </div>
                        <div class="col-1 text-right">
                            <a href="{{ route('project_manager.projects.detail', $project) }}" class="h5 text-dark"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-5">
                    {!! $text !!}
                </div>
            </div>
        </div>
    </div>
@endsection