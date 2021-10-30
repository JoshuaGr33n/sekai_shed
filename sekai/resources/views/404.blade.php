@extends('layout')
        @section('title', '404 Not Found')
        @section('content')
<section class="page_header vertical-padding">
</section>
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<div class="giant-space">
<h2 class="text-giant">404</h2>
<p class="wow fadeInUp">Sorry. The page you are looking for is not found</p>
<p class="top-space-lg"><a href="sekai/" class="btn btn-default btn-lg">Back to home</a></p>
</div>
</div>
</div>
</div>

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