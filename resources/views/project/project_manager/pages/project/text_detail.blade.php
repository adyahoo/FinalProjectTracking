@extends('layouts.project_manager')
@section('title','Project')
@section('content')
    @include('project.project_manager.include.project_page_tab', [
        'project'             => $project,
        'latestVersionNumber' => $latestVersion->version_number
    ])
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