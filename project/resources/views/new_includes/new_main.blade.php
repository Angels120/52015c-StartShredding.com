<!DOCTYPE html>
<html>
    <head>
    
        @include('partials._head')
    
    </head>
    <body class="fixed-header">
        @include('partials._nav')
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper ">
        {{-- @include('partials._message') --}}

            @yield('content')

            @include('partials._footer')


        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>

<!-- END PAGE CONTAINER -->
@yield('scripts')
    </body>
</html>