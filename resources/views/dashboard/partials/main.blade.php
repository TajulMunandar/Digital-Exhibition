<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.partials.head')
    @yield('css')
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('dashboard.partials.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('dashboard.partials.navbar')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('content')
            @include('dashboard.partials.footer')
        </div>
    </main>
  
    @include('dashboard.partials.script')
    @yield('script')
</body>

</html>
