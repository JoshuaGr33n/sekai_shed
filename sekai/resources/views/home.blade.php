        @extends('layout')
        @section('title', 'Home')
        @section('content') 
     
          <section class="home">
                <div class="overlay"></div>
                <div class="tittle-block">
                    <div class="logo">
                        <a href="sekai/">
                            <img src="{{ asset('public/img/Sekai.png') }}" alt="logo" style="height:200px; width:300px"/>
                        </a>
                    </div>
                    <h1>DELICIOUS Food</h1>
                    <h2>Sekai is a delicious restaurant</h2>
                </div>
                
            </section>
            
                <section class="about" id="about">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-header wow fadeInDown">
                                    <h1>the restaurant<small>A little about us and a breif history of how we started.</small></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row wow fadeInUp">
                            <div class="col-md-4">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-12 hidden-sm about-photo">
                                            <div class="image-thumb">
                                                <img src="{{ asset('public/img/thumb1.png') }}" data-mfp-src="{{ asset('public/img/fullImages/pic1.jpg') }}" class="img-responsive" alt="logo" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 about-photo hidden-xs">
                                            <img src="{{ asset('public/img/thumb2.png') }}" data-mfp-src="{{ asset('public/img/fullImages/pic2.jpg') }}" class="img-responsive" alt="logo" />
                                        </div>
                                        <div class="col-sm-6 about-photo hidden-xs">
                                            <img src="{{ asset('public/img/thumb3.png') }}" data-mfp-src="{{ asset('public/img/fullImages/pic3.jpg') }}" class="img-responsive" alt="logo" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <p>
                                    Cras ut viverra eros. Phasellus sollicitudin sapien id luctus tempor. Sed hendrerit interdum sagittis. Donec nunc lacus, dapibus nec interdum eget, ultrices eget justo. Nam purus lacus, efficitur eget
                                    laoreet sed, finibus nec neque. Cras eget enim in diam dapibus sagittis. In massa est, dignissim in libero ac, fringilla ornare mi. Etiam interdum ligula purus, placerat aliquam odio faucibus a.
                                    Pellentesque et pulvinar lectus. Fusce scelerisque nisi id nisl gravida ultricies.
                                </p>
                                <br />
                                <p>
                                    Ultrices eget justo. Nam purus lacus, efficitur eget laoreet sed, finibus nec neque. Cras eget enim in diam dapibus sagittis. In massa est, dignissim in libero ac, fringilla ornare mi.
                                </p>
                                <img src="{{ asset('public/img/signature.png') }}" alt="signature" />
                            </div>
                        </div>
                    </div>
                </section>

                <section class="special">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-header wow fadeInDown">
                                    <h1 class="white">special treats<small></small></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row wow fadeInUp">
                            <div class="col-md-offset-1 col-md-10">
                                <div class="flexslider special-slider">
                                    <ul class="slides">
                                        @foreach ($specials as $specials)
                                        <li>
                                            <div class="slider-img">
                                                <img src="{{ asset('http://localhost/admin/'.$specials->pic) }}" alt="" style="width:360px;height:400px"/>
                                            </div>
                                            <div class="slider-content">
                                                <div class="page-header">
                                                    <h1>{{$specials->name}}<small>. {{$specials->category}}.</small></h1>
                                                </div>
                                                <p>
                                                {{$specials->description}}
                                                </p>
                                                <a class="btn btn-default add-to-cart" href="javascript:void(0);" data-id="{{$specials->id}}" role="button">Add to Cart</a>
                                                <a class="btn btn-secondary" href="menu_Item_detail/{{$specials->id}}" role="button">See More</a>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="direction-nav hidden-sm">
                                        <div class="next">
                                            <a><img src="{{ asset('public/img/right-arrow.png') }}" alt="" /></a>
                                        </div>
                                        <div class="prev">
                                            <a><img src="{{ asset('public/img/left-arrow.png') }}" alt="" /></a>
                                        </div>
                                    </div>
                                </div>
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
                             <form role="form" method="POST" action="{{ route('front_reservations.store') }}">
                             {{ csrf_field() }}
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" class="form-control" id="datepicker" placeholder="Pick a date" name="date" required autocomplete="off"/>
                                        <i class="fa fa-calendar-o"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Your Name</label>
                                        <input type="text" class="form-control" placeholder="Full Name" name="fname" required/>
                                        <i class="fa fa-pencil-square-o"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Time</label>
                                        <input type="text" class="form-control" id="timepicker" placeholder="Pick a time" name="time" required autocomplete="off"/>
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" placeholder="Your Email ID" name="email" required/>
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Guests</label>
                                        <input class="form-control" type="number" placeholder="How many of you?" name="guests" required/>
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Enter your Phone Number" name="phone" required/>
                                        <i class="fa fa-phone"></i>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="reservation-btn">
                                        <button class="btn btn-default btn-lg" role="button" type="submit">Make Reservation</button>
                                    </div>
                                </div>
                             </form>  
                            </div>
                        </div>
                        <div class="reservation-footer">
                            <p>You can also call: <strong>+1 224 6787 004</strong> to make a reservation.</p>
                            <span></span>
                        </div>
                    </div>
                </section>

                <section class="features">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-header wow fadeInDown">
                                    <h1 class="white">Our features<small>Little things make us best in town</small></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row wow fadeInUp">
                            <div class="col-md-4 col-sm-6">
                                <div class="features-tile">
                                    <div class="features-img">
                                        <img src="{{ asset('public/img/thumb5.png') }}" alt="" />
                                    </div>
                                    <div class="features-content">
                                        <div class="page-header">
                                            <h1>Serving with love</h1>
                                        </div>
                                        <p>
                                            Aenean suscipit vehicula purus quis iaculis. Aliquam nec leo nisi. Nam urna arcu, maximus eget ex nec, consequat pellentesque enim. Aliquam tempor fringilla odio, vel ullamcorper turpis varius eu.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="features-tile">
                                    <div class="features-img">
                                        <img src="{{ asset('public/img/thumb6.png') }}" alt="" />
                                    </div>
                                    <div class="features-content">
                                        <div class="page-header">
                                            <h1>Serving with love</h1>
                                        </div>
                                        <p>
                                            Aenean suscipit vehicula purus quis iaculis. Aliquam nec leo nisi. Nam urna arcu, maximus eget ex nec, consequat pellentesque enim. Aliquam tempor fringilla odio, vel ullamcorper turpis varius eu.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="features-tile">
                                    <div class="features-img">
                                        <img src="{{ asset('public/img/thumb7.png') }}" alt="" />
                                    </div>
                                    <div class="features-content">
                                        <div class="page-header">
                                            <h1>Serving with love</h1>
                                        </div>
                                        <p>
                                            Aenean suscipit vehicula purus quis iaculis. Aliquam nec leo nisi. Nam urna arcu, maximus eget ex nec, consequat pellentesque enim. Aliquam tempor fringilla odio, vel ullamcorper turpis varius eu.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 visible-sm">
                                <div class="features-tile">
                                    <div class="features-img">
                                        <img src="{{ asset('public/img/thumb5.png') }}" alt="" />
                                    </div>
                                    <div class="features-content">
                                        <div class="page-header">
                                            <h1>Serving with love</h1>
                                        </div>
                                        <p>
                                            Aenean suscipit vehicula purus quis iaculis. Aliquam nec leo nisi. Nam urna arcu, maximus eget ex nec, consequat pellentesque enim. Aliquam tempor fringilla odio, vel ullamcorper turpis varius eu.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="menu">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-header wow fadeInDown">
                                    <h1>Our menu<small>These fine folks trusted the award winning restaurant.</small></h1>
                                </div>
                            </div>
                        </div>
                        <div class="food-menu wow fadeInUp">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="menu-tags">
                                        <span data-filter="*" class="tagsort-active">All</span>
                                        <span data-filter=".starter">starters</span>
                                        <span data-filter=".breakfast">breakfast</span>
                                        <span data-filter=".lunch">lunch</span>
                                        <span data-filter=".dinner">dinner</span>
                                        <span data-filter=".desserts">desserts</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row menu-items">
                                @foreach ($menuHome as $key => $menu)
                                <?php $trimed_category = str_replace("','", " ", $menu->category);?>
                                <div class="menu-item col-sm-6 col-xs-12 <?php print_r($trimed_category);?>">
                                    <div class="clearfix menu-wrapper">
                                        <h4>{{ $menu->name }} {{ $trimed_category }}</h4>
                                        <span class="price">#{{ $menu->price }}</span>
                                        <div class="dotted-bg"></div>
                                    </div>
                                    <p>{{ $trimed_category }}</p>
                                </div>
                                @endforeach
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="menu-btn">
                                        <a class="btn btn-default btn-lg" href="menu" role="button">Explore our menu</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="trusted">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-header wow fadeInDown">
                                    <h1>Trusted By<small>These fine folks trusted tha award winning restaurant</small></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row wow fadeInUp">
                            <div class="col-md-12">
                                <div class="trusted-sponsors">
                                    <div class="item">
                                        <a href="index.html">
                                            <img src="{{ asset('public/img/sponsor/foodsquare.png') }}" alt="sponsors" />
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="index.html">
                                            <img src="{{ asset('public/img/sponsor/opentable.png') }}" alt="sponsors" />
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="index.html">
                                            <img src="{{ asset('public/img/sponsor/tripadvisor.png') }}" alt="sponsors" />
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="index.html">
                                            <img src="{{ asset('public/img/sponsor/zomato.png') }}" alt="sponsors" />
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="index.html">
                                            <img src="{{ asset('public/img/sponsor/foodsquare.png') }}" alt="sponsors" />
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="index.html">
                                            <img src="{{ asset('public/img/sponsor/opentable.png') }}" alt="sponsors" />
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="index.html">
                                            <img src="{{ asset('public/img/sponsor/tripadvisor.png') }}" alt="sponsors" />
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="index.html">
                                            <img src="{{ asset('public/img/sponsor/zomato.png') }}" alt="sponsors" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="trusted-quote">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="trusted-slider">
                                        <ul class="slides">
                                            <li>
                                                <img src="{{ asset('public/img/quote.png') }}" alt="quote" />
                                                <p class="quote-body">
                                                    The world’s a big, big stage for this notorious deli smack in the middle of the theatre district, infamously famous for its over-the-top corned beef and pastrami sandwiches, chopped liver,
                                                    blintzes, celebrities, salami, smoked fish and New York’s finest cheesecake.
                                                </p>
                                                <p class="quote-author">Anthony Reed, <span>New York</span></p>
                                            </li>
                                            <li>
                                                <img src="{{ asset('public/img/quote.png') }}" alt="quote" />
                                                <p class="quote-body">
                                                    You might not find dragon meat on the menu, but you’ll find pretty much anything else that walks, swims or flies, cooked up in more ways than there are people in the Guangdong province.
                                                    This Midtown mainstay has a 20-year history of delivering mouth-watering and Cantonese style chow.
                                                </p>
                                                <p class="quote-author">Gemma Arterton, <span>Bay Area</span></p>
                                            </li>
                                            <li>
                                                <img src="{{ asset('public/img/quote.png') }}" alt="quote" />
                                                <p class="quote-body">
                                                    This NYC historical landmark in the heart of the Theatre District has been serving up suds and down home pub food since 1892, surviving prohibition by renting the front of its then
                                                    Rockefeller Center façade to Greek florists, while the Hurley brothers ran a speak-easy in back.
                                                </p>
                                                <p class="quote-author">Zachary Burton, <span>Sanfransisco</span></p>
                                            </li>
                                        </ul>
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
    $(".add-to-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        ele.siblings('.btn-loading').show();

        $.ajax({
            url: '{{ url('add-to-cart') }}' + '/' + ele.attr("data-id"),
            method: "get",
            data: {_token: '{{ csrf_token() }}'},
            dataType: "json",
            success: function (response) {

                ele.siblings('.btn-loading').hide();

                $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                $("#header-bar").html(response.data);
            }
        });
    });
</script>


    @stop 