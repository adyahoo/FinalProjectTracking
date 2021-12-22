@extends('layouts.blog')
@section('title', 'Blog')

@push('css')
<link rel="stylesheet" href="{{asset('css/blog/blog/blog.css')}}">
@endpush

@section('content')
<div class="section-banner">
    @yield('banner')
</div>
<div class="section container section-content">
    <h2>@yield('title-search')</h2>
    <div class="section-label">
        @yield('label')
    </div>
    <div class="section-sort row no-gutters mb-4 justify-content-end align-items-center">
        <p class="m-0 mr-2">Sort By : </p>
        <form>
            <div class="form-group m-0">
                <select class="form-control" id="sortSelect">
                    <option selected disabled>Choose...</option>
                    <option>Newest</option>
                    <option>Oldest</option>
                </select>
            </div>
        </form>
        <i data-id="0" id="view_id" class="fas fa-th-large section-content__icon"></i>
        <a data-toggle="collapse" href="#collapseSidebar" role="button" aria-expanded="false"
            aria-controls="collapseSidebar">
            <i class="fa fa-filter section-content__icon"></i>
        </a>
    </div>
    <div class="section-body row no-gutters justify-content-between">
        <div class="col-12 col-md-8 order-1 order-md-0" id="list-view">
            @yield('content-list')
        </div>

        <div class="col-12 col-md-8 order-1 order-md-0" id="grid-view">
            @yield('content-grid')            
        </div>

        <div class="col-12 col-md-3 mb-4 collapse" id="collapseSidebar">
            <div class="border rounded p-2 bg-white" id="sidebar">
                @yield('content-sidebar')
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('js/bootstrap-toolkit.min.js')}}"></script>
<script src="{{asset('js/blog/blog.js')}}"></script>
<!-- <script>
    $('#sortSelect').on('change', function () {
        var sort = $(this).val()

        $.ajax({
            url: "{{route('sort_blog')}}",
            method: "post",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                sort: sort,
            },
            success: function (result) {
                $('#gridContent').html(
                    '<h2>asdas</h2>'
                )
                // $('#gridContent').html(
                //     JSON.parse(result.view)
                // )
                alert(result)
            }
        })
    })
</script> -->
@stack('blog-js')
@endpush