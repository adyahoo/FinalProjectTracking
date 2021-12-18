@extends('layouts.admin')
@section('title','Blog Review History')
@section('css')

@endsection

@section('content')
<div class="section-header">
    <h1>Review History</h1>
</div>

<div class="section-body">
    @foreach($reviews as $date=>$review)
    <h2 class="section-title">{{$date}}</h2>
    <div class="row">
        <div class="col-12">
            <div class="activities">
                @foreach($review as $review)
                <div class="activity">
                    <div class="activity-icon {{$review->status == 'Published' ? 'bg-success' : 'bg-danger'}} text-white shadow-primary">
                        <i class="fas fa-comment-alt"></i>
                    </div>
                    <div class="activity-detail">
                        <div class="mb-2">
                            <span class="text-job text-primary">{{$review->created_at->diffForHumans()}}</span>
                            <span class="bullet"></span>
                            <a aria-disabled="true" class="text-job">Reviewed by: {{$review->user->name}}</a>
                        </div>
                        <span class="badge badge-pill {{$review->status == 'Published' ? 'badge-success' : 'badge-danger'}}">{{$review->status}}</span>
                        <p class="text-dark"><b>Review description: </b></p>
                        {!! $review->reviews !!}
                        
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
@section('js')

@endsection