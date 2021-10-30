    
        @extends('layout')
        @section('title', 'Cart')
        @section('content')
    <section class="page_header">
    <div class="container">
    <div class="row">
    <div class="col-md-12 text-center">
    <h2 class="text-uppercase">Cart</h2>
    <p>Checkout or add some items to your cart</p>
    </div>
    </div>
    </div>
    </section>
    
    <section class="shop-content">
    <div class="container">
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
                    @if(Session::has('delivery_success'))
                         <div class="alert alert-success">
        	        {{ Session::get('delivery_success') }}
                          </div>
                        @endif
    <span id="status"></span>
    <table class="cart-table table table-bordered">
    <thead>
    <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    </tr>
    </thead>
    <tbody>


    <div style="display:none"> {{ $total = 0 }}
      @if(session('cart'))
      @foreach((array) session('cart') as $id => $details)
      {{$total += $details['price'] * $details['quantity']}}
     
      @endforeach
           @endif


    
    @if(session('cart'))
    @foreach((array) session('cart') as $id => $details)
    <tr>
    <td>
    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-times"></i></button>
    <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
    <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
    </td>
    <td>
    <?php if(!empty($details['pic'])){?>
    <a href="menu_Item_detail/{{ $id }}"><img src="http://localhost/admin/{{ $details['pic'] }}" alt="" height="90" width="90"></a>
    <?php }else{?>
     <a href="menu_Item_detail/{{ $id }}"><img src="public/img/no-img.png" alt="" height="90" width="90"></a>
    <?php }?>
    </td>
    <td>
    <a href="menu_Item_detail/{{ $id }}">{{ $details['name'] }}</a>
    </td>
    <td>
    <span class="amount">#{{ $details['price'] }}</span>
    </td>
    <td>
    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" style="width:50%;margin:auto"/>
    </td>
    <td>
    <span class="product-subtotal">#{{ $details['price'] * $details['quantity'] }}</span>
    </td>
    </tr>
    <!-- <p>This is user {{ $id }} @if (!$loop->last), and @endif</p> -->
    <form method="post" action="payment">
    {{csrf_field()}}
    @include('modal_process_modal')
    </form>
    @endforeach
    @endif
    
    <tr>
    <td colspan="6" class="actions">
    <div class="col-md-6">
    <div class="coupon form-group">
    <label>Coupon:</label>
    <br>
    <input placeholder="Coupon code" class="form-control" type="text">
    <button type="submit">Apply</button>
    </div>
    </div>
    
    <div class="col-md-6">
    @if(session('cart'))
    <button class="btn btn-danger"  data-target="#myModal" class="trigger-btn" data-toggle="modal">Clear Cart</button>
    <form action="clear-cart" method="post">
    {{ csrf_field() }}
     @include('clear_cart_modal')
    </form>
    @endif
    <div class="cart-btn">
     <button class="btn btn-default" type="submit" onclick="window.open('shop', '_self')">Continue Shopping</button>
     @if(session('cart'))
    <button class="btn btn-success" data-toggle="modal" data-target="#modalPoll-1">Checkout</button>
    @endif
    </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    
    <div class="cart_totals">
    <div class="col-md-6 push-md-6 no-padding">
    <h4 class="text-left">Cart Totals</h4>
    <br>
    <table class="table table-bordered col-md-6">
    <tbody>
    <!-- <tr>
    <th>Cart Subtotal</th>
    <td>$<span class="amount cart-total">190.00</span></td>
    </tr>
    <tr>
    <th>Shipping and Handling</th>
    <td>
    Free Shipping
    </td>
    </tr> -->
    <tr>
    <th>Order Total</th>
    <td><strong>#<span class="amount cart-total">{{ $total }}</span></strong> </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>

    <section class="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <p>Get updates about new dishes and upcoming events</p>
                <form class="form-inline" action="#" id="invite" method="POST">
                    <div class="form-group">
                        <input class="e-mail form-control" name="email" id="address" type="email" placeholder="Your Email Address" required />
                    </div>
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-angle-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
  </section>

 

  




  @endsection

  @section('scripts')


    <script type="text/javascript">

        $(".update-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            var parent_row = ele.parents("tr");

            var quantity = parent_row.find(".quantity").val();

            var product_subtotal = parent_row.find("span.product-subtotal");

            var cart_total = $(".cart-total");

            var loading = parent_row.find(".btn-loading");

            loading.show();

            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: quantity},
                dataType: "json",
                success: function (response) {

                    loading.hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                    $("#header-bar").html(response.data);

                    product_subtotal.text(response.subTotal);

                    cart_total.text(response.total);
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            var parent_row = ele.parents("tr");

            var cart_total = $(".cart-total");

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    dataType: "json",
                    success: function (response) {

                        parent_row.remove();

                        $("span#status").html('<div class="alert alert-danger">'+response.msg+'</div>');

                        $("#header-bar").html(response.data);

                        cart_total.text(response.total);
                    }
                });
            }
        });

    </script>

@endsection
    