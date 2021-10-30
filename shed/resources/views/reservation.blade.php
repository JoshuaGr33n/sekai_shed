        @extends('layout')
        @section('title', 'Reservation')
        @section('content')
<section class="page_header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-uppercase">Reservation</h2>
                <p>Shed is a delicious restaurant</p>
            </div>
        </div>
    </div>
</section>

<section class="reservation">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header wow fadeInDown">
                    <h1>Reservations<small>Book a table online. Leads will reach in your email.</small></h1>
                </div>
            </div>
        </div>
                             @if ($errors->any())
                            <div class="alert alert-danger">
                           <strong>Whoops!</strong> There were some problems with your input.<br><br>
                           <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                           </div>
                           @endif
        <div class="reservation-form wow fadeInUp">
                             <div class="row">
                             @if ($message = Session::get('success'))
                              <div class="alert alert-success">
                               <p>{{ $message }}</p>
                              </div>
                             @endif
            <form id="reservationform" method="POST" action="{{ route('front_reservations.store') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="datepicker">Date</label>
                            <input type="text" name="date" class="form-control" id="datepicker" placeholder="Pick a date" title="Please choose a date" required autocomplete="off"/>
                            <i class="fa fa-calendar-o"></i>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control" id="name"  placeholder="Full Name" title="Your Full Name please" required  name="fname"/>
                            <i class="fa fa-pencil-square-o"></i>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="timepicker">Time</label>
                            <input type="text" class="form-control" id="timepicker" name="time" placeholder="Pick a time" title="Choose Preferred Time" required autocomplete="off"/>
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email ID" title="Please enter your email id" required />
                            <i class="fa fa-envelope-o"></i>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="guests">Guests</label>
                            <input class="form-control" type="number" id="guests" name="guests" placeholder="How many of you?" title="Please enter number of guests" required />
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your Phone Number" title="Please enter your phone number" required  name="phone"/>
                            <i class="fa fa-phone"></i>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="reservation-btn">
                            <button type="submit" class="btn btn-default btn-lg" id="js-reservation-btn">Make Reservation</button>
                            <div id="js-reservation-result" data-success-msg="Form submitted successfully." data-error-msg="Oops. Something went wrong."></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="reservation-footer">
            <p>You can also call: <strong>+1 224 6787 004</strong> to make a reservation.</p>
            <span></span>
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
@stop 