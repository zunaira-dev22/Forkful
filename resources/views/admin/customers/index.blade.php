<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customers | ForkFul</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

<div class="admin-layout">

    <aside class="sidebar">

        <div>

            <a href="{{ route('admin.dashboard') }}" class="admin-logo">
                ForkFul
            </a>

            <p class="admin-label">
                ADMIN PANEL
            </p>

            <nav class="admin-nav">

                <a href="{{ route('admin.dashboard') }}" class="admin-link">
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

                <a href="{{ route('admin.customers.index') }}" class="admin-link active">
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


    <main class="admin-main">

        <div class="admin-topbar">

            <div>

                <p class="small-heading">
                    CUSTOMER MANAGEMENT
                </p>

                <h1>
                    Customers
                </h1>

                <p class="top-description">
                    View registered ForkFul customers.
                </p>

            </div>

        </div>


        <div class="panel">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($customers as $customer)

                        <tr>

                            <td>
                                {{ $customer->id }}
                            </td>

                            <td>
                                <strong>
                                    {{ $customer->name }}
                                </strong>
                            </td>

                            <td>
                                {{ $customer->email }}
                            </td>

                            <td>
                                {{ $customer->created_at->format('d M Y') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center py-5">
                                No customers found.
                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>
</html>