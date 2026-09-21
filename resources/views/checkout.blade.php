<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Checkout | ForkFul</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/checkout.css') }}"
    >

</head>

<body>

<div class="checkout-page">

    <div class="container">

        <div class="checkout-header">

            <a
                href="{{ route('home') }}#cart"
                class="back-link"
            >
                ← Back to Cart
            </a>

            <h1>Complete Your Order</h1>

            <p>
                Just a few details and your ForkFul order
                will be ready to go.
            </p>

        </div>


        <div class="checkout-grid">


            <!-- LEFT -->

            <div class="checkout-card">

                <p class="small-title">
                    DELIVERY DETAILS
                </p>

                <h2>Where should we deliver?</h2>


                @if($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    action="{{ route('orders.store') }}"
                    method="POST"
                >

                    @csrf


                    <div class="checkout-field">

                        <label>
                            Full Name
                        </label>

                        <input
                            type="text"
                            value="{{ Auth::user()->name }}"
                            disabled
                        >

                    </div>


                    <div class="checkout-field">

                        <label>
                            Phone Number
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="e.g. 0300 1234567"
                            required
                        >

                    </div>


                    <div class="checkout-field">

                        <label>
                            Delivery Address
                        </label>

                        <textarea
                            name="delivery_address"
                            rows="5"
                            placeholder="House number, street, area, city..."
                            required
                        >{{ old('delivery_address') }}</textarea>

                    </div>


                    <button
                        type="submit"
                        class="confirm-order-btn"
                    >
                        Confirm Order
                    </button>

                </form>

            </div>



            <!-- RIGHT -->

            <div class="summary-card">

                <p class="small-title">
                    YOUR ORDER
                </p>

                <h2>Order Summary</h2>


                <div class="checkout-items">

                    @foreach($cart as $item)

                        <div class="checkout-item">

                            <div>

                                <strong>
                                    {{ $item['name'] }}
                                </strong>

                                <span>
                                    Quantity:
                                    {{ $item['quantity'] }}
                                </span>

                            </div>

                            <strong>
                                ${{ number_format(
                                    $item['price'] * $item['quantity'],
                                    2
                                ) }}
                            </strong>

                        </div>

                    @endforeach

                </div>


                <div class="price-line">

                    <span>
                        Subtotal
                    </span>

                    <span>
                        ${{ number_format($subtotal, 2) }}
                    </span>

                </div>


                <div class="price-line">

                    <span>
                        Delivery
                    </span>

                    <span>
                        ${{ number_format($delivery, 2) }}
                    </span>

                </div>


                <div class="price-line final-total">

                    <strong>
                        Total
                    </strong>

                    <strong>
                        ${{ number_format($total, 2) }}
                    </strong>

                </div>


                <div class="secure-note">
                    ✓ Your order is securely processed by ForkFul
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>