@extends('layout')
@section('title', 'Pay on Delivery')
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
<h3 class="text-left">Delivery Details</h3>
<br>
                  
<form method="post" action="submit-order">
      {{csrf_field()}}

              
   
      @if(!session('cart'))
      <script type="text/javascript">
       window.location = "{{ url('shop') }}";
     </script>
      @endif

      @if(session('cart'))
      @foreach((array) session('cart') as $id => $details)

          
            <input type="hidden" name="customer" value="James Bond"/>
            <input type="hidden" name="item_name[]" value="{{ $details['name'] }}"/>
            <input type="hidden" name="item_id[]" value="{{ $id }}"/>
            <input type="hidden" name="quantity[]" value="{{ $details['quantity'] }}"/>
            <input type="hidden" name="price[]" value="{{ $details['price'] }}"/>
            <?php if(!empty($details['pic'])){?>
            <input type="hidden" name="pic[]" value="{{ $details['pic'] }}"/>
             <?php }else{?>
                <input type="hidden" name="pic[]" value=""/>
              <?php }?>  
            <input type="hidden" name="payment_status" value="Pending"/>
            <input type="hidden" name="payment_method" value="Pay on Delivery"/>
            @endforeach
           @endif
<div class="clearfix space20"></div>
<div class="row">
<div class="col-md-6">
<label>Email </label>
<input class="form-control" value="{{Auth::user()->email}}" type="text" name="email">
</div>
<div class="col-md-6">
<label>Phone </label>
<input class="form-control" id="billing_phone" value="{{Auth::user()->phone}}" type="text" name="phone">
</div>
</div>
<div class="clearfix space20"></div>
<label>Address</label>
<textarea class="form-control" rows="4" cols="5" name="address">{{Auth::user()->address}}</textarea>
<div class="clearfix space20"></div>
<label>Order Notes</label>
<textarea class="form-control" placeholder="Notes about your order, e.g. special notes for delivery." rows="4" cols="5" name="note"></textarea>

<div class="text-center top-space-lg"><button type="submit" class="btn btn-default btn-lg">Submit</button></div>
   
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
<td><strong><span class="amount">#{{$total}}</span></strong> </td>
</tr>
</tbody>
</table>
<br>


</div>
</div>
</div>
</section>

@stop


