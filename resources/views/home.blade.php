<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/style.css') }}"
    >

    <title>ForkFul</title>
</head>

<body>


<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar navbar-expand-lg">

    <div class="container">

        <a
            class="navbar-brand"
            href="#home"
        >
            ForkFul
        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>


        <div
            class="collapse navbar-collapse"
            id="navbarSupportedContent"
        >

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">


                <!-- HOME -->

                <li class="nav-item">
                    <a
                        class="nav-link active"
                        href="#home"
                    >
                        Home
                    </a>
                </li>


                <!-- MENU -->

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#menu"
                    >
                        Menu
                    </a>
                </li>


                <!-- CART -->

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#cart"
                    >
                        Cart
                    </a>
                </li>



                <!-- =========================
                     GUEST
                ========================== -->

                @guest

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="{{ route('login') }}"
                        >
                            Login
                        </a>

                    </li>


                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="{{ route('register') }}"
                        >
                            Register
                        </a>

                    </li>

                @endguest



                <!-- =========================
                     LOGGED IN
                ========================== -->

                @auth


                    <!-- CUSTOMER -->

                    @if(Auth::user()->role === 'customer')

                        <li class="nav-item">

                            <a
                                class="nav-link"
                                href="{{ route('customer.orders.index') }}"
                            >
                                My Orders
                            </a>

                        </li>

                    @endif



                    <!-- ADMIN -->

                    @if(Auth::user()->role === 'admin')

                        <li class="nav-item">

                            <a
                                class="nav-link"
                                href="{{ route('admin.dashboard') }}"
                            >
                                Admin Panel
                            </a>

                        </li>

                    @endif



                    <!-- USER NAME -->

                    <li class="nav-item">

                        <span class="nav-link">
                            Hi, {{ Auth::user()->name }}
                        </span>

                    </li>


                @endauth

            </ul>



            <!-- =========================
                 RIGHT SIDE BUTTONS
            ========================== -->

            <div class="d-flex align-items-center gap-2">


                <!-- CART BUTTON -->

                <a
                    href="#cart"
                    class="btn cart-btn"
                >
                    Cart · {{ $cartCount }}
                </a>



                <!-- LOGOUT -->

                @auth

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn cart-btn"
                        >
                            Logout
                        </button>

                    </form>

                @endauth


            </div>

        </div>

    </div>

</nav>



<!-- =========================
     SUCCESS MESSAGE
========================= -->

@if(session('success'))

    <div class="container mt-3">

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    </div>

@endif



<!-- =========================
     ERROR MESSAGE
========================= -->

@if(session('error'))

    <div class="container mt-3">

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    </div>

@endif



<!-- =========================
     HERO SECTION
========================= -->

<section
    class="hero-section"
    id="home"
>

    <div class="container">

        <div class="row align-items-center g-4">


            <!-- HERO TEXT -->

            <div class="col-12 col-md-6">

                <h5>
                    Home-style cooking, ordered online
                </h5>

                <h1>
                    Food that tastes like it was made for you
                </h1>

                <p>
                    Browse today's menu, build your order,
                    and we'll have it ready — fresh, warm,
                    and on time.
                </p>


                <a
                    href="#menu"
                    class="btn cart-btn"
                >
                    View Menu
                </a>

            </div>



            <!-- HERO IMAGE -->

            <div class="col-12 col-md-6">

                <div class="image-box">

                    <img
                        src="{{ asset('images/image.png') }}"
                        class="hero-image"
                        alt="Food"
                    >

                </div>

            </div>


        </div>

    </div>

</section>



<!-- =========================
     MENU SECTION
========================= -->

<section
    class="container menu-section"
    id="menu"
>

    <h2>
        Today's Menu
    </h2>



    <!-- =========================
         CATEGORY TABS
    ========================== -->

    <div class="menu-tabs">

        @foreach($categories as $category)

            <button
                type="button"
                class="category-btn {{ $loop->first ? 'active' : '' }}"
                data-category="{{ $category->slug }}"
            >
                {{ $category->name }}
            </button>

        @endforeach

    </div>



    <!-- =========================
         MENU ITEMS
    ========================== -->

    <div
        class="row g-4 mt-2"
        id="menu-items"
    >

        @foreach($categories as $category)

            @foreach($category->menuItems as $item)

                <div
                    class="col-12 col-md-4 menu-item {{ $category->slug }}"

                    @if(!$loop->parent->first)
                        style="display: none;"
                    @endif
                >

                    <div class="menu-card">


                        <!-- IMAGE -->

                        <img
                            src="{{ $item->image }}"
                            alt="{{ $item->name }}"
                        >



                        <!-- NAME -->

                        <h3>
                            {{ $item->name }}
                        </h3>



                        <!-- DESCRIPTION -->

                        <p>
                            {{ $item->description }}
                        </p>



                        <!-- PRICE + ADD BUTTON -->

                        <div class="card-bottom">


                            <strong>
                                ${{ number_format($item->price, 2) }}
                            </strong>


                            <form
                                action="{{ route('cart.add', $item->id) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="add-btn"
                                >
                                    Add
                                </button>

                            </form>


                        </div>

                    </div>

                </div>

            @endforeach

        @endforeach

    </div>

</section>



<!-- =========================
     CART SECTION
========================= -->

<section
    id="cart"
    class="cart-section"
>

    <div class="container">

        <div class="cart-inner">


            <!-- =========================
                 ORDER ITEMS
            ========================== -->

            <div class="order-list">

                <h2>
                    Your Order
                </h2>


                <div id="cart-items">

                    @forelse($cart as $item)

                        <div class="order-item">


                            <!-- ITEM NAME -->

                            <span>
                                {{ $item['name'] }}
                            </span>



                            <!-- QUANTITY -->

                            <div class="quantity">


                                <!-- MINUS -->

                                <form
                                    action="{{ route('cart.decrease', $item['id']) }}"
                                    method="POST"
                                >

                                    @csrf

                                    <button type="submit">
                                        −
                                    </button>

                                </form>



                                <!-- QUANTITY NUMBER -->

                                <span>
                                    {{ $item['quantity'] }}
                                </span>



                                <!-- PLUS -->

                                <form
                                    action="{{ route('cart.increase', $item['id']) }}"
                                    method="POST"
                                >

                                    @csrf

                                    <button type="submit">
                                        +
                                    </button>

                                </form>


                            </div>



                            <!-- ITEM TOTAL -->

                            <strong>
                                ${{ number_format(
                                    $item['price'] * $item['quantity'],
                                    2
                                ) }}
                            </strong>


                        </div>


                    @empty


                        <p>
                            Your cart is empty.
                        </p>


                    @endforelse

                </div>

            </div>



            <!-- =========================
                 ORDER SUMMARY
            ========================== -->

            <div class="order-summary">

                <h2>
                    Order Summary
                </h2>



                <!-- SUBTOTAL -->

                <div class="summary-row">

                    <span>
                        Subtotal
                    </span>

                    <span>
                        ${{ number_format($subtotal, 2) }}
                    </span>

                </div>



                <!-- DELIVERY -->

                <div class="summary-row">

                    <span>
                        Delivery
                    </span>

                    <span>
                        ${{ number_format($delivery, 2) }}
                    </span>

                </div>


                <hr>



                <!-- TOTAL -->

                <div class="summary-row total">

                    <strong>
                        Total
                    </strong>

                    <strong>
                        ${{ number_format($total, 2) }}
                    </strong>

                </div>



                <!-- =========================
                     PLACE ORDER
                ========================== -->

                @if(count($cart) > 0)

                    <a
                        href="{{ route('checkout') }}"
                        class="place-order-btn d-block text-center text-decoration-none"
                    >
                        Place Order
                    </a>

                @else

                    <button
                        type="button"
                        class="place-order-btn"
                        disabled
                    >
                        Cart is Empty
                    </button>

                @endif


            </div>

        </div>

    </div>

</section>



<!-- =========================
     FOOTER
========================= -->

<footer class="site-footer">

    <div class="container">

        <h3>
            ForkFul
        </h3>


        <p class="footer-tagline">
            Good food, good mood — made with care.
        </p>


        <div class="footer-line"></div>


        <p class="copyright">
            © 2026 ForkFul. All rights reserved.
        </p>

    </div>

</footer>



<!-- =========================
     BOOTSTRAP JS
========================= -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>



<!-- =========================
     OUR JAVASCRIPT
========================= -->

<script
    src="{{ asset('js/script.js') }}"
></script>


</body>

</html>