<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img alt="Image of Brand" src="images/logo-timedoor.svg">
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
                            <a class="dropdown-item" href="#">Technology</a>
                            <a class="dropdown-item" href="#">Mobile</a>
                            <a class="dropdown-item" href="#">Website</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form> 
            </div>
        </div>
    </nav>
</header>