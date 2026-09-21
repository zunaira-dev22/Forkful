<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | ForkFul</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

<div class="admin-layout">

    <!-- =========================
         SIDEBAR
    ========================== -->

    <aside class="sidebar">

        <div>
            <a href="{{ route('admin.dashboard') }}" class="admin-logo">
                ForkFul
            </a>

            <p class="admin-label">ADMIN PANEL</p>


            <nav class="admin-nav">

                <a href="{{ route('admin.dashboard') }}" class="admin-link active">
                    <span>⌂</span>
                    Dashboard
                </a>

               <a href="{{ route('menu-items.index') }}" class="admin-link">
    <span>🍽</span>
    Menu Items
</a>

                <a href="{{ route('admin.orders.index') }}" class="admin-link">
    <span>📦</span>
    Orders
</a>

                <a href="{{ route('admin.customers.index') }}" class="admin-link">
    <span>👤</span>
    Customers
</a>

            </nav>
        </div>


        <div class="sidebar-bottom">

            <a href="{{ route('home') }}" class="home-link">
                ← Back to Website
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-btn">
                    Logout
                </button>
            </form>

        </div>

    </aside>



    <!-- =========================
         MAIN CONTENT
    ========================== -->

    <main class="admin-main">

        <!-- TOPBAR -->

        <div class="admin-topbar">

            <div>
                <p class="small-heading">OVERVIEW</p>

                <h1>
                    Welcome back,
                    {{ Auth::user()->name }}
                </h1>

                <p class="top-description">
                    Here's what's happening with ForkFul today.
                </p>
            </div>


            <div class="admin-profile">

                <div class="profile-icon">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>Administrator</span>
                </div>

            </div>

        </div>



        <!-- =========================
             STATS
        ========================== -->

        <div class="stats-grid">

            <div class="stat-card">

                <div class="stat-top">
                    <span class="stat-icon">🍽</span>
                    <span class="stat-badge">Menu</span>
                </div>

                <p>Total Menu Items</p>

             <h2>{{ $totalMenuItems }}</h2>

                <span class="stat-footer">
                    Manage your dishes
                </span>

            </div>


            <div class="stat-card">

                <div class="stat-top">
                    <span class="stat-icon">📦</span>
                    <span class="stat-badge">Orders</span>
                </div>

                <p>Total Orders</p>

            <h2>{{ $totalOrders }}</h2>

                <span class="stat-footer">
                    All customer orders
                </span>

            </div>


            <div class="stat-card">

                <div class="stat-top">
                    <span class="stat-icon">☀</span>
                    <span class="stat-badge">Today</span>
                </div>

                <p>Today's Orders</p>

              <h2>{{ $todayOrders }}</h2>

                <span class="stat-footer">
                    Orders received today
                </span>

            </div>

            <div class="stat-card">

    <div class="stat-top">
        <span class="stat-icon">👤</span>
        <span class="stat-badge">Customers</span>
    </div>

    <p>Total Customers</p>

    <h2>
        {{ $totalCustomers }}
    </h2>

    <span class="stat-footer">
        Registered customer accounts
    </span>

</div>

        </div>



        <!-- =========================
             LOWER SECTION
        ========================== -->

        <div class="dashboard-grid">

            <!-- QUICK ACTIONS -->

            <div class="panel">

                <div class="panel-heading">
                    <div>
                        <p class="small-heading">MANAGE</p>
                        <h3>Quick Actions</h3>
                    </div>
                </div>


                <div class="quick-actions">

                  <a href="{{ route('menu-items.create') }}" class="quick-card">

    <div class="quick-icon">
        +
    </div>

    <div>
        <strong>Add New Dish</strong>
        <span>Add an item to your menu</span>
    </div>

</a>


                    <a href="{{ route('menu-items.index') }}" class="quick-card">

    <div class="quick-icon">
        🍽
    </div>

    <div>
        <strong>Manage Menu</strong>
        <span>Edit or remove dishes</span>
    </div>

</a>


                  <a href="{{ route('admin.orders.index') }}" class="quick-card">

                        <div class="quick-icon">
                            📦
                        </div>

                        <div>
                            <strong>View Orders</strong>
                            <span>
                                Manage customer orders
                            </span>
                        </div>

                    </a>

                </div>

            </div>



            <!-- RECENT ACTIVITY -->

           <div class="panel">

    <div class="panel-heading">

        <div>
            <p class="small-heading">
                ACTIVITY
            </p>

            <h3>
                Recent Orders
            </h3>
        </div>

        <a
            href="{{ route('admin.orders.index') }}"
            class="view-all"
        >
            View all
        </a>

    </div>


    @forelse($recentOrders as $order)

        <div class="recent-order-row">

            <div>

                <strong>
                    Order #{{ $order->id }}
                </strong>

                <span>
                    {{ $order->user->name }}
                </span>

            </div>

            <div class="recent-order-right">

                <strong>
                    ${{ number_format($order->total_price, 2) }}
                </strong>

                <span>
                    {{ $order->status }}
                </span>

            </div>

        </div>

    @empty

        <div class="empty-orders">

            <div class="empty-icon">
                🛍
            </div>

            <h4>No orders yet</h4>

            <p>
                New customer orders will appear here.
            </p>

        </div>

    @endforelse

</div>

        </div>

    </main>

</div>

</body>
</html>