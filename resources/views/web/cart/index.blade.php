<x-front title="Cart">
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
                            <li><a href="index-2.html"><i class="lni lni-home"></i> Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="shopping-cart section">
            <div class="container">
                <div class="cart-list-head">

                    <div class="cart-list-title">
                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-12">
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <p>Product Name</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>Quantity</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>Subtotal</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>Discount</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <p>Remove</p>
                            </div>
                        </div>
                    </div>

                    @forelse($carts as $cart)
                       <div class="cart-single-list">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{route('products.show',$cart->product->slug)}}"><img src="{{$cart->product->image_url}}"alt="#"></a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name">
                                    <a href="{{route('products.show',$cart->product->slug)}}">
                                        {{$cart->product->name}}
                                    </a>
                                </h5>
                                <p class="product-des">
                                    <span><em>Type:</em> Mirrorless</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <input class="form-control item-quantity" product-id="{{$cart->product->id}}" type="number" name="quantity" value="{{$cart->quantity}}" >
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{Currency::format($cart->product->price * $cart->quantity)}}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>
                                @if($cart->product->compare_price)
                                    {{Currency::format(($cart->product->compare_price - $cart->product->price) * $cart->quantity)}}
                                @else
                                    {{Currency::format(0.00)}}
                                @endif
                                </p>

                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a class="remove-item" href="{{route('cart.destroy',$cart->product->id)}}"><i class="lni lni-close"></i></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="total-amount">
                            <div class="row">
                                <div class="col-lg-8 col-md-6 col-12">
                                    <div class="left">
                                        <div class="coupon">
                                            <form action="#" target="_blank">
                                                <input name="Coupon" placeholder="Enter Your Coupon">
                                                <div class="button">
                                                    <button class="btn">Apply Coupon</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="right">
                                        <ul>
                                            <li>Cart Subtotal<span>$2560.00</span></li>
                                            <li>Shipping<span>Free</span></li>
                                            <li>You Save<span>$29.00</span></li>
                                            <li class="last">You Pay<span>$2531.00</span></li>
                                        </ul>
                                        <div class="button">
                                            <a href="checkout.html" class="btn">Checkout</a>
                                            <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-front>
