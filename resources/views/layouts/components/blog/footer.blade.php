<footer>
    <div class="footer">
        <div class="container">
            <div class="row no-gutters text-left text-white font-weight-bold">
                <div class="footer__body section-about-us col-12 col-md-4">
                    <h4 class="text-center">About Us</h4>
                    <p class="font-weight-normal">
                        Timedoor is a website design, mobile apps development and mobile game developing company that is located in Bali & Jakarta. We are committed to maintain quality in every product that is developed.
                    </p>
                    <a class="text-white font-weight-bold" href="https://timedoor.net/">Learn more...</a>
                </div>
                <div class="footer__body section-nav col-12 col-md-4">
                    <h4 class="text-center">Instant Navigation</h4>
                    <div class="row no-gutters text-center">
                        <div class="col-4">
                            <h5>Home</h5>
                        </div>
                        <div class="col-4">
                            <h5>Blog</h5>
                        </div>
                        <div class="col-4">
                            <h5 class="dropdown-toggle text-left" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Category
                            </h5>
                            <div class="dropdown-menu mb-3" aria-labelledby="navbarDropdown">
                                @if($categories->count() < 1) <p class="dropdown-item disabled">No Category Found</p>
                                    @else
                                    @foreach($categories as $category)
                                    <a class="dropdown-item" href="#" onclick="searchCategory('{{$category->id}}')">{{$category->name}}</a>
                                    <form id="formSearch{{$category->id}}" action="{{ route('kategori') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="categoryName" value="{{$category->name}}">
                                        <input type="hidden" name="categoryId" value="{{$category->id}}">
                                    </form>
                                    @endforeach
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer__body section-socmed col-12 col-md-4 text-center">
                    <h4>Our Social Media</h4>
                    <div class="row no-gutters justify-content-around">
                        <a class="text-white" href="https://www.facebook.com/timedoorindonesia"><i class="fab fa-facebook-square footer__icon"></i></a>
                        <a class="text-white" href="https://www.linkedin.com/company/pt-timedoor-indonesia"><i class="fab fa-linkedin footer__icon"></i></a>
                        <a class="text-white" href="https://www.instagram.com/timedoorindonesia/"><i class="fab fa-instagram footer__icon"></i></a>
                    </div>
                </div>
            </div>
            <div class="section-copyright text-center text-white mt-5">
                <i class="far fa-copyright">Timedoor Indonesia 2021</i>
            </div>
        </div>
    </div>
</footer>