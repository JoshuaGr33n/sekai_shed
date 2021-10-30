
        @extends('layout')
        @section('title', $itemData->name)
        @section('content') 

      

<section class="page_header">
    <div class="container">
    <div class="row">
    <div class="col-md-12 text-center">
    <h2 class="text-uppercase">Item</h2>
    <p>{{$itemData->name}}</p>
    </div>
    </div>
    </div>
    </section>
    
    @include('aside')

    
    <div class="col-md-9">
    <div class="col-md-6">
    <span id="status"></span>
      @if(empty($itemData->pic))
      <div>
    <img class="img-responsive" src="{{ asset('public/img/no-img.png') }}" alt="">
    </div>
      @else
    <div class="single-shop-carousel">
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    </div>


    <div class="single-shop-carousel-nav">
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    <div>
    <img class="img-responsive" src="{{ asset('http://localhost/admin/'.$itemData->pic) }}" alt="">
    </div>
    </div>
    @endif


    <div class="clearfix"></div>
    </div>
    
    <div class="col-md-6 shop-single-info">
    <div class="shop-single-title">
    <h3 class="text-left">{{$itemData->name}}</h3>
    </div>
    <div class="shop-single-price">
    <div class="ssp pull-left">#{{$itemData->price}} <span>#{{$itemData->price}}</span></div>
    <div class="rc-ratings pull-right">
    <!-- <span class="fa fa-star active"></span>
    <span class="fa fa-star active"></span>
    <span class="fa fa-star active"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span> -->
    </div>
    </div>
    <p>{{$itemData->description}}</p>
    <div class="quantity">
    <a href="/shed/shop" class="btn btn-success left-space-sm pull-right">Shop</a>
    <a href="javascript:void(0);" data-id="{{$itemData->id}}" class="btn btn-default pull-right add-to-cart">Add to Cart</a>
    </div>
    </div>
    <div class="clearfix"></div>
    <div class="tab-style3">
    
    <div class="align-center mb-40 mb-xs-30">
    <ul class="nav nav-tabs tpl-minimal-tabs animate">
    <li class="active">
    <a aria-expanded="true" href="#mini-one" data-toggle="tab">Food Description</a>
    </li>
    <li class="">
    <a aria-expanded="false" href="#mini-two" data-toggle="tab">Review (20)</a>
    </li>
    </ul>
    </div>
    
    
    <div style="height: auto;" class="tab-content tpl-minimal-tabs-cont align-center section-text">
    <div style="" class="tab-pane fade active in" id="mini-one">
    <p>{{$itemData->description}}</p>
    <p class="list">
    <!-- <span><i class="fa fa-angle-right"></i> Curabitur a dui ut sem pulvinar accumsan a nec quam.</span>
    <span><i class="fa fa-angle-right"></i> Pellentesque euismod turpis eu ante euismod, nec molestie mi ullamcorper.</span>
    <span><i class="fa fa-angle-right"></i> Mauris tristique ante a purus dignissim, eu efficitur libero congue.</span> -->
    </p>
    </div>
    <div style="" class="tab-pane fade" id="mini-two">
    <div class="col-md-12">
    <h4 class="text-left">3 Reviews for Food</h4>
    <br>
    <ul class="comment-list">
    <li>
    <a class="pull-left" href="#"><img class="comment-avatar" src="{{ asset('public/img/xtra/1.jpg') }}" alt="" height="50" width="50"></a>
    <div class="comment-meta">
    <a href="#">John Doe</a>
    <span>
    <em>Feb 17, 2015, at 11:34</em>
    </span>
    </div>
    <div class="rating2">
    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
    </div>
    <p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
    </p>
    </li>
    <li>
    <a class="pull-left" href="#"><img class="comment-avatar" src="{{ asset('public/img/xtra/2.jpg') }}" alt="" height="50" width="50"></a>
    <div class="comment-meta">
    <a href="#">Rebecca</a>
    <span>
    <em>March 08, 2015, at 03:34</em>
    </span>
    </div>
    <div class="rating2">
    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9734;</span>
    </div>
    <p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
    </p>
    </li>
    <li>
    <a class="pull-left" href="#"><img class="comment-avatar" src="{{ asset('public/img/xtra/1.jpg') }}" alt="" height="50" width="50"></a>
    <div class="comment-meta">
    <a href="#">Antony Doe</a>
    <span>
    <em>June 11, 2015, at 07:34</em>
    </span>
    </div>
    <div class="rating2">
    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9734;</span>
    </div>
    <p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
    </p>
    </li>
    </ul>
    <br>
    <h4 class="text-left">Add a review</h4>
    <br>
    <form id="form" class="review-form">
    <div class="row">
    <div class="col-md-6">
    <input name="name" class="input-md form-control" placeholder="Name *" maxlength="100" required="" type="text">
    </div>
    <div class="col-md-6">
    <input name="email" class="input-md form-control" placeholder="Email *" maxlength="100" required="" type="email">
    </div>
    </div>
    <span>Your Ratings</span>
    <div class="clearfix"></div>
    <div class="rating3">
    <span>&#9734;</span><span>&#9734;</span><span>&#9734;</span><span>&#9734;</span><span>&#9734;</span>
    </div>
    <div class="clearfix space20"></div>
    <textarea name="text" id="text" class="input-md form-control" rows="6" placeholder="Add review.." maxlength="400"></textarea>
    <br>
    <button type="submit" class="btn btn-default">
    Submit Review
    </button>
    </form>
    </div>
    <div class="clearfix space30"></div>
    </div>
    </div>
    </div>
    <div class="clearfix"></div>
    <div class="shop-products">
     <h6>More Food Items</h6>
    <div class="row">
    @foreach ($category as $key => $category)
    <div class="col-md-4 col-sm-6">
    <div class="product-info">
    <div class="product-img">
    @if(empty($category->pic))
      <div>
    <img class="img-responsive" src="{{ asset('public/img/no-img.png') }}" alt="">
    </div>
      @else
    <img src="{{ asset('http://localhost/admin/'.$category->pic) }}" alt="" style="height:250px; width:100%"/>
    @endif
    </div>
    <h4><a href="#">{{$category->name}}</a></h4>
    <div class="rc-ratings">
    <!-- <span class="fa fa-star active"></span>
    <span class="fa fa-star active"></span>
    <span class="fa fa-star active"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span> -->
    </div>
    <div class="product-price">#{{$category->price}}</div>
    <div class="shop-meta">
            <p class="btn-holder"><a href="javascript:void(0);" data-id="{{$category->id}}" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
            <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                </p>
           <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
            </div>
    </div>
    </div>
    @endforeach
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    <section class="subscribe">
    <div class="container">
    <div class="row">
    <div class="col-md-12">
    
    <p>Get updates about new dishes and upcoming events</p>
    <form class="form-inline" action="#" id="invite" method="POST">
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

        
    