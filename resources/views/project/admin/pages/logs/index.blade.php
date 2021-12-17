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
                    <i class="fas fa-cog"></i>
                </div>
                <div class="card-body">
                    <h4>General</h4>
                    <p>General settings such as, site title, site description, address and so on.</p>
                    <a href="{{route('admin.logs.show','blog')}}" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-search"></i>
                </div>
                <div class="card-body">
                    <h4>SEO</h4>
                    <p>Search engine optimization settings, such as meta tags and social media.</p>
                    <a href="features-setting-detail.html" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="card-body">
                    <h4>Email</h4>
                    <p>Email SMTP settings, notifications and others related to email.</p>
                    <a href="features-setting-detail.html" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-power-off"></i>
                </div>
                <div class="card-body">
                    <h4>System</h4>
                    <p>PHP version settings, time zones and other environments.</p>
                    <a href="features-setting-detail.html" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="card-body">
                    <h4>Security</h4>
                    <p>Security settings such as firewalls, server accounts and others.</p>
                    <a href="features-setting-detail.html" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-stopwatch"></i>
                </div>
                <div class="card-body">
                    <h4>Automation</h4>
                    <p>Settings about automation such as cron job, backup automation and so on.</p>
                    <a href="features-setting-detail.html" class="card-cta text-primary">Change Setting <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection