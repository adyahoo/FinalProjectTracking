@foreach($blogs as $blog)
<div class="col-12 col-md-6">
    <a class="text" href="{{route('detail_blog', $blog->slug)}}">
        <div class="row no-gutters mb-4 bg-white align-items-center justify-content-between">
            <div class="col-4">
                <div class="section-content__content-container">
                    <img class="section-content__content-img"
                        src="{{asset(Storage::url('blog_images/'.$blog->image))}}">
                </div>
            </div>
            <div class="col-7">
                <p class="section-content__date-created font-weight-bold">{{$blog->published_at}} -
                    {{$blog->user->name}}</p>
                <h4 class="text-dark">
                    {{$blog->title}}
                </h4>
                <p class="section-content__desc">
                    {{strip_tags($blog->content)}}
                </p>
                <div class="section-content__count text-right">
                    <i class="far fa-heart mr-3">125</i>
                    <i class="far fa-eye mr-5">{{$blog->view_count}}</i>
                </div>
            </div>
        </div>
    </a>
</div>
@endforeach