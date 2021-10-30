
       <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/css/font-awesome/css/font-awesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/css/plugin.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/js/vendor/vegas/vegas.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/css/main.css') }}" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    
        
                             <a class="css-pointer dropdown-toggle" href="cart" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
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