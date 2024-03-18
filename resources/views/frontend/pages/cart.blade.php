@extends('frontend.layout.layout')


@section('content')
    <div class="bg-light py-3">
        <div class="container">




            <div class="row">
                <div class="col-md-12 mb-0"><a href="index-2.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Cart</strong></div>
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
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($cartItem as $key => $cart)
                                <tr class="orderItem" data-id="{{$key}}">
                                    <td class="product-thumbnail">
                                        <img src="{{ asset( $cart['image']) }}" alt="Image" class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $cart['name'] ?? '' }}</h2>
                                    </td>
                                    <td>{{ $cart['price'] }}  $</td>
                                    <td>
                                        <div class="input-group mb-3" style="max-width: 120px;">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-primary decreaseButton js-btn-minus" type="button">&minus;</button>
                                            </div>
                                            <input type="text" class="qtyItem form-control text-center" value="{{ $cart['qty'] }}" placeholder
                                                   aria-label="Example text with button addon" aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary increaseButton js-btn-plus" type="button">&plus;</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="itemTotal">{{ $cart['price'] * $cart['qty'] }}  $</td>
                                    <td>
                                        <form action="{{ route('remove-cart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value=" {{ $key }}">
                                            <button class="btn btn-primary btn-sm">

                                               X

                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
                        </div>
                    </div>


                    <form action="{{ route('checkCoupon') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-black  h4" for="coupon">Coupon</label>
                                <p>Enter your coupon code if you have one.</p>
                            </div>
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" class="form-control py-3" value="{{session()->get('coupon_code') ?? '' }}" id="coupon" name="name" placeholder="Coupon Code">
                            </div>
                            <div class="col-md-4">
                                <button  class="btn btn-primary coupon-btn btn-sm">Apply Coupon</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">$ {{ session()->get('totalPrice') ?? 0 }}</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn paymentButton btn-primary btn-lg py-3 btn-block"
                                           >Proceed To Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).on('click', '.paymentButton', function (){
            @if(!empty(session()->get('cart')))
            var url = '{{ route('checkout') }}'
            window.location.href = url
            @endif
        })



        $(document).on('click', '.decreaseButton', function (){
            $('.orderItem').removeClass('selected')
            $(this).closest('.orderItem').addClass('selected')
            var product_id = $('.selected').closest('.orderItem').attr('data-id')
            var qty =  $('.selected').closest('.orderItem').find('.qtyItem').val()
            sepetUpdate(product_id,qty,'Azalt')
        })


        function sepetUpdate(product_id,qty,itemEvent){
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name= "csrf-token" ]').attr('content')
                    },
                method:"POST",
                url: "{{ route('newQty') }}",
                data: {
                    productId: product_id,
                    qty: qty,
                    itemEvent : itemEvent,
                },

                success: function (response){
                    $('.selected').find('.itemTotal').text(response.itemTotal+ ' $')
                    if(qty == 0){
                        $('.selected').remove()
                    }
                }

            })
        }



        $(document).on('click', '.increaseButton', function (){
            $('.orderItem').removeClass('selected')
            $(this).closest('.orderItem').addClass('selected')
            var product_id = $('.selected').closest('.orderItem').attr('data-id')
            var qty =  $('.selected').closest('.orderItem').find('.qtyItem').val()
            sepetUpdate(product_id,qty,'Arttir')

        })
    </script>
@endsection


