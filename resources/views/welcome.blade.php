<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        .custom-bg {
            background-image: url('https://e0.pxfuel.com/wallpapers/1012/253/desktop-wallpaper-php-programing-php-developer.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="antialiased custom-bg">
    <div class="container">
        <div class="row justify-content-end mt-3">
            <div class="col-auto">
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
