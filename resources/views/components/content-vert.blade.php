@foreach($blogs as $blog)
<div class="col-12 col-lg-5 bg-white mb-3">
    <a class="text" href="{{route('detail_blog', $blog->slug)}}">
        <div class="section-content__vert-img-container">
            <img class="section-content__vert-img rounded" src="{{asset(Storage::url('blog_images/'.$blog->image))}}">
        </div>
    </a>
    <div class="section-content__body p-3">
        <div class="row no-gutters justify-content-between">
            <p class="section-content__date-created font-weight-bold">{{ Carbon\Carbon::parse($blog->published_at)->format('d M Y') }} <br>{{
                $blog->user->name }}</p>
        </div>
        <h4 class="text-dark text-center">
            {{ $blog->title }}
        </h4>
        <p class="section-content__desc">
            {{ strip_tags($blog->content) }}
        </p>
        <div class="section-content__count text-right text-danger" data-id="{{$blog->id}}">
            @auth
            @if($blog->user_id == auth()->user()->id)
            <i id="like{{$blog->id}}" class="{{ auth()->user()->hasLiked($blog) ? 'fas' : 'far' }} fa-heart mr-3">
                <span class="text-dark" id="like{{$blog->id}}-bs3">
                    {{$blog->likers()->count()}}
                </span>
            </i>
            @endif
            @endauth
            @guest
            <i class="fas fa-heart mr-3" id="guestLikeBtn">
                <span class="text-dark">
                    {{$blog->likers()->count()}}
                </span>
            </i>
            @endguest
            <i class="far fa-eye mr-5 text-dark">{{$blog->view_count}}</i>
        </div>
    </div>
</div>
@endforeach