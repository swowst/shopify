@extends('frontend.layout.layout')


@section('content')
    <div class="bg-light py-3">
        <div class="container">


            <div class="row">
                <div class="col-md-12 mb-0"><a href="index-2.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Tank Top T-Shirt</strong></div>
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
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('/') }}images/cloth_1.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $product->name }}</h2>
                   <p>{{ $product->content }}</p>


                    <form action="{{ route('add-cart') }}" method="POST">
                    @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <p><strong class="text-primary h4">{{ $product->price }} $</strong></p>
                    <div class="mb-1 d-flex">
                        <label for="option-s" class="d-flex mr-3 mb-3">
                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                                                                               id="option-s" name="size"  {{ $product->size == 'Small' ? 'checked' : '' }}  value="Small"></span> <span class="d-inline-block text-black">Small</span>
                        </label>
                        <label for="option-m" class="d-flex mr-3 mb-3">
                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                                                                               id="option-m" name="size" {{ $product->size == 'Medium' ? 'checked' : '' }} value="Medium"></span> <span class="d-inline-block text-black">Medium</span>
                        </label>
                        <label for="option-l" class="d-flex mr-3 mb-3">
                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                                                                               id="option-l" name="size" {{ $product->size == 'Large' ? 'checked' : '' }} value="Large"></span> <span class="d-inline-block text-black">Large</span>
                        </label>
                        <label for="option-xxl" class="d-flex mr-3 mb-3">
                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                                                                               id="option-xxl" name="size" {{ $product->size == 'XXLarge' ? 'checked' : '' }} value="XXLarge"></span> <span class="d-inline-block text-black"> Extra Large</span>
                        </label>
                    </div>
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center" name="qty" value="1" placeholder
                                   aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                    <p><button type="submit" class="buy-now btn btn-sm btn-primary">Add To Cart</button></p>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Featured Products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ asset('/') }}images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Tank Top</a></h3>
                                    <p class="mb-0">Finding perfect t-shirt</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ asset('/') }}images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Corater</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ asset('/') }}images/cloth_2.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Polo Shirt</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ asset('/') }}images/cloth_3.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">T-Shirt Mockup</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ asset('/') }}images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Corater</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

