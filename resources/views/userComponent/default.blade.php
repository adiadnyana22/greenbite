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
                },
                screens: {
                    'sm': '641px',
                    // => @media (min-width: 640px) { ... }

                    'md': '769px',
                    // => @media (min-width: 768px) { ... }

                    'lg': '1025px',
                    // => @media (min-width: 1024px) { ... }

                    'xl': '1281px',
                    // => @media (min-width: 1280px) { ... }

                    '2xl': '1537px',
                    // => @media (min-width: 1536px) { ... }
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
    @include('userComponent.header')

    <main>
        @yield('content')
    </main>

    @include('userComponent.footer')
    
    @yield('footExtention')
</body>
</html>