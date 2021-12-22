@foreach($blogs as $blog)
<div class="col-12 col-lg-5 bg-white mb-3">
    <a class="text" href="{{route('detail_blog', $blog->slug)}}">
        <div class="section-content__vert-img-container">
            <img class="section-content__vert-img rounded" src="{{asset(Storage::url('blog_images/'.$blog->image))}}">
        </div>
        <div class="section-content__body p-3">
            <div class="row no-gutters justify-content-between">
                <p class="section-content__date-created font-weight-bold">{{ $blog->published_at }} <br>{{ $blog->user->name }}</p>
                <div class="section-content__count">
                    <i class="far fa-heart">120</i> 
                    <i class="far fa-eye">{{ $blog->view_count }}</i>
                </div>
            </div>            
            <h4 class="text-dark text-center">
                {{ $blog->title }}
            </h4>
            <p class="section-content__desc">
                {{ $blog->meta_description }}
            </p>
        </div>
    </a>
</div>
@endforeach