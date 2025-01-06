<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= Tools::companyName ?> - Your Trusted Partner in Roofing Excellence</title>

    <meta name="keywords" content="roofing services, roof repair, roof installation, residential roofing, commercial roofing, roof maintenance, Ghana roofing, Ghana roofers">
    <meta name="description" content="Professional roofing services in Ghana, specializing in roof repair, installation, and maintenance for residential and commercial properties. Contact us for reliable and quality roofing solutions.">
    <meta name="author" content="<?php echo Tools::companyName ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo Tools::companyLogo ?>">
    <script src="<?php echo URLROOT ?>/public/webassets/js/feather.min.js"></script>

    <!-- <script>
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,600,700,800', 'Poppins:200,300,400,500,600,700,800', 'Oswald:300,600,700', 'Playfair+Display:700' ] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[ 0 ];
            wf.src = 'public/webassets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script> -->

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/webassets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/webassets/css/demo27.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT ?>/public/webassets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT ?>/public/webassets/vendor/simple-line-icons/css/simple-line-icons.min.css">

	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
	
	  body {
		font-family: "Poppins", serif !important;
	  }

      .top-icon {
            width: 15.5px;
            height: 15.5px;
        }

        .menu ul a {
            font-family: "Poppins", sans-serif;
            font-size: 12px;
        }

        .menu .megamenu .submenu a {
            padding: 7px 8px 8px 0;
            font-family: "Poppins", sans-serif;
            font-size: 12px;
        }
        
	</style>
</head>

<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <a href="tel:+1234567890" class="contact-link">
                            <i data-feather="phone"  class="top-icon"></i> <?= Tools::companyTelephone ?>
                        </a>

                        <a href="tel:+1234567890" class="contact-link ml-5">
                            <i data-feather="map-pin"  class="top-icon"></i> <?= Tools::companyLocation ?>
                        </a>
                    </div>


                    <div class="header-right d-none d-lg-flex">
                        <p class="top-message text-uppercase mr-2">Your Trusted Partner in Roofing Excellence</p>
                        <div class="header-dropdown dropdown-expanded">
                            <a href="#">Links</a>
                            <div class="header-menu">
                                <ul>
                                    <li><a href="dashboard.html">My Account</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a href="<?php echo URLROOT ?>/pages/index" class="logo">
                            <img src="<?php echo Tools::companyLogo ?>" alt="Porto Logo" width="111" height="44">
                        </a>
                        <nav class="main-nav">
                        <ul class="menu">
                                <li class="active">
                                    <a href="<?php echo URLROOT ?>/pages/index">Home</a>
                                </li>
                                <li>
                                    <a href="<?php echo URLROOT ?>/pages/about">About</a>
                                    <ul>
                                        <li><a href="<?php echo URLROOT ?>/pages/our-story">Our Story / History</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/mission-vision">Mission and Vision</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/core-values">Core Values</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/testimonials">Testimonials</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/careers">Careers</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo URLROOT ?>/pages/services">Services</a>
                                </li>
                                <li>
                                    <a href="<?php echo URLROOT ?>/pages/shop">Shop</a>
                                </li>
                                <li>
                                    <a href="<?php echo URLROOT ?>/pages/contact">Contact</a>
                                </li>
                            </ul>

                        </nav>
                    </div>

                    <div class="header-right">
                   
                        <div
                        
                            class="header-icon header-search header-search-inline header-search-category w-lg-max text-right d-none d-sm-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                            <form action=" #" method="get">
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="q" id="q"
                                        placeholder="I'm searching for..." required>
                                        

                                    <button class="btn icon-magnifier" title="search" type="submit"></button>
                                </div>
                            </form>
                        </div>


                        <a href="<?php echo URLROOT ?>/pages/wishlist" class="header-icon">
                            <i class="icon-wishlist-2 line-height-1"></i>
                        </a>

                        <div class="dropdown cart-dropdown">
                            <a href="#" title="Cart" class="dropdown-toggle cart-toggle" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="minicart-icon"></i>
                                <span class="cart-count badge-circle">3</span>
                            </a>

                            <div class="cart-overlay"></div>

                            <div class="dropdown-menu mobile-cart">
                                <a href="#" title="Close (Esc)" class="btn-close">×</a>

                                <div class="dropdownmenu-wrapper custom-scrollbar">
                                    <div class="dropdown-cart-header">Shopping Cart</div>
                                    <!-- End .dropdown-cart-header -->

                                    <div class="dropdown-cart-products">
                                        <div class="product">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                    <a href="demo27-product.html">Ultimate 3D Bluetooth Speaker</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">1</span>
                                                    × $99.00
                                                </span>
                                            </div><!-- End .product-details -->

                                            <figure class="product-image-container">
                                                <a href="demo27-product.html" class="product-image">
                                                    <img src="<?php echo URLROOT ?>/public/webassets/images/products/product-1.jpg" alt="product"
                                                        width="80" height="80">
                                                </a>

                                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                                            </figure>
                                        </div><!-- End .product -->

                                        <div class="product">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                    <a href="demo27-product.html">Brown Women Casual HandBag</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">1</span>
                                                    × $35.00
                                                </span>
                                            </div><!-- End .product-details -->

                                            <figure class="product-image-container">
                                                <a href="demo27-product.html" class="product-image">
                                                    <img src="<?php echo URLROOT ?>/public/webassets/images/products/product-2.jpg" alt="product"
                                                        width="80" height="80">
                                                </a>

                                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                                            </figure>
                                        </div><!-- End .product -->

                                        <div class="product">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                    <a href="demo27-product.html">Circled Ultimate 3D Speaker</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">1</span>
                                                    × $35.00
                                                </span>
                                            </div><!-- End .product-details -->

                                            <figure class="product-image-container">
                                                <a href="demo27-product.html" class="product-image">
                                                    <img src="<?php echo URLROOT ?>/public/webassets/images/products/product-3.jpg" alt="product"
                                                        width="80" height="80">
                                                </a>
                                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                                            </figure>
                                        </div><!-- End .product -->
                                    </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>SUBTOTAL:</span>

                                        <span class="cart-total-price float-right">$134.00</span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="cart.html" class="btn btn-gray btn-block view-cart">View
                                            Cart</a>
                                        <a href="checkout.html" class="btn btn-dark btn-block">Checkout</a>
                                    </div><!-- End .dropdown-cart-total -->
                                </div><!-- End .dropdownmenu-wrapper -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .dropdown -->
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="owl-carousel info-boxes-slider" data-owl-options="{
                        'items': 1,
                        'dots': false,
                        'loop': false,
                        'responsive': {
                            '768': {
                                'items': 2
                            },
                            '992': {
                                'items': 3
                            }
                        }
                    }">
                    <div class="info-box info-box-icon-left">
                        <i class="icon-shipping text-white"></i>

                        <div class="info-box-content">
                            <h4 class="text-white">Free Shipping &amp; Return</h4>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->

                    <div class="info-box info-box-icon-left">
                        <i class="icon-money text-white"></i>

                        <div class="info-box-content">
                            <h4 class="text-white">Money Back Guarantee</h4>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->

                    <div class="info-box info-box-icon-left">
                        <i class="icon-support text-white"></i>

                        <div class="info-box-content">
                            <h4 class="text-white">Online Support 24/7</h4>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                </div><!-- End .owl-carousel -->
            </div>
        </header><!-- End .header -->