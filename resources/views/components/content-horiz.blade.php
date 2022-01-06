@foreach($blogs as $blog)
<div class="row no-gutters mb-4 bg-white align-items-center justify-content-between">
    <div class="col-4">
        <a class="text" href="{{route('detail_blog', $blog->slug)}}">
            <div class="section-content__content-container">
                <img class="section-content__content-img" src="{{asset(Storage::url('blog_images/'.$blog->image))}}">
            </div>
        </a>
    </div>
    <div class="col-7">
        <p class="section-content__date-created font-weight-bold">{{$blog->published_at}} - {{$blog->user->name}}
        </p>
        <h4 class="text-dark">
            {{$blog->title}}
        </h4>
        <p class="section-content__desc">
            {{strip_tags($blog->content)}}
        </p>
        <div class="section-content__count text-right text-danger" data-id="{{$blog->id}}">
            @auth
            @if($blog->user_id == auth()->user()->id)
            <i id="like{{$blog->id}}" class="{{ auth()->user()->hasLiked($blog) ? 'fas' : 'far' }} fa-heart mr-3">
                <span class="text-dark" id="like{{$blog->id}}-bs2">
                    {{$blog->likers()->count()}}
                </span>
            </i>
            @endif
            @endauth
            @guest
            <i class="fas fa-heart mr-3" id="guestLikeListBtn">
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