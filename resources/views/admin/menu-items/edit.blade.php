<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Dish | ForkFul</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

<div class="admin-layout">

    <!-- SIDEBAR -->

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

                <a href="{{ route('menu-items.index') }}" class="admin-link active">
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


    <!-- MAIN -->

    <main class="admin-main">

        <div class="form-page-header">

            <div>

                <p class="small-heading">
                    MENU MANAGEMENT
                </p>

                <h1>
                    Edit Dish
                </h1>

                <p>
                    Update {{ $menuItem->name }}.
                </p>

            </div>


            <a
                href="{{ route('menu-items.index') }}"
                class="back-admin-btn"
            >
                ← Back to Menu
            </a>

        </div>


        <div class="dish-form-card">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('menu-items.update', $menuItem->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="form-grid">

                    <!-- NAME -->

                    <div class="dish-field">

                        <label>Dish Name</label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $menuItem->name) }}"
                            required
                        >

                    </div>


                    <!-- CATEGORY -->

                    <div class="dish-field">

                        <label>Category</label>

                        <select
                            name="category_id"
                            required
                        >

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"

                                    {{
                                        old(
                                            'category_id',
                                            $menuItem->category_id
                                        ) == $category->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- PRICE -->

                    <div class="dish-field">

                        <label>Price</label>

                        <input
                            type="number"
                            name="price"
                            step="0.01"
                            min="0"
                            value="{{ old('price', $menuItem->price) }}"
                            required
                        >

                    </div>


                    <!-- IMAGE -->

                    <div class="dish-field">

                        <label>Image URL</label>

                        <input
                            type="text"
                            name="image"
                            value="{{ old('image', $menuItem->image) }}"
                            required
                        >

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="dish-field full-field">

                        <label>Description</label>

                        <textarea
                            name="description"
                            rows="5"
                            required
                        >{{ old('description', $menuItem->description) }}</textarea>

                    </div>

                </div>


                <div class="edit-preview">

                    <span>
                        Current Image
                    </span>

                    <img
                        src="{{ $menuItem->image }}"
                        alt="{{ $menuItem->name }}"
                    >

                </div>


                <div class="form-actions">

                    <a
                        href="{{ route('menu-items.index') }}"
                        class="cancel-btn"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="save-dish-btn"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>