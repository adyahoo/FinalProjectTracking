@extends('layouts.project_manager')

@section('title','Blog Review')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('project_manager.blogs.all') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Blog Review</h1>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{ $blog->title }}</h2>
        <div class="row">
            <div class="col-12">
                <div class="activities">
                    @foreach($blogReviews as $blogReview)
                        <div class="activity">
                            @if($blogReview->status == 'Rejected')
                                <div class="activity-icon bg-danger text-white shadow-primary">
                                    <i class="fas fa-times"></i>
                                </div>
                            @else
                                <div class="activity-icon bg-primary text-white shadow-primary">
                                    <i class="fas fa-check"></i>
                                </div>
                            @endif
                            <div class="activity-detail">
                                <div class="mb-2">
                                    <span class="text-job text-primary">{{ $blogReview->created_at->format('d F Y') }} ({{ $blogReview->created_at->format('H:i') }})</span>
                                    <span class="bullet"></span>
                                    <a class="text-job">{{ $blogReview->status }}</a>
                                    <span class="bullet"></span>
                                    <i class="fas fa-user-circle"></i> {{ $blogReview->user->name }}
                                </div>
                                <p>
                                    {!! $blogReview->reviews !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection