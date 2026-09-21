<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Dish | ForkFul</title>

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

                <a href="#" class="admin-link">
                    <span>📦</span>
                    Orders
                </a>

                <a href="#" class="admin-link">
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
                <p class="small-heading">MENU MANAGEMENT</p>

                <h1>Add New Dish</h1>

                <p>
                    Create a new dish for the ForkFul menu.
                </p>
            </div>

            <a href="{{ route('menu-items.index') }}" class="back-admin-btn">
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
                action="{{ route('menu-items.store') }}"
                method="POST"
            >

                @csrf


                <div class="form-grid">

                    <!-- NAME -->

                    <div class="dish-field">

                        <label>Dish Name</label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Chicken Burger"
                            required
                        >

                    </div>


                    <!-- CATEGORY -->

                    <div class="dish-field">

                        <label>Category</label>

                        <select name="category_id" required>

                            <option value="">
                                Select category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
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
                            value="{{ old('price') }}"
                            placeholder="e.g. 5.99"
                            required
                        >

                    </div>


                    <!-- IMAGE -->

                    <div class="dish-field">

                        <label>Image URL</label>

                        <input
                            type="text"
                            name="image"
                            value="{{ old('image') }}"
                            placeholder="https://..."
                            required
                        >

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="dish-field full-field">

                        <label>Description</label>

                        <textarea
                            name="description"
                            rows="5"
                            placeholder="Write a short description of the dish..."
                            required
                        >{{ old('description') }}</textarea>

                    </div>

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
                        Add Dish
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>