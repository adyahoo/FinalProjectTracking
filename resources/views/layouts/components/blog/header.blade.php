<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                @if($page['logo'] != null)
                    <img alt="Image of Brand" src="{{ Storage::url('app_logo/'. $page['logo']) }}">
                @else
                    <img alt="Image of Brand" src="{{asset('images/logo-timedoor.svg')}}">
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item nav-item--custom">
                        <a class="nav-link home-link font-weight-bold nav-link--custom" href="/">Home</a>
                    </li>
                    <li class="nav-item nav-item--custom">
                        <a class="nav-link font-weight-bold nav-link--custom" href="{{ route('blog') }}">Blog</a>
                    </li>
                    <li class="nav-item dropdown nav-item--custom">
                        <a class="nav-link dropdown-toggle font-weight-bold nav-link--custom text-left" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Category
                        </a>
                        <div class="dropdown-menu mb-3" aria-labelledby="navbarDropdown">
                            @foreach($categories as $category)
                            <a class="dropdown-item" href="#" onclick="searchCategory('{{$category->id}}')">{{$category->name}}</a>
                            <form id="formSearch{{$category->id}}" action="{{ route('kategori') }}" method="post">
                                @csrf
                                <input type="hidden" name="categoryName" value="{{$category->name}}">
                                <input type="hidden" name="categoryId" value="{{$category->id}}">
                            </form>
                            @endforeach                            
                        </div>
                    </li>
                </ul>
                <form class="form-inline justify-content-between" id="formSearch" method="post" action="{{route('search')}}">
                    @csrf
                    <input id="searchInput" name="searchInput" class="form-control" type="search" placeholder="Search Author" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </nav>
</header>