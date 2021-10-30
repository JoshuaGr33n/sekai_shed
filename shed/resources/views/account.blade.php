        @extends('layout')
        @section('title', 'Account')
        @section('content')
 @if(\Illuminate\Support\Facades\Auth::check())
      <script>window.location = "{{ URL::to('/') }}";</script>
      <?php exit; ?>
 
 @else  
<section class="page_header">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h2 class="text-uppercase">Account</h2>
<p>Please login or signup to continue with your purchase</p>
</div>
</div>
</div>
</section>

<section class="shop-content">
 @if(Session::has('login_alert'))
 <div class="alert alert-warning">
 {{ Session::get('login_alert') }}
 </div>
 @endif
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="row shop-login">
<div class="col-md-6">
<div class="box-content">
<h3 class="text-center">Existing Customer</h3>
<br>
      @if ($loginErr = Session::get('login_error'))
           <div class="alert alert-danger">
              <p>{{ $loginErr }}</p>
           </div>
           @endif
<form class="logregform" action="Customerlogin" method="post">
{{csrf_field()}}
             <p>
                {{ $errors->first('email') }}
               {{ $errors->first('password') }}
           </p>
<div class="row">
<div class="form-group">
<div class="col-md-12">
<label>E-mail Address</label>
<input type="text" value="" class="form-control" name="email">
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="form-group">
<div class="col-md-12">
<a class="pull-right" href="#">(Lost Password?)</a>
<label>Password</label>
<input type="password" value="" class="form-control" name="password">
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="col-md-6">
<!-- <span class="remember-box checkbox">
<label for="rememberme">
<input type="checkbox" id="rememberme" name="rememberme">Remember Me
</label>
</span> -->
</div>
<div class="col-md-6">
<button type="submit" class="btn btn-default pull-right">Login</button>
</div>
</div>
 </form>
</div>
</div>
<div class="col-md-6">
<div class="box-content">
<h3 class="text-center">New Customer Create Account</h3>
<br>
@if(Session::has('success'))
<div class="alert alert-success">
{{ Session::get('success') }}
 </div>
 @endif

 @if(Session::has('email_duplicate_error'))
  <div class="alert alert-danger">
 {{ Session::get('email_duplicate_error') }}
</div>
 @endif
@if(Session::has('phone_duplicate_error'))
 <div class="alert alert-danger">
 {{ Session::get('phone_duplicate_error') }}
</div>
 @endif

 @if(Session::has('phone_email_duplicate_error'))
<div class="alert alert-danger">
{{ Session::get('phone_email_duplicate_error') }}
</div>
 @endif
 
                  

<form class="logregform" action="create-account" method="post">
{{csrf_field()}}
<div class="row">
<div class="form-group">
<div class="col-md-6">
<label>First Name</label>
<input type="text" value="" class="form-control" name="customer_fname">
</div>
<div class="col-md-6">
<label>Last Name</label>
<input type="text" value="" class="form-control" name="customer_lname">
</div>
</div>
</div>

<div style="height:20px"></div>
        <div class="row" style="margin-left:20px">
          <input class="css-checkbox" name="gender" type="radio"  value="M">
          <label class="form-check-label" for="radio-179">Male</label>
        
          <input class="css-checkbox" name="gender" type="radio" value="F">
          <label class="form-check-label" for="radio-279">Female</label>
        </div>
<div style="height:20px"></div>

<div class="row">
<div class="form-group">
<div class="col-md-12">
<label>Phone</label>
<input type="text" value="" class="form-control" name="customer_phone">
</div>
</div>
</div>

<div class="row">
<div class="form-group">
<div class="col-md-6">
<label>Email</label>
<input type="text" value="" class="form-control" name="email">
</div>
<div class="col-md-6">
<label>Retype Email</label>
<input type="text" value="" class="form-control" name="retype_email">
</div>
</div>
</div>

<div class="clearfix space20"></div>
<div class="row">
<div class="form-group">
<div class="col-md-6">
<label>Password</label>
<input type="password" value="" class="form-control" name="password">
</div>
<div class="col-md-6">
<label>Re-enter Password</label>
<input type="password" value="" class="form-control" name="retype_password">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="space20"></div>
<button type="submit" class="btn btn-default pull-right">Register</button>
</div>
</div>
</form>
</div>
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

@endif

@stop