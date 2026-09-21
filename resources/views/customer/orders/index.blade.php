<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>My Orders | ForkFul</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/customer.css') }}"
    >
</head>

<body>

<div class="customer-page">

    <div class="container">


        <!-- =========================
             HEADER
        ========================== -->

        <div class="customer-header">

            <div>

                <a
                    href="{{ route('home') }}"
                    class="back-link"
                >
                    ← Back to Home
                </a>

                <p class="small-heading">
                    YOUR ACCOUNT
                </p>

                <h1>
                    My Orders
                </h1>

                <p class="header-description">
                    View and track all your ForkFul orders.
                </p>

            </div>


            <div class="customer-profile">

                <div class="profile-circle">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div>

                    <strong>
                        {{ Auth::user()->name }}
                    </strong>

                    <span>
                        {{ Auth::user()->email }}
                    </span>

                </div>

            </div>

        </div>



        <!-- =========================
             SUCCESS / ERROR
        ========================== -->

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

        @endif



        <!-- =========================
             ORDERS
        ========================== -->

        <div class="customer-orders">

            @forelse($orders as $order)

                <div class="customer-order-card">


                    <!-- TOP -->

                    <div class="order-top">

                        <div>

                            <span class="order-number">
                                ORDER #{{ $order->id }}
                            </span>

                            <h3>
                                {{ $order->created_at->format('d M Y') }}
                            </h3>

                            <p>
                                {{ $order->created_at->format('h:i A') }}
                            </p>

                        </div>


                        <span
                            class="status-badge status-{{ strtolower($order->status) }}"
                        >
                            {{ $order->status }}
                        </span>

                    </div>



                    <!-- SUMMARY -->

                    <div class="order-info-grid">

                        <div class="order-info-box">

                            <span>
                                Items
                            </span>

                            <strong>
                                {{ $order->items->sum('quantity') }}
                            </strong>

                        </div>


                        <div class="order-info-box">

                            <span>
                                Total
                            </span>

                            <strong>
                                ${{ number_format($order->total_price, 2) }}
                            </strong>

                        </div>


                        <div class="order-info-box address-box">

                            <span>
                                Delivery Address
                            </span>

                            <strong>
                                {{ $order->delivery_address }}
                            </strong>

                        </div>

                    </div>



                    <!-- ITEMS PREVIEW -->

                    <div class="items-preview">

                        @foreach($order->items->take(3) as $item)

                            <div class="preview-row">

                                <span>
                                    {{ $item->menuItem?->name ?? 'Deleted Item' }}
                                </span>

                                <strong>
                                    × {{ $item->quantity }}
                                </strong>

                            </div>

                        @endforeach


                        @if($order->items->count() > 3)

                            <p class="more-items">
                                + {{ $order->items->count() - 3 }} more item(s)
                            </p>

                        @endif

                    </div>



                    <!-- BUTTON -->

                    <div class="order-card-footer">

                        <a
                            href="{{ route('customer.orders.show', $order->id) }}"
                            class="view-order-btn"
                        >
                            View Order Details →
                        </a>

                    </div>

                </div>


            @empty

                <div class="empty-orders">

                    <div class="empty-icon">
                        🛍
                    </div>

                    <h2>
                        No orders yet
                    </h2>

                    <p>
                        You haven't placed an order yet.
                    </p>

                    <a
                        href="{{ route('home') }}#menu"
                        class="menu-btn"
                    >
                        Explore Menu
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</div>

</body>
</html>