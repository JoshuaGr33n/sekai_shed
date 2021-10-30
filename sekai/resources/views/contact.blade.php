
        @extends('layout')
        @section('title', 'Contact Us')
        @section('content')

<section class="page_header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-uppercase">Contact</h2>
                <p>Sekai is a delicious restaurant</p>
            </div>
        </div>
    </div>
</section>

<section class="main-content contact-content">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-left no-margin-top">Address</h3>
                    <div class="footer-address contact-info">
                        <p><i class="fa fa-map-marker"></i>28 Seventh Avenue, Neew York, 10014</p>
                        <p><i class="fa fa-phone"></i>Phone: (415) 124-5678</p>
                        <p>
                            <i class="fa fa-envelope-o"></i>
                            <a href="https://demo.web3canvas.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d3a0a6a3a3bca1a793a1b6a0a7b2a6a1b2bda7fdb0bcbe">[email&#160;protected]</a>
                        </p>
                    </div>
                    <br />
                    <h3 class="text-left no-margin-top">Working hours</h3>
                    <div class="contact-info text-muted">
                        <p>10:00 am to 11:00 pm on Weekdays</p>
                        <p>11:00 am to 11:30 pm on Weekends</p>
                    </div>
                    <br />
                    <h3 class="text-left no-margin-top">Follow Us</h3>
                    <div class="contact-social">
                        <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.dribbble.com/"><i class="fa fa-dribbble"></i></a>
                        <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    @if(Session::has('success'))
                         <div class="alert alert-success">
        	        {{ Session::get('success') }}
                          </div>
                        @endif
                        <!-- id="contactForm" -->
                    <form class="contact-form"  action="contact-send" method="post" id="formValidate">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input class="form-control" name="name" id="name" placeholder="Full Name" type="text" required="required" data-error="Required"/>
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" required="required" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Phone" required="required" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Subject" type="text" id="subject" name="subject" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" placeholder="Message" rows="5"></textarea>
                        </div>
                        <button class="btn btn-default btn-lg btn-block" id="js-contact-btn" type="submit">Send message</button>
                    </form>
                    <div id="js-contact-result" data-success-msg="Form submitted successfully." data-error-msg="Oops. Something went wrong."></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="map" data-latitude="40.6700" data-longitude="-73.9400"></div>

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