<!DOCTYPE html>
<html lang="id">

<head>
    @include('main.partials.head')
    @yield('css')
</head>

<body>
    @include('main.partials.header')
    @yield('content')

    @include('main.partials.footer')

    @include('main.partials.script')
    @yield('script')
</body>

</html>
