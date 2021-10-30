<div class="shop-content">
    <div class="container">
    <div class="row">
    <aside class="col-md-3">
    <div class="side-widget">
    <h5>Our Food</h5>
    <ul class="shop-cat">
    <li><a href="/shed/shop">All <i class="fa fa-caret-right"></i></a></li>
        @foreach($categories as $categories)
    <li><a href="{{ route('menu-category',$categories->category) }}">{{$categories->category}}<i class="fa fa-caret-right"></i></a></li>
    @endforeach
    </ul>
    </div>
    <div class="side-widget">
    <h5>New Arrivals</h5>
    <ul class="recent-products">
    @foreach ($newArrivals as $key => $newArrivals)
    <li>
    @if(!empty($newArrivals->pic)) 
    <img src="{{ asset('http://localhost/admin/'.$newArrivals->pic) }}" alt="" />
    @else
    <img src="{{ asset('public/img/no-img.png') }}" alt="" />
    @endif
    <div class="rpp-info">
    <a href="/shed/menu_Item_detail/{{$newArrivals->id}}">{{$newArrivals->name}}</a>
    <div class="rc-ratings">
    <!-- <span class="fa fa-star active"></span>
    <span class="fa fa-star active"></span>
    <span class="fa fa-star active"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span> -->
    </div>
    <span>#{{$newArrivals->price}}</span>
    </div>
    </li>
    @endforeach
    </ul>
    </div>
    </aside>