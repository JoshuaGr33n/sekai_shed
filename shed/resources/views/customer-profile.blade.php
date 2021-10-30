        @extends('layout')
        @section('title', 'My Profile')
        @section('content')
 @if(\Illuminate\Support\Facades\Auth::check())
<style>
    form {
  padding: 15px;
  border: 1px solid #666;
  background: #fff;
  display: none;
}


    </style>
<section class="page_header">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h2 class="text-uppercase">My Profile</h2>

</div>
</div>
</div>
</section>

<section class="shop-content">
<div class="container">
<div class="row">
<div class="col-md-12">
<h3>My Profile</h3>
<br>
<br>
<table class="cart-table account-table table table-bordered">
<thead>
<tr>
<th></th>
<th></th>

</tr>
</thead>
<tbody>
<tr>
<td>
Name
</td>
<td>
{{Auth::user()->fname }} {{Auth::user()->lname }}
</td>

</tr>
<tr>
<td>
Email
</td>
<td>
{{Auth::user()->email }}
</td>

</tr>
<tr>
<td>
Phone
</td>
<td>
{{Auth::user()->phone }}
</td>

</tr>

<tr>
<td>
Gender
</td>
<td>
    <?php if (Auth::user()->gender=="M"){
            Auth::user()->gender ='Male';
        } else{ 
            Auth::user()->gender ='Female';
            }
     ?>
  {{Auth::user()->gender }}
</td>

</tr>
</tbody>
</table>
<a href="edit-my-profile"  class="btn btn-default">Edit My Profile</a>
<br>
<br>
<br>
<div class="ma-address">
<h3 class="text-left">My Address</h3>
<p>The following address will be used on the checkout page by default.</p>
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


 @else 
 <script>window.location = "{{ URL::to('/') }}";</script>
      <?php exit; ?> 
 @endif

@stop