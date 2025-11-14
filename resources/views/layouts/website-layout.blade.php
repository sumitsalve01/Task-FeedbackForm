<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f4f4f5;
            font-family: "Segoe UI", sans-serif;
            color: #333;
        }

        .website-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e3e5;
            padding: 10px 0;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.2rem;
            color: #4a6fa5 !important;
        }

        .btn-soft {
            background: #4a6fa5;
            color: white;
            border-radius: 6px;
            border: none;
        }

        .btn-soft:hover {
            background: #3a5a82;
        }

        .btn-light-grey {
            background: #e6e7e8 !important;
            color: #333 !important;
        }

        .btn-light-grey:hover {
            background: #d4d5d6 !important;
        }

        .content-container {
            min-height: 75vh;
        }

        .card-custom {
            border-radius: 12px;
            border: 1px solid #e3e3e3;
            background: white;
            transition: 0.2s ease;
        }

        .card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg website-navbar">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home.feedback') }}">
                <i class="fas fa-comment-dots"></i> Feedback Portal
            </a>

            <div class="ms-auto">

                @guest
                    <a href="{{ route('user.login') }}" class="btn btn-light-grey btn-sm me-2">Login</a>
                    <a href="{{ route('user.register') }}" class="btn btn-soft btn-sm">Register</a>
                @endguest

                @auth
                    <span class="navbar-text me-3 fw-semibold">
                        Hi, {{ Auth::user()->name }}
                    </span>

                    <form action="{{ route('user.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-soft btn-sm">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @endauth

            </div>

        </div>
    </nav>
    <div class="content-container py-4">
        @yield('content')
    </div>

    <footer class="text-center py-3 text-muted">
        <small>© {{ date('Y') }} Feedback Portal</small>
    </footer>

</body>

</html>
