@extends('layouts.project_manager')

@section('title','Project Detail')

@section('content')
    <div class="section-header" style="display: block">
        <div class="row">
            <div class="section-header-back">
                <a href="{{ route('project_manager.projects.detail', $project) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{ $project->name }}</h1>
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
                    </div>
                </div>
                <div class="card-body pb-5">
                    {!! $text !!}
                </div>
            </div>
        </div>
    </div>
@endsection