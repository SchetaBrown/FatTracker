<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">
    @if (!request()->routeIs('product.*') && !request()->routeIs('profile.*') && !request()->routeIs('admin.*'))
        @include('partials.header')
    @else
        @include('partials.product-header')
    @endif
    <main class="px-12.5 w-full py-25">
        @yield('content')
    </main>
    @include('partials.footer')
</body>

</html>
