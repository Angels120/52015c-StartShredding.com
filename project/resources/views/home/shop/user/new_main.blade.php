<!DOCTYPE html>
<html>
<head>
    @include('home.shop.user._head')
</head>
<body class="fixed-header">
@include('home.shop.user._nav')
<div class="page-content-wrapper ">
    @yield('content')
    @include('home.shop.user._footer')
</div>
</div>
@yield('scripts')
</body>
</html>