@extends('layouts/app')
@section('title')
Home
@endsection
@section('pagecontent')

    <div id="masterslider" class="master-slider ms-skin-default mb-0">
        <!-- first slide -->
        <div class="ms-slide">
            <!-- slide background -->
            <img src="{{ asset('assets/masterslider/blank.gif') }}" data-src="{{ asset('assets/img/slider/slide01.jpg') }}" alt="Strongest distribution network" />

            <img class="ms-layer" src="{{ asset('assets/masterslider/blank.gif') }}" data-src="{{ asset('assets/img/slider/slider-line.jpg') }}" alt=""
                style="left: 0; top: 310px;" data-type="image" data-effect="left(short)" data-duration="300"
                data-hide-effect="fade" data-delay="0" />

            <h2 class="ms-layer pi-caption01" style="left: 0; top: 340px;" data-type="text" data-effect="left(short)"
                data-duration="300" data-hide-effect="fade" data-delay="300">
                Same day
            </h2>

            <h2 class="ms-layer pi-caption01" style="left: 0; top: 400px;" data-type="text" data-effect="left(short)"
                data-duration="300" data-hide-effect="fade" data-delay="600">
                pick up
            </h2>

            <h2 class="ms-layer pi-caption01" style="left: 0; top: 460px;" data-type="text" data-effect="left(short)"
                data-duration="300" data-hide-effect="fade" data-delay="900">
                and delivery
            </h2>
        </div><!-- .ms-slide end -->

        <!-- slide 03 start -->
        <div class="ms-slide">
            <!-- slide background -->
            <img src="{{ asset('assets/masterslider/blank.gif') }}" data-src="{{ asset('assets/img/slider/slide03.jpg') }}" alt="Worldwide freight services" />

            <h2 class="ms-layer pi-caption01" style="left: 258px; top: 390px;" data-type="text" data-effect="top(short)"
                data-duration="300" data-hide-effect="fade" data-delay="0">
                Transloads
            </h2>

            <img class="ms-layer" src="{{ asset('assets/masterslider/blank.gif') }}" data-src="{{ asset('assets/img/slider/slider-line.jpg') }}" alt=""
                style="left: 540px; top: 450px;" data-type="image" data-effect="bottom(short)" data-duration="300"
                data-hide-effect="fade" data-delay="300" />

            <p class="ms-layer pi-text" style="left: 278px; top: 470px;" data-type="text" data-effect="top(short)"
                data-duration="300" data-hide-effect="fade" data-delay="600">
                 We got it covered!
            </p>
        </div><!-- .ms-slide slide03 end -->

        <!-- slide 04 start -->
        <div class="ms-slide">
            <!-- slide background -->
            <img src="{{ asset('assets/masterslider/blank.gif') }}" data-src="{{ asset('assets/img/slider/slide04.jpg') }}" alt="Worldwide freight services" />

            <h2 class="ms-layer pi-caption01" style="left: 388px; top: 390px;" data-type="text" data-effect="top(short)"
                data-duration="300" data-hide-effect="fade" data-delay="00">
                {{env('APP_NAME')}}
            </h2>

            <img class="ms-layer" src="{{ asset('assets/masterslider/blank.gif') }}" data-src="{{ asset('assets/img/slider/slider-line.jpg') }}" alt=""
                style="left: 540px; top: 450px;" data-type="image" data-effect="bottom(short)" data-duration="300"
                data-hide-effect="fade" data-delay="300" />

            <p class="ms-layer pi-text" style="left: 265px; top: 470px;" data-type="text" data-effect="top(short)"
                data-duration="300" data-hide-effect="fade" data-delay="600">
                Powerful Transport & Logistics Company
            </p>
        </div><!-- .ms-slide slide04 end -->
    </div><!-- #masterslider end -->

    <div class="page-content parallax parallax01 mb-70">
        <div class="container">
            <div class="row services-negative-top">
                <div class="col-md-4 col-sm-4">
                    <div class="service-feature-box">
                        <div class="service-media">
                            <img src="{{ asset('assets/img/pics/img01.jpg') }}" alt="{{env('APP_NAME')}}" />

                            <a href="#" class="read-more02">
                                <span>
                                    Read more
                                    <i class="fa fa-chevron-right"></i>
                                </span>
                            </a>
                        </div><!-- .service-media end -->

                        <div class="service-body">
                            <div class="custom-heading">
                                <h4>Same day pick up and delivery</h4>
                            </div><!-- .custom-heading end -->

                            <p>
                                We have a wide experience in overland
                                industry specific logistic solutions like
                                pharmaceutical logistics, retail and
                                automotive logistics by train or road.
                            </p>
                        </div><!-- .service-body end -->
                    </div><!-- .service-feature-box-end -->
                </div><!-- .col-md-4 end -->

                <div class="col-md-4 col-sm-4">
                    <div class="service-feature-box">
                        <div class="service-media">
                            <img src="{{ asset('assets/img/pics/img02.jpg') }}" alt="{{env('APP_NAME')}}" />

                            <a href="#" class="read-more02">
                                <span>
                                    Read more
                                    <i class="fa fa-chevron-right"></i>
                                </span>
                            </a>
                        </div><!-- .service-media end -->

                        <div class="service-body">
                            <div class="custom-heading">
                                <h4>Warehousing and storage</h4>
                            </div><!-- .custom-heading end -->

                            <p>
                                {{env('APP_NAME')}} help in storing goods throughout the year and releasing them as and when they are needed,
                                {{env('APP_NAME')}} focuses on the safe storage of your goods.
                            </p>
                        </div><!-- .service-body end -->
                    </div><!-- .service-feature-box-end -->
                </div><!-- .col-md-4 end -->

                <div class="col-md-4 col-sm-4">
                    <div class="service-feature-box">
                        <div class="service-media">
                            <img src="{{ asset('assets/img/pics/img03.jpg') }}" alt="{{env('APP_NAME')}}" />

                            <a href="#" class="read-more02">
                                <span>
                                    Read more
                                    <i class="fa fa-chevron-right"></i>
                                </span>
                            </a>
                        </div><!-- .service-media end -->

                        <div class="service-body">
                            <div class="custom-heading">
                                <h4>Transloads</h4>
                            </div><!-- .custom-heading end -->

                            <p>
                                We provide full supply chain management
                                package including cost effective and fast
                                sea freight. You can also combine this
                                package with other means of transportation.
                            </p>
                        </div><!-- .service-body end -->
                    </div><!-- .service-feature-box-end -->
                </div><!-- .col-md-4 end -->
            </div><!-- .row end -->

            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="btn btn-big btn-yellow btn-centered">
                        <span>
                            view details
                        </span>
                    </a>
                </div><!-- .col-md-12 end -->
            </div><!-- .row end -->
        </div><!-- .container end -->
    </div><!-- .page-content end -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="custom-heading02">
                        <h2>What we Offer</h2>
                        <p>
                            TAILORED LOGISTIC SERVICES
                        </p>
                    </div><!-- .custom-heading02 end -->
                </div><!-- .col-md-12 end -->
            </div><!-- .row end -->

            <div class="row mb-30">
                <div class="col-md-6 col-sm-6">
                    <div class="service-icon-left-boxed">
                        <div class="icon-container animated triggerAnimation" data-animate="zoomIn">
                            <img src="{{ asset('assets/img/svg/pi-checklist-2.svg') }}" alt="checklist icon" />
                        </div><!-- .icon-container end -->

                        <div class="service-details">
                            <h3>Contract logistics</h3>

                            <p>
                                Need custom logistic service? We got it
                                covered. From overland, air, rail and sea
                                transportation. Fast, safe and accurate
                                shipment provided all over the globe.
                            </p>
                        </div><!-- .service-details end -->
                    </div><!-- .service-icon-left-boxed end -->
                </div><!-- .col-md-6 end -->
                <div class="col-md-6 col-sm-6">
                    <div class="service-icon-left-boxed">
                        <div class="icon-container animated triggerAnimation" data-animate="zoomIn">
                            <img src="{{ asset('assets/img/svg/pi-forklift-truck-5.svg') }}" alt="forktruck icon" />
                        </div><!-- .icon-container end -->

                        <div class="service-details">
                            <h3>Warehousing and Storage</h3>

                            <p>
                                {{env('APP_NAME')}} offers intelligent warehouse solution.
                                Lower your storage and good maintenance by
                                using our modern and intelligent warehouses.
                                You can see all locations on location page.
                            </p>
                        </div><!-- .service-details end -->
                    </div><!-- .service-icon-left-boxed end -->
                </div><!-- .col-md-6 end -->

            </div><!-- .row.mb-30 end -->

        </div><!-- .container end -->
    </div><!-- .page-content end -->

    <div class="page-content custom-bkg bkg-dark-blue column-img-bkg dark mb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-2 custom-col-padding-both">
                    <div class="custom-heading">
                        <h3>INDUSTRY SECTORS COVERAGE</h3>
                    </div><!-- .custom-heading end -->

                    <p>
                        We cover different industry sectors, from food and
                        beverage, chemical, retail, durable goods and more.
                        Check the full list.
                    </p>

                    <ul class="service-list clearfix">
                        <li>
                            <div class="icon-container">
                                <img class="svg-white" src="{{ asset('assets/img/svg/pi-cargo-box-2.svg') }}" alt="icon" />
                            </div><!-- .icon-container end -->

                            <p>
                                Consumer Packaged Goods
                            </p>
                        </li>

                        <li>
                            <div class="icon-container">
                                <img class="svg-white" src="{{ asset('assets/img/svg/pi-mark-energy.svg') }}" alt="icon" />
                            </div><!-- .icon-container end -->

                            <p>
                                Chemical Goods
                            </p>
                        </li>

                        <li>
                            <div class="icon-container">
                                <img class="svg-white" src="{{ asset('assets/img/svg/pi-food-beverage.svg') }}" alt="icon" />
                            </div><!-- .icon-container end -->

                            <p>
                                Food and Beverage
                            </p>
                        </li>

                        <li>
                            <div class="icon-container">
                                <img class="svg-white" src="{{ asset('assets/img/svg/pi-cargo-retail.svg') }}" alt="icon" />
                            </div><!-- .icon-container end -->

                            <p>
                                Retail Goods
                            </p>
                        </li>

                        <li>
                            <div class="icon-container">
                                <img class="svg-white" src="{{ asset('assets/img/svg/pi-truck-8.svg') }}" alt="icon" />
                            </div><!-- .icon-container end -->

                            <p>
                                Energy, Oil and Gas
                            </p>
                        </li>
                    </ul><!-- .service-list end -->
                </div><!-- .col-md-6 end -->

                <div class="col-md-6 img-bkg01">
                    <div>&nbsp;</div>
                </div>
            </div><!-- .row end -->
        </div><!-- .container end -->
    </div><!-- .page-content.bkg-dark-blue end -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="custom-heading">
                        <h3>what clients say</h3>
                    </div><!-- .custom-heading end -->

                    <div class="carousel-container">
                        <div id="testimonial-carousel" class="owl-carousel owl-carousel-navigation">
                            <div class="owl-item">
                                <div class="testimonial">
                                    <p>
                                        Best customer support and
                                        response time I have ever seen...
                                    </p>

                                    <div class="testimonial-author">
                                        <p>
                                            TRAVIS BRAID <br />
                                        </p>
                                    </div><!-- .testimonial-author end -->
                                </div><!-- .testimonial end -->
                            </div><!-- .owl-item end -->

                            <div class="owl-item">
                                <div class="testimonial">
                                    <p>
                                        Fast and relaible services
                                    </p>

                                    <div class="testimonial-author">
                                        <p>
                                            JOHN BRAD
                                        </p>
                                    </div><!-- .testimonial-author end -->
                                </div><!-- .testimonial end -->
                            </div><!-- .owl-item end -->
                        </div><!-- #testimonial-carousel end -->
                    </div><!-- .carousel-container end -->
                </div><!-- .col-md-4 end -->

                <div class="col-md-6 col-sm-12 clearfix">
                    <div class="custom-heading">
                        <h3>our locations</h3>
                    </div><!-- .custom-heading end -->

                    <img src="{{ asset('assets/img/pics/locations.jpg') }}" alt="locations illustration" />

                    <br />

                    <p>
                        We are a LTL company that provides the following additional services within a 150 mile radius.
                    </p>
                </div><!-- .col-md-4 end -->
            </div><!-- .row end -->
        </div><!-- .container end -->
    </div><!-- .page-content end -->




    <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script><!-- jQuery library -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script><!-- .bootstrap script -->
    <script src="{{ asset('assets/js/jquery.srcipts.min.js') }}"></script><!-- modernizr, retina, stellar for parallax -->
    <script src="{{ asset('assets/owl-carousel/owl.carousel.min.js') }}"></script><!-- Carousels script -->
    <script src="{{ asset('assets/masterslider/masterslider.min.js') }}"></script><!-- Master slider main js -->
    <script src="{{ asset('assets/js/jquery.matchHeight-min.js') }}"></script><!-- for columns with background image -->
    <script src="{{ asset('assets/js/jquery.dlmenu.min.js') }}"></script><!-- for responsive menu -->
    <script src="{{ asset('assets/js/include.js') }}"></script><!-- custom js functions -->



    <script>
        jQuery(document).ready(function ($) {
            'use strict';

            function equalHeight() {
                $('.page-content.column-img-bkg *[class*="custom-col-padding"]').each(function () {
                    var maxHeight = $(this).outerHeight();
                    $('.page-content.column-img-bkg *[class*="img-bkg"]').height(maxHeight);
                });
            };

            $(document).ready(equalHeight);
            $(window).resize(equalHeight);

            // MASTER SLIDER START
            var slider = new MasterSlider();
            slider.setup('masterslider', {
                width: 1140, // slider standard width
                height: 854, // slider standard height
                space: 0,
                speed: 50,
                layout: "fullwidth",
                centerControls: false,
                loop: true,
                autoplay: true
                        // more slider options goes here...
                        // check slider options section in documentation for more options.
            });
            // adds Arrows navigation control to the slider.
            slider.control('arrows');

            // CLIENTS CAROUSEL START
            $('#client-carousel').owlCarousel({
                items: 6,
                loop: true,
                margin: 30,
                responsiveClass: true,
                mouseDrag: true,
                dots: false,
                responsive: {
                    0: {
                        items: 2,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        responsiveClass: true
                    },
                    600: {
                        items: 3,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        responsiveClass: true
                    },
                    1000: {
                        items: 6,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        responsiveClass: true,
                        mouseDrag: true
                    }
                }
            });

            $('#testimonial-carousel').owlCarousel({
                items: 1,
                loop: true,
                margin: 30,
                responsiveClass: true,
                mouseDrag: true,
                dots: false,
                autoheight: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        responsiveClass: true,
                        autoHeight: true
                    },
                    600: {
                        items: 1,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        responsiveClass: true,
                        autoHeight: true
                    },
                    1000: {
                        items: 1,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        responsiveClass: true,
                        mouseDrag: true,
                        autoHeight: true
                    }
                }
            });
        });
    </script>
@endsection
