<nav class="header bg-header transparent-dark " data-pages="header" data-pages-header="autoresize"
     data-pages-resize-class="dark">
    <div class="relative">
        <!-- BEGIN LEFT CONTENT -->
        <div class="pull-left">
            <!-- .header-inner Allows to vertically Align elements to the Center-->
            <div class="header-inner m-l-35">
                <!-- BEGIN LOGO -->
                <img src="{{ URL::asset('assets_new/assets/images/logo.png') }}" width="190" height="40"
                     data-src-retina="{{ URL::asset('assets_new/assets/images/logo.png') }}"
                     class="logo" alt="">
                <img src="{{ URL::asset('assets_new/assets/images/logo.png') }}" width="190" height="40"
                     data-src-retina="{{ URL::asset('assets_new/assets/images/logo.png') }}" class="alt" alt="">
            </div>
        </div>
        <!-- BEGIN HEADER TOGGLE FOR MOBILE & TABLET -->
        <div class="pull-right">
            <div class="header-inner">
                <div class="visible-sm-inline visible-xs-inline menu-toggler pull-right p-r-15"
                     data-pages="header-toggle" data-pages-element="#header">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                </div>
            </div>
        </div>
        <!-- END HEADER TOGGLE FOR MOBILE & TABLET -->
        <!-- BEGIN RIGHT CONTENT -->
        <div class="menu-content mobile-dark clearfix" data-pages-direction="slideRight" id="header">
            <!-- BEGIN HEADER CLOSE TOGGLE FOR MOBILE -->
            <div class="pull-right">
                <a href="#" class="padding-10 visible-xs-inline visible-sm-inline pull-right m-t-10 m-b-10 m-r-10"
                   data-pages="header-toggle" data-pages-element="#header">
                    <i class=" pg-close_line"></i>
                </a>
            </div>
            <!-- END HEADER CLOSE TOGGLE FOR MOBILE -->
            <!-- BEGIN MENU ITEMS -->
            <div class="header-inner">
                <ul class="menu">
                    <li>
                        <a href="{{url('/')}}" class="active">Home </a>
                    </li>
                    <li class="classic">
                        <a href="{{url('/customers')}}">Just Shred It</a>
                    </li>
                    <li>
                        <a href="#">Best Rates</a>
                    </li>
                    <li>
                        <a href="#">Corporate</a>
                    </li>
                    <li>
                        <a href="#">About Us</a>
                    </li>
                </ul>
                <div class="pull-right sm-block sm-full-width">
                    <div class="header-inner">
                        <ul class="menu no-padding">
                            <!--li class="">
                              <a href="#" data-text="Sign up">Sign up </a>
                            </li-->
                            @if (Auth::guard('profile')->guest())
                                <li>
                                    <a href="{{route('home.user')}}" data-text="Login" class="p-r-0">Login</a>
                                </li>
                                <li>
                                    <a href="{{route('home.register')}}" data-text="Sign Up" class="p-r-0">Sign Up</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('home.logout') }}" data-text="Logout" class="p-r-0">Logout</a>
                                </li>
                            @endif
                            <li class="open">
                                <a href="#" data-text="Contact Us">(416) 255 1500 <i class="m-l-10 fa fa-phone"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- BEGIN COPYRIGHT FOR MOBILE -->
                <div class="font-arial m-l-35 m-r-35 m-b-20 visible-sm visible-xs m-t-20">
                    <p class="fs-11 small-text muted">Copyright @ 2022 Start Shredding Inc.</p>
                </div>
                <!-- END COPYRIGHT FOR MOBILE -->
            </div>
            <!-- END MENU ITEMS -->
        </div>
    </div>
</nav>