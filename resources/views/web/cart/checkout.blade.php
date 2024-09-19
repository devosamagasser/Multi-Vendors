<x-front title="Checkout">
    <x-slot name="breadcrump" >
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Home</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="index-2.html"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="index-2.html"><i class="lni lni-home"></i> Shop</a></li>
                            <li><a href="index-2.html"><i class="lni lni-home"></i> Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section class="checkout-wrapper section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="checkout-steps-form-style-1">
                            <ul id="accordionExample">
                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Shipping Address</h6>
                                    <section class="checkout-steps-form-content collapse" id="collapseFour" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <form action="{{route('checkout.store')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="single-form form-default">
                                                        <label>User Name</label>
                                                        <div class="row">
                                                            <div class="col-md-6 form-input form">
                                                                <input type="text" name="f_name" placeholder="First Name">
                                                            </div>
                                                            <div class="col-md-6 form-input form">
                                                                <input type="text" name="l_name" placeholder="Last Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-form form-default">
                                                        <label>Email Address</label>
                                                        <div class="form-input form">
                                                            <input type="text" name="email" placeholder="Email Address">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-form form-default">
                                                        <label>Phone Number</label>
                                                        <div class="form-input form">
                                                            <input type="text" name="phone" placeholder="Phone Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-form form-default">
                                                        <label>Country</label>
                                                        <div class="form-input form">
                                                            <input type="text" name="country" placeholder="Country">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-form form-default">
                                                        <label>City</label>
                                                        <div class="form-input form">
                                                            <input type="text" name="city" placeholder="City">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="single-form form-default">
                                                        <label>Street Address</label>
                                                        <div class="form-input form">
                                                            <input type="text" name="address"  placeholder="Street Address">
                                                        </div>
                                                    </div>
                                                </div>
                                               <div class="col-md-12">
                                                    <div class="steps-form-btn button">
                                                        <button class="btn" type="submit" >submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </section>
                                </li>
                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Payment Info</h6>
                                    <section class="checkout-steps-form-content collapse" id="collapsefive" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="checkout-payment-form">
                                                    <div class="single-form form-default">
                                                        <label>Cardholder Name</label>
                                                        <div class="form-input form">
                                                            <input type="text" name="first_name" placeholder="Cardholder Name">
                                                        </div>
                                                    </div>
                                                    <div class="single-form form-default">
                                                        <label>Card Number</label>
                                                        <div class="form-input form">
                                                            <input id="credit-input" type="text" placeholder="0000 0000 0000 0000">
                                                            <img src="assets/images/payment/card.png" alt="card">
                                                        </div>
                                                    </div>
                                                    <div class="payment-card-info">
                                                        <div class="single-form form-default mm-yy">
                                                            <label>Expiration</label>
                                                            <div class="expiration d-flex">
                                                                <div class="form-input form">
                                                                    <input type="text" placeholder="MM">
                                                                </div>
                                                                <div class="form-input form">
                                                                    <input type="text" placeholder="YYYY">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-form form-default">
                                                            <label>CVC/CVV <span><i class="mdi mdi-alert-circle"></i></span></label>
                                                            <div class="form-input form">
                                                                <input type="text" placeholder="***">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-form form-default button">
                                                        <button class="btn">pay now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout-sidebar">
                            <div class="checkout-sidebar-price-table mt-30">
                                <h5 class="title">Pricing Table</h5>
                                <div class="sub-total-price">
                                    @foreach($billdata as $data)
                                        <div class="total-price">
                                            <p class="value">{{$data->product->name . ': ' . $data->quantity . ' x ' . $data->product->price}}</p>
                                            <p class="price">{{Currency::format($data->product->price * $data->quantity)}}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="total-payable">
                                    <div class="payable-price">
                                        <p class="value">Total Price:</p>
                                        <p class="price">{{Currency::format($total)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-front>
