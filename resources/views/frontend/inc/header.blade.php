<header class="site-navbar" role="banner">
    <div class="site-navbar-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                    <form action class="site-block-top-search">
                        <input type="text" class="form-control border-0" placeholder="Search">
                    </form>
                </div>
                <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                    <div class="site-logo">
                        <a href="{{ route('anasayfa') }}" class="js-logo-clone">SHOPIFY</a>
                    </div>
                </div>
                <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                    <div class="site-top-icons">
                        <ul>
                            <li><a href="#"><i class="fa-solid fa-heart"></i>   </span></a></li>
                            <li><a href="{{ route('account') }}"><i class="fa-solid fa-user"></i></a></li>
                            <li>
                                <a href="{{ route('cart') }}" class="site-cart">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    @if(session()->get('cart') && session()->get('cart') != null && !empty(session()->get('cart')))
                                        <span class="count">
                                            {{ count(session()->get('cart')) }}
                                        </span>
                                    @else
                                        <span class="count">
                                           0
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
            <ul class="site-menu js-clone-nav d-none d-md-block">
                <li class="active"><a href="{{ route('anasayfa') }}">Home</a></li>

                <li class="has-children ">

                    <a href="#">Category</a>

                    <ul class="dropdown">
                        @foreach($categories as $category)
                                @if($category->category_up == null)
                                    <li class="has-children">
                                        <a href="{{ route($category->slug.'shop') }}">{{ $category->name }}</a>

                                        <ul class="dropdown">
                                            @foreach($categories as $subCategory)
                                                @if($subCategory->category_up == $category->id)
                                                    <li><a href="{{ route($category->slug.'shop',$subCategory->slug) }}">{{ $subCategory->name }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                        @endforeach
                    </ul>
                </li>
                <li class="has-children">
                    <a href="{{ route('about') }}">About</a>
                </li>
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
    </nav>
</header>
