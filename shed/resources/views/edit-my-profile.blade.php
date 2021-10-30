@extends('layout')
        @section('title', 'Edit My Profile')
        @section('content')

        @if(\Illuminate\Support\Facades\Auth::check())
<section class="page_header">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h2 class="text-uppercase">Edit Profile</h2>
<p>Update Your Profile</p>
</div>
</div>
</div>
</section>

<section class="shop-content">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="row shop-login">
<div class="col-md-6">
<div class="box-content">
<h3 class="text-center">Change Password</h3>
<br>
      @if ($incorrect_password = Session::get('incorrect_password'))
           <div class="alert alert-danger">
              <p>{{ $incorrect_password }}</p>
           </div>
           @endif

           @if ($password_success = Session::get('password_success'))
           <div class="alert alert-success">
              <p>{{ $password_success }}</p>
           </div>
           @endif
<form class="logregform" action="change-profile-password" method="post">
{{csrf_field()}}
            
               
             {{ $errors->first('new_password') }}<br>
             {{ $errors->first('confirm_new_password') }}<br>
           
<div class="row">
<div class="form-group">
<div class="col-md-12">
<label>Old Password</label>
<input type="password" value="" class="form-control" name="old_password">
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="form-group">
<div class="col-md-12">
<label>New Password</label>
<input type="password" value="" class="form-control" name="new_password">
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="form-group">
<div class="col-md-12">
<label>Confirm New Password</label>
<input type="password" value="" class="form-control" name="confirm_new_password">
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="col-md-6">
</div>
<div class="col-md-6">
<button type="submit" class="btn btn-default pull-right">Save</button>
</div>
</div>
 </form>
</div>
</div>
<div class="col-md-6">
<div class="box-content">
<h3 class="text-center">Edit Profile</h3>
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

<form class="logregform" action="update-account" method="post">
{{csrf_field()}}
<div class="row">
<div class="form-group">
<div class="col-md-6">
<label>First Name</label>
<input type="text"  class="form-control" name="customer_fname" value="{{Auth::user()->fname }}">
</div>
<div class="col-md-6">
<label>Last Name</label>
<input type="text" class="form-control" name="customer_lname" value="{{Auth::user()->lname }}">
</div>
</div>
</div>
  @if (Auth::user()->gender=="M")
    <div style="height:20px"></div>
        <div class="row" style="margin-left:20px">
          <input class="css-checkbox" name="gender" type="radio"  value="M" checked>
          <label class="form-check-label" for="radio-179">Male</label>
        
          <input class="css-checkbox" name="gender" type="radio" value="F">
          <label class="form-check-label" for="radio-279">Female</label>
        </div>
    <div style="height:20px"></div>
          
      @else
           <div style="height:20px"></div>
           <div class="row" style="margin-left:20px">
             <input class="css-checkbox" name="gender" type="radio"  value="M">
             <label class="form-check-label" for="radio-179">Male</label>
           
             <input class="css-checkbox" name="gender" type="radio" value="F" checked>
             <label class="form-check-label" for="radio-279">Female</label>
           </div>
       <div style="height:20px"></div>
       @endif



<div class="row">
<div class="form-group">
<div class="col-md-12">
<label>Phone</label>
<input type="text"  class="form-control" name="customer_phone"  value="{{Auth::user()->phone }}">
</div>
</div>
</div>

<div class="row">
<div class="form-group">
<div class="col-md-6">
<label>Email</label>
<input type="text"  class="form-control" name="email" value="{{Auth::user()->email }}">
</div>
<div class="col-md-6">
<label>Repeat Email</label>
<input type="text"  class="form-control" name="retype_email" value="{{Auth::user()->email }}">
</div>
</div>
</div>

<div class="clearfix space20"></div>
<div class="row">
<div class="form-group">
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="space20"></div>
<button type="submit" class="btn btn-default pull-right">Save</button>
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

@else 
 <script>window.location = "{{ URL::to('/') }}";</script>
      <?php exit; ?> 
 @endif

@stop