@extends('frontend.layout.layout')


@section('content')

    <div class="bg-light py-3">
        <div class="container">


            <div class="row">
                <div class="col-md-12 mb-0"><a href="index-2.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Shop</strong></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-9 order-2">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4">
                                <h2 class="text-black h5">Shop All</h2>
                            </div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Latest
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                       @foreach($categories as $data)
                                           @if($data->category_up == null)
                                                <a class="dropdown-item" href="{{ route($data->slug.'shop') }}">{{ $data->name }}</a>
                                           @endif
                                       @endforeach
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference"
                                            data-toggle="dropdown">Reference</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                        <a class="dropdown-item" data-sira="a_z_order" href="#">Name, A to Z</a>
                                        <a class="dropdown-item" data-sira="z_a_order" href="#">Name, Z to A</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-sira="price_min_order" href="#">Price, low to high</a>
                                        <a class="dropdown-item" data-sira="price_max_order" href="#">Price, high to low</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">


                        @if(!empty($products) && $products->count() > 0)
                            @foreach($products as $product)
                                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                    <div class="block-4 text-center border">
                                        <figure class="block-4-image">
                                            <a href="{{ route('detail', $product->slug) }}"><img src="{{ asset($product->image) }}" alt="Image placeholder"
                                                                            class="img-fluid"></a>
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="{{ route('detail', $product->slug) }}">{{ $product->name }}</a></h3>
                                            <p class="mb-0">{{ $product->short_text }}</p>
                                            <p class="text-primary font-weight-bold">{{ $product->price }} $</p>

                                            <form action="{{ route('add-cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="size" value="{{ $product->size }}">

                                                <button class="buy-now btn btn-sm btn-primary">Add To Cart</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>

                    <div class="row" data-aos="fade-up">
                        <div class="col-md-12 text-center">
                            <div class="site-block-27">
                                <ul>
                                    <li><a href="#">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&gt;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 order-1 mb-5 mb-md-0">
                    <h3 class="mb-3  text-uppercase text-black d-block">Filter</h3>
                    <form action="{{ route('shop') }}" method="GET">

                        <div class="border p-4 rounded mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>

                            <div class="mb-4 d-flex" >
                                <input type="text" style="width: 90px; height: 30px" class="mb-3 mr-3" name="minPrice" placeholder="Minimum">
                                <input type="text" style="width: 90px; height: 30px" name="maxPrice" placeholder="Maximum">

                            </div>
                            <div class="mb-4">
                                <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>

                                @foreach($sizeList as $size => $products)
                                    <label for="s_{{ $size }}" class="d-flex">
                                        <input type="checkbox" id="s_{{ $size }}" name="size" value="{{$size}}"  class="mr-2 mt-1">
                                        <span class="text-black">{{ $size }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div class="mb-4">
                                <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                                @foreach($colors as $color => $products)
                                    <label for="s_{{ $color }}" class="d-flex">
                                        <input type="checkbox" id="s_{{ $color }}" name="color" value="{{ $color }}" class="mr-2 mt-1">
                                        <span class="text-black">{{ $color }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <button class="btn btn-primary ">FILTER</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="site-section site-blocks-2">
                        <div class="row justify-content-center text-center mb-5">
                            <div class="col-md-7 site-section-heading pt-4">
                                <h2>Categories</h2>
                            </div>
                        </div>
                        <pubf> nou znhaphire </pubf>
                        <div class="row">
                            @foreach($cat as $category)
                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay>
                                    <a class="block-2-item" href="{{ route($category->slug.'shop') }}">
                                        <figure class="image">
                                            <img src="{{ asset($category->image) }}" alt class="img-fluid">
                                        </figure>
                                        <div class="text">
                                            <span class="text-uppercase">Collections</span>
                                            <h3>{{ $category->name }}</h3>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



