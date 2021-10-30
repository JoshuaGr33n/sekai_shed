<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>@yield('title')</title>

  

        <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/css/font-awesome/css/font-awesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/css/plugin.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/js/vendor/vegas/vegas.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/css/main.css') }}" />
       

</head>
<body>
      <div class="preloder animated">
            <div class="scoket">
                <img src="{{ asset('public/img/preloader.svg') }}" alt="" />
            </div>
        </div>



     <nav class="navbar navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/shed/">
                            <img src="{{ asset('public/img/shed.png') }}" alt="nav-logo" style="height:50px; width:120px;"/>
                        </a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="/shed/" class="dropdown-toggle">Home</a>
                            </li>
                            <li class="">
                                <a href="/shed/menu" class="dropdown-toggle">Menu</a>
                            </li>
                            <li class="">
                                <a href="/shed/reservation" class="dropdown-toggle">Reservation</a>
                            </li>
                            <li class="">
                                <a href="/shed/about" class="dropdown-toggle">About us</a>
                            </li>
                            <li class="">
                                <a href="/shed/gallery" class="dropdown-toggle">Gallery</a>
                            </li>
                            <li class="">
                                <a href="/shed/shop" class="dropdown-toggle">Shop</a>
                                <ul class="dropdown-menu">
                                    </li>
                                    <li><a href="#">Cart</a></li>
                                    <li><a href="#">Checkout</a></li>
                                    <li><a href="#">Account</a></li>
                                    <li><a href="#">Orders</a></li>
                                </ul>
                            </li>
                            <li><a href="/shed/contact">Contact</a></li>
                            <li class="dropdown" id="header-bar">
                                <a class="css-pointer dropdown-toggle" href="/shed/cart" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-shopping-cart fsc pull-left"></i><span class="cart-number">{{ count((array) session('cart')) }}</span><span class="caret"></span>
                                </a>
                                <div class="cart-content dropdown-menu">
                                    <div class="cart-title">
                                        <h4>Shopping Cart</h4>
                                    </div>
                                    <div class="cart-items">
                                       @if(session('cart'))
                                       @foreach((array) session('cart') as $id => $details)
                                        <div class="cart-item clearfix">
                                            <div class="cart-item-image">
                                                @if(empty($details['pic']))
                                                <a href="cart"><img src="{{ asset('public/img/no-img.png') }}" alt="{{ $details['name'] }}" style="width:50px;height:50px"/></a>
                                                @else
                                                <a href="cart"><img src="{{ asset('http://localhost/admin/'.$details['pic']) }}" alt="{{ $details['name'] }}" style="width:50px;height:50px"/></a>
                                                @endif
                                            </div>
                                            <div class="cart-item-desc">
                                                <a href="cart">{{ $details['name'] }}</a>
                                                <span class="cart-item-price">#{{ $details['price'] }}</span>
                                                <span class="cart-item-quantity">x {{ $details['quantity'] }}</span>
                                                <!-- <i class="fa fa-times ci-close"></i> -->
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <?php $total = 0 ?>
                                     @foreach((array) session('cart') as $id => $details)
                                     <?php $total += $details['price'] * $details['quantity'] ?>
                                      @endforeach
                                    <div class="cart-action clearfix">
                                        <span class="pull-left checkout-price">#{{ $total }}</span>
                                        <a class="btn btn-default pull-right" href="/shed/cart">View Cart</a>
                                    </div>
                                </div>
                            </li>
                            @if(\Illuminate\Support\Facades\Auth::check())
                             <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->fname }} {{Auth::user()->lname }}<span class="caret"></span></a>
                             <ul class="/shed/dropdown-menu">
                             <li><a href="/shed/profile">My Profile</a></li>
                             <li><a href="/shed/orders">My Orders</a></li>
                              <li><a href="/shed/logout">Logout</a></li>
                            </ul>
                             </li>
                            @else 
                            <li><a href="/shed/account">Account</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
</div>

<div class="main-wrapper">
    @yield('content')
    @include('footer')
</div>

        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="{{ asset('public/js/vendor/jquery-1.11.2.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/jquery.flexslider-min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/spectragram.js') }}"></script>
        <script src="{{ asset('public/js/vendor/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/velocity.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/velocity.ui.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/bootstrap-clockpicker.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/slick.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/wow.min.js') }}"></script>
        <script src="{{ asset('public/js/animation.js') }}"></script>
        <script src="{{ asset('public/js/vendor/vegas/vegas.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/jquery.mb.YTPlayer.js') }}"></script>
        <script src="{{ asset('public/js/vendor/jquery.stellar.js') }}"></script>
        <script src="{{ asset('public/js/main.js') }}"></script>
        <script src="{{ asset('public/js/vendor/mc/jquery.ketchup.all.min.js') }}"></script>
        <script src="{{ asset('public/js/vendor/mc/main.js') }}"></script>


        <script src="{{ asset('public/js/vendor/validate.js') }}"></script>
        <script src="{{ asset('public/js/contact.js') }}"></script>

        <script src="{{ asset('public/js/main.js') }}"></script>

@yield('scripts')

</body>
</html>