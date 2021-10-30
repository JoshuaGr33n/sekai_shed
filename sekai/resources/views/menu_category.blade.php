@extends('layout')

        @section('title', 'Menu Category')
        @section('content')
<section class="page_header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-uppercase">@foreach($cat as $cat)
                {{$cat->category}}
                @endforeach</h2>
                <p class="text-uppercase"></p>
            </div>
        </div>
    </div>
</section>

@include('aside')
            <div class="col-md-9">
          
                <!-- <div class="shop-grid">
                    <select>
                        <option>Default Sorting</option>
                        <option>Cakes</option>
                        <option>Breads</option>
                        <option>Fries</option>
                        <option>Pizza</option>
                    </select>
                    <div class="sg-list">
                        <a href="shop_left_sidebar.html"><i class="fa fa-th-large"></i></a>
                        <a href="#"><i class="fa fa-reorder"></i></a>
                    </div>
                    <span>Showing 1-9 of 80 Results</span>
                </div> -->
               
                <div class="shop-products">
                    <span id="status"></span>
                    <div class="row" id="data-wrapper">

                    
                      
                     
                    </div>
                </div>
         <!-- Data Loader -->
          <div class="auto-load text-center">
            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                        from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
          </div>
           <!-- Data Loader -->
          
        
             
                <!-- <a href="#" class="btn btn-default load-more">Load more</a> -->
                    
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


<script src="{{ asset('public/js/vendor/jquery-1.11.2.min.js') }}"></script>
    <script>
        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        infinteLoadMore(page);
        var comment_id = $(this).data('id');
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                infinteLoadMore(page);
            }
        });

        function infinteLoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "/menu-category/{{$cat->category}}?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function () {
                        $('.auto-load').show();
                    }
                })
                .done(function (response) {
                    if (response.length == 0) {
                        $('.auto-load').html("No more Item");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }

    </script>





@section('scripts')

    <script type="text/javascript">
       $('#data-wrapper').on('click','.add-to-cart',function(e) {
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