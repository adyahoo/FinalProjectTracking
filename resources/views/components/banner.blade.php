<div class="section section-banner__container">
    <img class="section-banner__img" src="{{asset('images/banner-bg.svg')}}">
    <div class="container section-banner__content">
        <div class="swiper">
            <div class="swiper-wrapper">
                @for($i = 0; $i < 3; $i++)
                <div class="swiper-slide">
                    <a class="text" href="{{route('detail_blog')}}">                        
                        <div class="row mb-4 bg-white align-items-center">
                            <div class="col-4">
                                <div class="section-banner__content-container">
                                    <img class="section-banner__content-img" src="{{asset('images/img-content.svg')}}">
                                </div>
                            </div>
                            <div class="col-7">
                                <p class="section-banner__date-created font-weight-bold">Date Created - Author</p>
                                <h2 class="text-dark">
                                    Title of Blog
                                </h2>
                                <p class="section-banner__desc">
                                    Mollit sunt fugiat sint adipisicing consectetur exercitation. Esse adipisicing culpa excepteur labore eu 
                                    est tempor consequat. Do laboris occaecat ullamco consequat laboris reprehenderit fugiat ad ut veniam consequat ipsum. Officia eu labore commodo ut ea nulla. Aliquip incididunt qui mollit ipsum cillum ea elit culpa. Officia fugiat velit sunt deserunt qui ullamco enim Lorem.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endfor
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>