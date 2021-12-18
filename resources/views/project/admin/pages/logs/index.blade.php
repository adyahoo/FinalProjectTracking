@extends('layouts.admin')
@section('title','Global Logs')
@section('css')
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-header">
    <h1>Global Logs</h1>
</div>

<div class="section-body">
    <h2 class="section-title">Overview</h2>
    <p class="section-lead">
    Monitor all activities that happen in systems.
    </p>

    <div class="row">
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <div class="card-body">
                    <h4>Project Logs</h4>
                    <p>See and monitor activity that happen inside the project.</p>
                    <a href="{{route('admin.logs.show','project')}}" class="card-cta">See logs <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-body">
                    <h4>Membership Logs</h4>
                    <p>See and monitor changes made on membership.</p>
                    <a href="{{route('admin.logs.show','membership')}}" class="card-cta">See logs <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-blog"></i>
                </div>
                <div class="card-body">
                    <h4>Blog Logs</h4>
                    <p>See and monitor changes and activity made on blog.</p>
                    <a href="{{route('admin.logs.show','blog')}}" class="card-cta">See logs <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-power-off"></i>
                </div>
                <div class="card-body">
                    <h4>System Logs</h4>
                    <p>See and monitor changes made on system setting.</p>
                    <a href="{{route('admin.logs.show','setting')}}" class="card-cta">See logs <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection