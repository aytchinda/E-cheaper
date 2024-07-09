<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title', 'Cheaper | E-commerce')</title>
    @yield('styles')
</head>
<body>


    @include('cheaper/components/header')
    @yield('content')
    @include('cheaper/components/footer')

    @yield('scripts')
</body>
</html>
