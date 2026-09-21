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
        href="{{ asset('css/customer.css') }}"
    >
</head>

<body>

<div class="customer-page">

    <div class="container">


        <!-- =========================
             HEADER
        ========================== -->

        <div class="detail-header">

            <div>

                <a
                    href="{{ route('customer.orders.index') }}"
                    class="back-link"
                >
                    ← Back to My Orders
                </a>

                <p class="small-heading">
                    ORDER DETAILS
                </p>

                <h1>
                    Order #{{ $order->id }}
                </h1>

                <p class="header-description">

                    Placed on

                    {{ $order->created_at->format('d M Y, h:i A') }}

                </p>

            </div>


            <span
                class="status-badge large-status status-{{ strtolower($order->status) }}"
            >
                {{ $order->status }}
            </span>

        </div>



        <!-- =========================
             MESSAGES
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



        <div class="order-detail-grid">


            <!-- =========================
                 LEFT SIDE
            ========================== -->

            <div class="detail-card">

                <p class="small-heading">
                    ORDER
                </p>

                <h2>
                    Your Items
                </h2>


                @foreach($order->items as $item)

                    <div class="detail-item">

                        <div>

                            <h4>
                                {{ $item->menuItem?->name ?? 'Deleted Item' }}
                            </h4>

                            <span>
                                Quantity:
                                {{ $item->quantity }}
                            </span>

                            <span>
                                Price:
                                ${{ number_format($item->price, 2) }}
                            </span>

                        </div>


                        <strong>
                            ${{ number_format(
                                $item->price * $item->quantity,
                                2
                            ) }}
                        </strong>

                    </div>

                @endforeach

            </div>



            <!-- =========================
                 RIGHT SIDE
            ========================== -->

            <div>


                <!-- DELIVERY -->

                <div class="detail-card">

                    <p class="small-heading">
                        DELIVERY
                    </p>

                    <h2>
                        Delivery Details
                    </h2>


                    <div class="detail-info-row">

                        <span>
                            Customer
                        </span>

                        <strong>
                            {{ Auth::user()->name }}
                        </strong>

                    </div>


                    <div class="detail-info-row">

                        <span>
                            Phone
                        </span>

                        <strong>
                            {{ $order->phone }}
                        </strong>

                    </div>


                    <div class="detail-info-row">

                        <span>
                            Address
                        </span>

                        <strong>
                            {{ $order->delivery_address }}
                        </strong>

                    </div>

                </div>



                <!-- TOTAL -->

                <div class="detail-card total-card">

                    <p class="small-heading">
                        ORDER SUMMARY
                    </p>

                    <div class="order-total-row">

                        <span>
                            Total
                        </span>

                        <strong>
                            ${{ number_format($order->total_price, 2) }}
                        </strong>

                    </div>

                </div>



                <!-- CANCEL ORDER -->

                @if($order->status === 'Pending')

                    <div class="detail-card cancel-card">

                        <h3>
                            Need to cancel?
                        </h3>

                        <p>
                            You can cancel your order while it is still pending.
                        </p>


                        <form
                            action="{{ route('customer.orders.cancel', $order->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to cancel this order?')"
                        >

                            @csrf
                            @method('PATCH')


                            <button
                                type="submit"
                                class="cancel-order-btn"
                            >
                                Cancel Order
                            </button>

                        </form>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

</body>
</html>