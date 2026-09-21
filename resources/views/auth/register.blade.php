<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | ForkFul</title>

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

                    <h1>Create your account and start ordering in style.</h1>

                    <p>
                        Join ForkFul to explore comforting meals, elegant presentation,
                        and a food experience made just for you.
                    </p>

                    <div class="feature-list">
                        <div class="feature-chip">Quick sign up</div>
                        <div class="feature-chip">Personalized orders</div>
                        <div class="feature-chip">Warm & premium experience</div>
                    </div>

                    <div class="side-image-wrap">
                        <img src="{{ asset('images/image.png') }}" alt="Food" class="side-image">
                    </div>
                </div>
            </div>

            <div class="auth-form-panel">
                <div class="form-wrap">

                    <a href="{{ route('home') }}" class="back-link">← Back to Home</a>

                    <h2>Register</h2>
                    <p class="form-subtitle">Create your account to start ordering your favorites.</p>

                    @if($errors->any())
                        <div class="alert alert-danger auth-alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control auth-input"
                                placeholder="Enter your full name"
                                value="{{ old('name') }}"
                                required
                            >
                        </div>

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
                                placeholder="Create a password"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control auth-input"
                                placeholder="Confirm your password"
                                required
                            >
                        </div>

                        <button type="submit" class="auth-btn">
                            Create Account
                        </button>
                    </form>

                    <p class="switch-text">
                        Already have an account?
                        <a href="{{ route('login') }}">Login here</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>