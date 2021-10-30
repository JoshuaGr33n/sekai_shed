        @extends('layout')
        @section('title', 'Menu')
        @section('content') 

<section class="page_header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-uppercase">Menu</h2>
                <p>Shed is a delicious restaurant</p>
            </div>
        </div>
    </div>
</section>

<section class="menu space60">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header wow fadeInDown">
                    <h1>Tile Style<small>These fine folks trusted the award winning restaurant.</small></h1>
                </div>
            </div>
        </div>
        <div class="food-menu wow fadeInUp">
            <div class="row">
                <div class="col-md-12">
                    <div class="menu-tags3">
                        <span data-filter="*" class="tagsort3-active">All</span>
                        <span data-filter=".starter">starters</span>
                        <span data-filter=".breakfast">breakfast</span>
                        <span data-filter=".lunch">lunch</span>
                        <span data-filter=".dinner">dinner</span>
                        <span data-filter=".desserts">desserts</span>
                    </div>
                </div>
            </div>
            <div class="row menu-items3" id="data-wrapper">
            
               
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
 <script src="{{ asset('js/vendor/jquery-1.11.2.min.js') }}"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script>
        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        infinteLoadMore(page);

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                infinteLoadMore(page);
            }
        });

        function infinteLoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "/menu?page=" + page,
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
