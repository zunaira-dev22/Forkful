<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ForkFul</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-page">
    <div class="container">
        <div class="auth-card">

            <div class="auth-side">
                <div class="auth-side-content">
                    <span class="brand-pill">ForkFul</span>

                    <h1>Welcome back to your comfort kitchen.</h1>

                    <p>
                        Fresh meals, warm flavors, and a smooth ordering experience —
                        all waiting for you.
                    </p>

                    <div class="feature-list">
                        <div class="feature-chip">Freshly prepared meals</div>
                        <div class="feature-chip">Easy ordering</div>
                        <div class="feature-chip">Beautiful food experience</div>
                    </div>

                    <div class="side-image-wrap">
                        <img src="{{ asset('images/image.png') }}" alt="Food" class="side-image">
                    </div>
                </div>
            </div>

            <div class="auth-form-panel">
                <div class="form-wrap">

                    <a href="{{ route('home') }}" class="back-link">← Back to Home</a>

                    <h2>Login</h2>
                    <p class="form-subtitle">Sign in to continue your delicious journey.</p>

                    @if($errors->any())
                        <div class="alert alert-danger auth-alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control auth-input"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control auth-input"
                                placeholder="Enter your password"
                                required
                            >
                        </div>

                        <div class="auth-row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="auth-btn">
                            Login
                        </button>
                    </form>

                    <p class="switch-text">
                        Don’t have an account?
                        <a href="{{ route('register') }}">Create one</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>