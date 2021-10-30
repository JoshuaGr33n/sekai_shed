        @extends('layout')
        @section('title', 'My Orders')
        @section('content')

<section class="page_header">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h2 class="text-uppercase">Your Orders</h2>
<p>Your recent orders, shipping &amp; delivery addresses</p>
</div>
</div>
</div>
</section>

<section class="shop-content">
<div class="container">
<div class="row">
<div class="col-md-12">
<h3>Recent Orders</h3>
<br>
<table class="cart-table account-table table table-bordered">
<thead>
<tr>
<th>Order</th>
<th>Order ID</th>
<th>Item Price</th>
<th>Date</th>
<th>Status</th>
<th>Total</th>
<th>Payment Method</th>
<th></th>
</tr>
</thead>
<tbody>
@foreach ($myOrders as $myOrders)
<tr>
<td>
{{ $myOrders->order}}
</td>
<td>
{{ $myOrders->order_id}}

</td>
<td>
#{{$myOrders->price}}
</td>
<td>
{{  date("d M Y  h:i:s A", strtotime($myOrders->created_at)) }}
</td>
<td>
{{ $myOrders->delivery_status}}

</td>
<td>
#{{ $myOrders->price * $myOrders->quantity}} for {{$myOrders->quantity}} items
</td>
<td>
{{ $myOrders->payment_method}}
</td>
<td>
<a href="shop_single_full.html">View</a>
</td>
</tr>
@endforeach

</tbody>
</table>
<br>
<br>
<br>
<div class="ma-address">
<h3 class="text-left">My Addresses</h3>
<p>The following addresses will be used on the checkout page by default.</p>
<div class="row">
<div class="col-md-12">
<h4>Delivery Address <button type="button" id="formButton" class="btn btn-default">Edit</button>
</h4>
<p>
{{Auth::user()->address}}
</p>
</div>
@if(Session::has('success'))
<div class="alert alert-success">
{{ Session::get('success') }}
 </div>
 @endif
<form id="form1" method="post" action="update-address">
{{csrf_field()}}
  <textarea class="form-control" style="width:50%;height:200px" placeholder="Enter Your Address..." name="address">
  {{Auth::user()->address}}
  </textarea>
 
  <input type="submit" id="start_button" onclick="verify()" disabled class="btn btn-default" style="margin-top:20px" value="Submit"/>
</form>

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
<form class="form-inline" action="https://demo.web3canvas.com/themeforest/tomato/php/subscribe.php" id="invite" method="POST">
<div class="form-group">
<input class="e-mail form-control" name="email" id="address" type="email" placeholder="Your Email Address" required>
</div>
<button type="submit" class="btn btn-default">
<i class="fa fa-angle-right"></i>
</button>
</form>
</div>
</div>
</div>
</section>
<script src="{{ asset('public/js/vendor/jquery-1.11.2.min.js') }}"></script>
<script>
$(document).ready(function() {
  $("#formButton").click(function() {
    $("#form1").toggle();
  });
});
</script>

<script type="text/javascript">
   var toggleSubmit = function() {
  var isDisabled = ![].some.call(document.querySelectorAll("textarea"), function(input) {
    return input.value.length;
  });
  
  var submitBtn = document.querySelector("input[type=submit]");
  
  if (isDisabled) {
    submitBtn.setAttribute("disabled", "disabled");
  } else {
    submitBtn.removeAttribute("disabled");
  }
};

document.querySelector("form").addEventListener("input", toggleSubmit, false);
</script>
@stop