<!DOCTYPE html>
<html>
<head>
    <link class="main-stylesheet" href="{{ URL::asset('shop_assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
    <link class="main-stylesheet" href="{{ URL::asset('shop_assets/css/pages-icons.css')}}" rel="stylesheet" type="text/css" />
    @include('home.shop.user._head')
</head>
<body class="fixed-header">
<div class="page-content-wrapper ">
    @yield('content')
</div>
</div>
@yield('scripts')
</body>
</html>