@extends('frontend.layout.layout')


@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index-2.html">Home</a> <span class="mx-2 mb-0">/</span> <a
                        href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <form action="{{ route('cart-save') }}" method="POST">
                        @csrf
                        <div class="p-3 p-lg-5 border">

                            <div class="form-group">
                                <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                                <select id="c_country" name="country" class="form-control">
                                    <option value="">Select a country</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Name Surname<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_companyname" class="text-black">Company Name </label>
                                    <input type="text" class="form-control" id="c_companyname" name="company_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Street address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_state_country" class="text-black">State / City <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_state_country" name="city">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_postal_zip" name="zip">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label for="c_email_address" class="text-black">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_email_address" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_phone" name="phone" placeholder="Phone Number">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Order Note<span class="text-danger">*</span></label>
                                    <textarea type="text" rows="3" class="form-control" id="c_fname" name="note"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg py-3 btn-block"
                                >Place Order</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                            <div class="p-3 p-lg-5 border">
                                <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                                <div class="input-group w-75">
                                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code"
                                           aria-label="Coupon Code" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                    </thead>
                                    <tbody>

                                    @php
                                        $cart = session()->get('cart')
                                    @endphp

                                    @foreach($cart as $item)
                                        <tr>
                                            <td>{{ $item['name'] }}<strong class="mx-2">x</strong> Quantity: {{ $item['qty'] }}</td>
                                            <td>{{ $item['price'] * $item['qty']  }} $</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                        <td class="text-black font-weight-bold"><strong>
                                                @php
                                                    $totalPrice = 0;
                                                    foreach($cart as $item) {
                                                        $totalPrice += $item['price'] * $item['qty'];
                                                    }
                                                    echo $totalPrice;
                                                @endphp
                                                $</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button"
                                                           aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>
                                    <div class="collapse" id="collapsebank">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as
                                                the payment reference. Your order won’t be shipped until the funds have cleared in our
                                                account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button"
                                                           aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>
                                    <div class="collapse" id="collapsecheque">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as
                                                the payment reference. Your order won’t be shipped until the funds have cleared in our
                                                account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="border p-3 mb-5">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button"
                                                           aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>
                                    <div class="collapse" id="collapsepaypal">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as
                                                the payment reference. Your order won’t be shipped until the funds have cleared in our
                                                account.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

