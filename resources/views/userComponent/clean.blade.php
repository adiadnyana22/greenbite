<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/user/images/logo.png') }}">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4C9A2E',
                        secondary: '#10301B',
                        tertiary: '#EEFFE8',
                        coin: '#FFA008'
                    }
                }
            }
        }
    </script>
    <!-- Alpine -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    @yield('headExtention')
</head>
<body>
    <main>
        @yield('content')
    </main>
    
    @yield('footExtention')
</body>
</html>