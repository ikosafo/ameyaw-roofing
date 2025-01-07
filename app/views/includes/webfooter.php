<footer class="footer font2">
            <div class="footer-top">
                <div class="instagram-box bg-dark">
                    <div class="row m-0 align-items-center">
                        <div class="instagram-follow col-md-4 col-lg-3 d-flex align-items-center">
                            <div class="info-box">
                                <i class="fa fa-map-marker text-white mr-4"></i>
                                <div class="info-box-content">
                                    <h4 class="text-white line-height-1">Locate Us</h4>
                                    <p class="line-height-1">AMASAMAN - KWASHIEKUMA, ACCRA, GHANA</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-lg-9 p-0">
                            <div class="instagram-carousel owl-carousel owl-theme" data-owl-options="{
                                    'items': 2,
                                    'dots': false,
                                    'responsive': {
                                        '480': {
                                            'items': 3
                                        },
                                        '950': {
                                            'items': 4
                                        },
                                        '1200': {
                                            'items' : 5
                                        },
                                        '1500': {
                                            'items': 6
                                        }
                                    }
                                }">
                                <img src="<?php echo URLROOT ?>/public/webassets/images/custom/04.jpg" style="height:160px" alt="footer image"
                                    width="240" height="240">
                                <img src="<?php echo URLROOT ?>/public/webassets/images/custom/05.jpg" style="height:160px" alt="footer image"
                                    width="240" height="240">
                                <img src="<?php echo URLROOT ?>/public/webassets/images/custom/06.jpg" style="height:160px" alt="footer image"
                                    width="240" height="240">
                                <img src="<?php echo URLROOT ?>/public/webassets/images/custom/07.jpg" style="height:160px" alt="footer image"
                                    width="240" height="240">
                                <img src="<?php echo URLROOT ?>/public/webassets/images/custom/08.jpg" style="height:160px" alt="footer image"
                                    width="240" height="240">
                                <img src="<?php echo URLROOT ?>/public/webassets/images/custom/09.jpg" style="height:160px" alt="footer image"
                                    width="240" height="240">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="widget-newsletter d-lg-flex align-items-center flex-wrap">
                        <div class="footer-left d-md-flex flex-wrap align-items-center mr-5">
                            <div class="info-box w-auto mr-5 my-3">
                                <i class="far fa-envelope text-white mr-4"></i>
                                <div class="widget-newsletter-info">
                                    <h4 class="line-height-1 text-white">
                                        Stay Connected
                                    </h4>
                                    <p class="line-height-1">Please provide your email address so we can assist you further or offer a quote.</p>
                                </div>
                            </div>
                            <form action="#" class="my-3">
                                <div class="footer-submit-wrapper d-flex">
                                    <input type="email" class="form-control font-italic"
                                        placeholder="Enter Your E-mail Address..." size="40" required>
                                    <button type="submit" class="btn btn-sm">Sign Up</button>
                                </div>
                            </form>
                        </div>
                        <div class="footer-right text-lg-right">
                            <div class="social-icons my-3">
                                <a href="javascript:void(0);" class="social-icon social-facebook icon-facebook"></a>
                                <a href="javascript:void(0);" class="social-icon social-twitter icon-twitter"></a>
                                <a href="javascript:void(0);" class="social-icon social-linkedin fab fa-linkedin-in"></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="footer-middle">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="widget">
                                    <h4 class="widget-title">Contact Info</h4>
                                    <ul class="contact-info">
                                        <li>
                                            <span class="contact-info-label">Address:</span><?= Tools::companyLocation ?>
                                        </li>
                                        <li>
                                            <span class="contact-info-label">Phone:</span><a href="tel:"><?= Tools::companyTelephone ?></a>
                                        </li>
                                        <li>
                                            <span class="contact-info-label">Email:</span> <a href="mailto:<?= Tools::companyEmail ?>"><?= Tools::companyEmail ?></a>
                                        </li>
                                        <li>
                                            <span class="contact-info-label">Working Days/Hours:</span> Mon - Sat / 9:00 AM - 5:00 PM
                                        </li>
                                    </ul>
                                    <!-- <div class="social-icons">
                                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                                        <a href="#" class="social-icon social-instagram icon-instagram" target="_blank" title="Instagram"></a>
                                    </div> -->
                                    <!-- End .social-icons -->
                                </div>
                                <!-- End .widget -->
                            </div>

                            <div class="col-lg-3 col-sm-6">
                                <div class="widget">
                                    <h4 class="widget-title">Customer Service</h4>

                                    <ul class="links">
                                        <li><a href="#">Order Tracking</a></li>
                                        <li><a href="#">Cart</a></li>
                                        <li><a href="#">Wishlist</a></li>
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/careers">Careers</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/privacy">Privacy</a></li>
                                    </ul>
                                </div>
                                <!-- End .widget -->
                            </div>

                          
                            <div class="col-lg-5 col-sm-6">
                                <div class="widget widget-newsletter">
                                    <h4 class="widget-title">Support Center</h4>
                                    <p>Have questions or need a quote? Provide your email, and our team will get back to you with the details.
                                    </p>
                                    <form action="#" class="mb-0">
                                        <input type="email" class="form-control m-b-3" placeholder="Email address" required="">

                                        <input type="submit" class="btn btn-md btn-primary shadow-none" value="Submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p class="footer-copyright text-lg-center mb-0">&copy; <?= date('Y').' '.Tools::companyName ?></p>
                </div>
            </div>
        </footer>
    </div>

    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
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


            <form class="search-wrapper mb-2" action="#">
                <input type="text" class="form-control mb-0" placeholder="Search..." required />
                <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
            </form>

            <div class="social-icons">
                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
                </a>
                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
                </a>
                <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
                </a>
            </div>
        </div>
    </div>

    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="<?php echo URLROOT ?>/pages/index">
                <i class="icon-home"></i>Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="<?php echo URLROOT ?>/pages/contact" class="">
                <i class="icon-phone-2"></i>Phone
            </a>
        </div>
        <div class="sticky-info">
            <a href="<?php echo URLROOT ?>/pages/wishlist" class="">
                <i class="icon-wishlist-2"></i>Wishlist
            </a>
        </div>
        <div class="sticky-info">
            <a href="<?php echo URLROOT ?>/pages/account" class="">
                <i class="icon-user-2"></i>Account
            </a>
        </div>
        <div class="sticky-info">
            <a href="<?php echo URLROOT ?>/pages/cart" class="">
                <i class="icon-shopping-cart position-relative">
                    <span class="cart-count badge-circle">3</span>
                </i>Cart
            </a>
        </div>
    </div>

   <!--  <div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form"
            style="background: #f1f1f1 no-repeat center/cover url(<?php echo URLROOT ?>/public/webassets/images/newsletter_popup_bg.jpg)">
                <div class="newsletter-popup-content">
                    <img src="<?php echo Tools::companyLogo ?>" alt="Logo" class="logo-newsletter" width="111" height="44">
                    <h2>Subscribe to newsletter</h2>

                    <p>
                        Subscribe to the Porto mailing list to receive updates on new
                        arrivals, special offers and our promotions.
                    </p>

                    <form action="#">
                        <div class="input-group">
                            <input type="email" class="form-control" id="newsletter-email" name="newsletter-email"
                                placeholder="Your email address" required />
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        </div>
                    </form>
                    <div class="newsletter-subscribe">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="0" id="show-again" />
                            <label for="show-again" class="custom-control-label">
                                Don't show this popup again
                            </label>
                        </div>
                    </div>
                </div>

            <button title="Close (Esc)" type="button" class="mfp-close">
                ×
            </button>
        </div> 
    -->

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="<?php echo URLROOT ?>/public/webassets/js/jquery.min.js"></script>
    <script src="<?php echo URLROOT ?>/public/webassets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URLROOT ?>/public/webassets/js/plugins.min.js"></script>
    <script src="<?php echo URLROOT ?>/public/webassets/js/optional/isotope.pkgd.min.js"></script>
    <script src="<?php echo URLROOT ?>/public/webassets/js/jquery.appear.min.js"></script>
    <script src="<?php echo URLROOT ?>/public/webassets/js/jquery.plugin.min.js"></script>


    <!-- Main JS File -->
    <script src="<?php echo URLROOT ?>/public/webassets/js/main.min.js"></script>

    <script>
         feather.replace();
    
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    const headerOffset = document.querySelector('header').offsetHeight; // Adjust based on your header's height
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });
                }
            });
        });
    </script>

    
</body>


</html>