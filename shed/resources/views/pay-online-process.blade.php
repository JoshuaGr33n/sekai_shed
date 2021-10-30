        @extends('layout')
        @section('title', 'Pay Online')
        @section('content')
<section class="page_header">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h2 class="text-uppercase">Checkout</h2>
<p>Enter your address and get these items at your doorstep</p>
</div>
</div>
</div>
</section>

<section class="shop-content">
<div class="container">
<div class="row">
<div class="col-md-10 col-md-offset-1">
<div class="row">

<div class="col-md-12">
<div class="billing-details">
<h3 class="text-left">BILLING DETAILS</h3>
<br>
<form>

<div class="clearfix space20"></div>
<div class="row">
<div class="col-md-6">
<label>Email </label>
<input class="form-control" placeholder="email" type="text" name="email" value="{{Auth::user()->email}}">
</div>
<div class="col-md-6">
<label>Phone</label>
<input class="form-control" value="{{Auth::user()->phone}}" placeholder="Phone Number" type="text">
</div>
</div>
<div class="clearfix space20"></div>
<label>Address </label>
<textarea class="form-control" placeholder="Full Address" rows="4" cols="5">{{Auth::user()->address}}</textarea>
<div class="clearfix space20"></div>

<div class="clearfix space20"></div>
<label>Order Notes</label>
<textarea class="form-control" placeholder="Notes about your order, e.g. special notes for delivery." rows="4" cols="5"></textarea>
</form>
</div>
</div>
</div>
<br>
<h4 class="text-left">Your order</h4>
<br>
<table class="table table-bordered extra-padding">
<tbody>
<!-- <tr>
<th>Cart Subtotal</th>
<td><span class="amount">£190.00</span></td>
</tr>
<tr>
<th>Shipping and Handling</th>
<td>
Free Shipping
</td>
</tr> -->
<tr>
<th>Order Total</th>
     <div style="display:none"> {{ $total = 0 }}
      @if(session('cart'))
      @foreach((array) session('cart') as $id => $details)
      {{$total += $details['price'] * $details['quantity']}}
     
      @endforeach
           @endif
<td>
        <strong><span class="amount"> 
        #{{ $total}}
</span></strong> </td>
</tr>
</tbody>
</table>
<br>
<h4 class="text-left">Payment Method</h4>
<br>
<div class="payment-method">
<div class="row">
<form>
<div class="col-md-4">
<label>
<input name="payment" id="radio1" class="css-checkbox" type="radio"><span>Direct Bank Transfer</span></label>
<div class="space20"></div>
<p>Make payment directly into our bank account and use your Order ID as the reference. </p>
</div>
<div class="col-md-4">
<label>
<input name="payment" id="radio2" class="css-checkbox" type="radio"><span>Cheque Payment</span></label>
<div class="space20"></div>
<p>Please send your cheque to BLVCK Fashion House, Oatland Rood, UK, LS71JR</p>
</div>
<div class="col-md-4">
<label>
<input name="payment" id="radio3" class="css-checkbox" type="radio"><span>Paypal</span></label>
<div class="space20"></div>
<p>Pay via PayPal; you can pay with your credit card if you don't have a PayPal account</p>
</div>
</form>
</div>
<br>
<form class="text-center">
<input name="checkboxG2" id="checkboxG2" class="css-checkbox" type="checkbox"><span>I've read and accept the <a href="index.html">terms &amp; conditions</a></span>
<div class="text-center top-space-lg"><button type="submit" class="btn btn-default btn-lg">Pay Now</a></div>
</form>

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
<form class="form-inline" action="" id="invite" method="POST">
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

@stop
