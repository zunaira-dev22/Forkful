<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Order #{{ $order->id }} | ForkFul
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/admin.css') }}"
    >

</head>

<body>

<div class="admin-layout">


    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="admin-logo"
            >
                ForkFul
            </a>

            <p class="admin-label">
                ADMIN PANEL
            </p>

            <nav class="admin-nav">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="admin-link"
                >
                    <span>⌂</span>
                    Dashboard
                </a>

                <a
                    href="{{ route('menu-items.index') }}"
                    class="admin-link"
                >
                    <span>🍽</span>
                    Menu Items
                </a>

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="admin-link active"
                >
                    <span>📦</span>
                    Orders
                </a>

                <a
                    href="{{ route('admin.customers.index') }}"
                    class="admin-link"
                >
                    <span>👤</span>
                    Customers
                </a>

            </nav>

        </div>


        <div class="sidebar-bottom">

            <a
                href="{{ route('home') }}"
                class="home-link"
            >
                ← Back to Website
            </a>

            <form
                action="{{ route('logout') }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="logout-btn"
                >
                    Logout
                </button>

            </form>

        </div>

    </aside>



    <!-- MAIN -->

    <main class="admin-main">


        <!-- HEADER -->

        <div class="admin-topbar">

            <div>

                <p class="small-heading">
                    ORDER DETAILS
                </p>

                <h1>
                    Order #{{ $order->id }}
                </h1>

                <p class="top-description">
                    View complete customer order information.
                </p>

            </div>


            <a
                href="{{ route('admin.orders.index') }}"
                class="back-admin-btn"
            >
                ← Back to Orders
            </a>

        </div>



        <!-- SUCCESS MESSAGE -->

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif



        <!-- ERROR MESSAGE -->

        @if(session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

        @endif



        <!-- ORDER -->

        <div class="admin-order-card">


            <div class="order-card-top">

                <div>

                    <span class="order-number">
                        ORDER #{{ $order->id }}
                    </span>

                    <h3>
                        {{ $order->user->name }}
                    </h3>

                    <p>
                        {{ $order->created_at->format('d M Y, h:i A') }}
                    </p>

                </div>


                <div class="order-total-box">

                    <span>
                        Total
                    </span>

                    <strong>
                        ${{ number_format($order->total_price, 2) }}
                    </strong>

                </div>

            </div>



            <!-- CUSTOMER INFO -->

            <div class="order-info-grid">

                <div class="order-info">

                    <span>
                        Customer
                    </span>

                    <strong>
                        {{ $order->user->name }}
                    </strong>

                </div>


                <div class="order-info">

                    <span>
                        Email
                    </span>

                    <strong>
                        {{ $order->user->email }}
                    </strong>

                </div>


                <div class="order-info">

                    <span>
                        Phone
                    </span>

                    <strong>
                        {{ $order->phone }}
                    </strong>

                </div>


                <div class="order-info full-order-info">

                    <span>
                        Delivery Address
                    </span>

                    <strong>
                        {{ $order->delivery_address }}
                    </strong>

                </div>

            </div>



            <!-- ITEMS -->

            <div class="ordered-items">

                <h4>
                    Order Items
                </h4>

                @foreach($order->items as $item)

                    <div class="ordered-item-row">

                        <div>

                            <strong>
                                {{ $item->menuItem?->name ?? 'Deleted Item' }}
                            </strong>

                            <span>
                                {{ $item->quantity }}
                                ×
                                ${{ number_format($item->price, 2) }}
                            </span>

                        </div>


                        <strong>
                            ${{
                                number_format(
                                    $item->price * $item->quantity,
                                    2
                                )
                            }}
                        </strong>

                    </div>

                @endforeach

            </div>



            <!-- STATUS -->

            <div class="order-status-section">

                <div>

                    <span class="status-title">
                        Current Status
                    </span>

                    <span
                        class="status-pill status-{{ strtolower($order->status) }}"
                    >
                        {{ $order->status }}
                    </span>

                </div>


                @if($order->status === 'Pending')

                    <form
                        action="{{ route('admin.orders.status', $order->id) }}"
                        method="POST"
                        class="status-form"
                    >
                        @csrf
                        @method('PATCH')

                        <select
                            name="status"
                            required
                        >

                            <option value="">
                                Select next status
                            </option>

                            <option value="Preparing">
                                Preparing
                            </option>

                            <option value="Cancelled">
                                Cancelled
                            </option>

                        </select>

                        <button type="submit">
                            Update Status
                        </button>

                    </form>


                @elseif($order->status === 'Preparing')

                    <form
                        action="{{ route('admin.orders.status', $order->id) }}"
                        method="POST"
                        class="status-form"
                    >
                        @csrf
                        @method('PATCH')

                        <select
                            name="status"
                            required
                        >

                            <option value="">
                                Select next status
                            </option>

                            <option value="Delivered">
                                Delivered
                            </option>

                        </select>

                        <button type="submit">
                            Update Status
                        </button>

                    </form>


                @elseif(
                    $order->status === 'Delivered' ||
                    $order->status === 'Cancelled'
                )

                    <div class="final-status-message">
                        This order is complete and cannot be updated further.
                    </div>

                @endif

            </div>

        </div>

    </main>

</div>

</body>

</html>