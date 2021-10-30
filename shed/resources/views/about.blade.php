        @extends('layout')
        @section('title', 'About Us')
        @section('content')
<section class="page_header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-uppercase wow fadeInDown">About us</h2>
                <p class="wow fadeInUp">Read our Story, How we started and about the Team</p>
            </div>
        </div>
    </div>
</section>

<section class="about2">
    <div class="container">
        <div class="row wow fadeInUp">
            <div class="col-md-5">
                <img src="{{ asset('public/img/about.png') }}" class="img-responsive" alt="" />
            </div>
            <div class="col-md-7 text-left">
                <h2 class="text-left">Our Story</h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                    release of Letraset sheets containing Lorem Ipsum passage
                </p>
                <a class="btn btn-default" role="button" href="#menu">See Our Menu</a>
            </div>
        </div>
    </div>
</section>

<section class="services">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header wow fadeInDown">
                    <h1 class="white">Special Service<small>What Special services we are offering now</small></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="services-slider wow fadeIn">
                    <div class="service-content text-center">
                        <img src="{{ asset('public/img/ico1.png') }}" class="center-block" alt="" />
                        <h4 class="text-uppercase">Birthday Party</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                    <div class="service-content text-center">
                        <img src="{{ asset('public/img/ico2.png') }}" class="center-block" alt="" />
                        <h4 class="text-uppercase">Wedding Party</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.</p>
                    </div>
                    <div class="service-content text-center">
                        <img src="{{ asset('public/img/ico1.png') }}" class="center-block" alt="" />
                        <h4 class="text-uppercase">Birthday Party</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text ever since the 1500s, when an unknown printer.</p>
                    </div>
                    <div class="service-content text-center">
                        <img src="{{ asset('public/img/ico2.png') }}" class="center-block" alt="" />
                        <h4 class="text-uppercase">Wedding Party</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text when an unknown printer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header wow fadeInDown">
                    <h1>Our Team<small>The Hardworking Team behind the restaurant</small></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 text-center">
                <div class="team-staff wow fadeInUp" data-wow-delay="0.2s">
                    <img src="{{ asset('public/img/team/1.png') }}" class="img-responsive center-block" alt="" />
                    <h4>Enter Name Here</h4>
                    <p>Designation here</p>
                    <ul class="team-social">
                        <li>
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
                <div class="team-staff wow fadeInUp" data-wow-delay="0.4s">
                    <img src="{{ asset('public/img/team/2.png') }}" class="img-responsive center-block" alt="" />
                    <h4>Enter Name Here</h4>
                    <p>Designation here</p>
                    <ul class="team-social">
                        <li>
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
                <div class="team-staff wow fadeInUp" data-wow-delay="0.6s">
                    <img src="{{ asset('public/img/team/3.png') }}" class="img-responsive center-block" alt="" />
                    <h4>Enter Name Here</h4>
                    <p>Designation here</p>
                    <ul class="team-social">
                        <li>
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
                <div class="team-staff wow fadeInUp" data-wow-delay="0.8s">
                    <img src="{{ asset('public/img/team/4.png') }}" class="img-responsive center-block" alt="" />
                    <h4>Enter Name Here</h4>
                    <p>Designation here</p>
                    <ul class="team-social">
                        <li>
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="trusted">
    <div class="trusted-quote">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 wow fadeIn">
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
</div>

<section class="menu space60" id="menu">
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
                                @foreach($menuAbout as $menuAbout)
                                <?php $trimed_category = str_replace("','", " ", $menuAbout->category);?>
                                <div class="menu-item col-sm-6 col-xs-12 {{$trimed_category}}">
                                    <div class="clearfix menu-wrapper">
                                        <h4>{{$menuAbout->name}}</h4>
                                        <span class="price">#{{$menuAbout->price}}</span>
                                        <div class="dotted-bg"></div>
                                    </div>
                                    <p>{{$trimed_category}}</p>
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