<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Menu Items | ForkFul</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet"
          href="{{ asset('css/admin.css') }}">
</head>

<body>

<div class="admin-layout">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div>

            <a href="{{ route('admin.dashboard') }}"
               class="admin-logo">
                ForkFul
            </a>

            <p class="admin-label">
                ADMIN PANEL
            </p>

            <nav class="admin-nav">

                <a href="{{ route('admin.dashboard') }}"
                   class="admin-link">

                    <span>⌂</span>
                    Dashboard

                </a>

                <a href="{{ route('menu-items.index') }}"
                   class="admin-link active">

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

            <a href="{{ route('home') }}"
               class="home-link">

                ← Back to Website

            </a>

            <form action="{{ route('logout') }}"
                  method="POST">

                @csrf

                <button type="submit"
                        class="logout-btn">

                    Logout

                </button>

            </form>

        </div>

    </aside>



    <!-- MAIN -->

    <main class="admin-main">

        <div class="admin-topbar">

            <div>

                <p class="small-heading">
                    MENU MANAGEMENT
                </p>

                <h1>
                    Menu Items
                </h1>

                <p class="top-description">
                    Add, edit, and manage ForkFul dishes.
                </p>

            </div>


            <a href="{{ route('menu-items.create') }}"
               class="add-dish-btn">

                + Add New Dish

            </a>

        </div>



        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif



        <div class="menu-admin-grid">

            @forelse($menuItems as $item)

                <div class="admin-menu-card">

                    <img
                        src="{{ $item->image }}"
                        alt="{{ $item->name }}"
                    >

                    <div class="admin-menu-content">

                        <span class="category-label">
                            {{ $item->category->name }}
                        </span>

                        <h3>
                            {{ $item->name }}
                        </h3>

                        <p>
                            {{ $item->description }}
                        </p>

                        <div class="admin-menu-bottom">

                            <strong>
                                ${{ number_format($item->price, 2) }}
                            </strong>


                            <div class="admin-actions">

                                <a
                                    href="{{ route('menu-items.edit', $item->id) }}"
                                    class="edit-btn"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('menu-items.destroy', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this dish?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-btn"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <p>No menu items found.</p>

            @endforelse

        </div>

    </main>

</div>

</body>
</html>