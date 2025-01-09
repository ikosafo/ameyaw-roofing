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
                                    <input type="email" id="emailAddress" class="form-control font-italic"
                                        placeholder="Enter Your E-mail Address..." size="40" required>
                                    <button type="button" id="saveEmail" class="btn btn-sm">Sign Up</button>
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
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6">
                                <div class="widget">
                                    <h4 class="widget-title">Customer Service</h4>

                                    <ul class="links">
                                        <li><a href="<?php echo URLROOT ?>/pages/tracking">Order Tracking</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/cart">Cart</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/wishlist">Wishlist</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/account">My Account</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/careers">Careers</a></li>
                                        <li><a href="<?php echo URLROOT ?>/pages/privacy">Privacy</a></li>
                                    </ul>
                                </div>
                            </div>

                          
                            <div class="col-lg-5 col-sm-6">
                                <div class="widget widget-newsletter">
                                    <h4 class="widget-title">Support Center</h4>
                                    <p>Have questions or need a quote? Provide your email, and our team will get back to you with the details.
                                    </p>
                                    <form action="#" class="mb-0">
                                        <input type="email" id="emailAddress2" class="form-control m-b-3" placeholder="Email address" required="">

                                        <input type="button" id="saveEmail2" class="btn btn-md btn-primary shadow-none" value="Submit">
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
                    <li>
                        <a href="<?php echo URLROOT ?>/pages/index"  
                        class="<?php echo ($_SERVER['REQUEST_URI'] == '//pages/index') ? 'active' : ''; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT ?>/pages/about" class="<?php echo ($_SERVER['REQUEST_URI'] == '//pages/about' || $_SERVER['REQUEST_URI'] == '//pages/careers' || strpos($_SERVER['REQUEST_URI'], '/pages/about#') === 0) ? 'active' : ''; ?>">About</a>
                        <ul>
                            <li><a href="<?php echo URLROOT ?>/pages/about#ourStory">Our Story / History</a></li>
                            <li><a href="<?php echo URLROOT ?>/pages/about#missionVision">Mission and Vision</a></li>
                            <li><a href="<?php echo URLROOT ?>/pages/about#coreValues">Core Values</a></li>
                            <li><a href="<?php echo URLROOT ?>/pages/about#testimonials">Testimonials</a></li>
                            <li><a href="<?php echo URLROOT ?>/pages/careers">Careers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT ?>/pages/services" class="<?php echo ($_SERVER['REQUEST_URI'] == '//pages/services') ? 'active' : ''; ?>">Services</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT ?>/pages/shop" class="<?php echo ($_SERVER['REQUEST_URI'] == '//pages/shop') ? 'active' : ''; ?>">Shop</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT ?>/pages/contact" class="<?php echo ($_SERVER['REQUEST_URI'] == '//pages/contact') ? 'active' : ''; ?>">Contact</a>
                    </li>
                </ul>
            </nav>


            <form class="search-wrapper mb-2" action="#">
                <input type="text" class="form-control mb-0" placeholder="Search..." required />
                <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
            </form>

            <div class="social-icons">
                <a href="javascript:void(0);" class="social-icon social-facebook icon-facebook">
                </a>
                <a href="javascript:void(0);" class="social-icon social-twitter icon-twitter">
                </a>
                <a href="javascript:void(0);" class="social-icon social-instagram icon-instagram">
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
         <?php
            foreach (unserialize(JSVARS) as $jskey => $jsval) {
                echo "var " . $jskey . " = '" . $jsval . "';\n";
            }
        ?>

        var cvhead = <?php echo json_encode(unserialize(JSVARS)); ?>;
        //const urlroot = cvhead.urlroot; 
        console.log(urlroot);  

        feather.replace();

        $(document).ready(function() {
            $('#saveEmail').on('click', function() {
                var email = $('#emailAddress').val();

                if (email == "") {
                    alert("Please enter an email address.");
                    $('#emailAddress').focus();
                    return false;
                } else if (!validateEmail(email)) {
                    alert("Please enter a valid email address.");
                    $('#emailAddress').focus();
                    return false;
                }

                $.ajax({
                    url: `${urlroot}/website/saveEmail`,  
                    type: 'POST',
                    data: { email: email },
                    dataType: 'json',
                    success: function(response) {
                        //alert(response);
                        if (response.success) {
                            alert("You have successfully signed up!");
                            $('#emailAddress').val("");  
                        } else {
                            alert("Error: " + response.message);
                            $('#emailAddress').focus();
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred. Please try again.");
                    }
                });
            });

            function validateEmail(email) {
                var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return regex.test(email);
            }
        });


        $(document).ready(function() {
            $('#saveEmail2').on('click', function() {
                var email = $('#emailAddress2').val();

                if (email == "") {
                    alert("Please enter an email address.");
                    $('#emailAddress2').focus();
                    return false;
                } else if (!validateEmail(email)) {
                    alert("Please enter a valid email address.");
                    $('#emailAddress2').focus();
                    return false;
                }

                $.ajax({
                    url: `${urlroot}/website/saveEmail`,  
                    type: 'POST',
                    data: { email: email },
                    dataType: 'json',
                    success: function(response) {
                        //alert(response);
                        if (response.success) {
                            alert("You have successfully signed up!");
                            $('#emailAddress2').val("");  
                        } else {
                            alert("Error: " + response.message);
                            $('#emailAddress2').focus();
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred. Please try again.");
                    }
                });
            });

            function validateEmail(email) {
                var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return regex.test(email);
            }
        });


        $(document).ready(function() {
            $('#saveContact').on('click', function() {
                var contactName = $('#contactName').val();
                var contactEmail = $('#contactEmail').val();
                var contactMessage = $('#contactMessage').val();

                if (contactEmail == "") {
                    alert("Please enter an email address.");
                    $('#contactEmail').focus();
                    return false;
                } else if (!validateEmail(contactEmail)) {
                    alert("Please enter a valid email address.");
                    $('#contactEmail').focus();
                    return false;
                }

                if (contactName == "") {
                    alert("Please enter your full name.");
                    $('#contactName').focus();
                    return false;
                } 

                if (contactMessage == "") {
                    alert("Please enter your message.");
                    $('#contactMessage').focus();
                    return false;
                } 

                $.ajax({
                    url: `${urlroot}/website/saveContact`,  
                    type: 'POST',
                    data: { 
                        contactName: contactName,
                        contactEmail: contactEmail,
                        contactMessage: contactMessage
                    },
                    dataType: 'json',
                    success: function(response) {
                        //alert(response);
                        if (response.success) {
                            alert("Form submitted successfully. We will get it touch shortly!");
                            $('#contactName').val("");  
                            $('#contactEmail').val("");  
                            $('#contactMessage').val("");  
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred. Please try again.");
                    }
                });
            });

            function validateEmail(email) {
                var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return regex.test(email);
            }
        });

    
    </script>



<script>

    function updateCartCount() {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        $('.cart-count').text(cart.length); 
    }

    // Function to render the cart dropdown content
    function updateCartDropdown() {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        var cartProductsContainer = $('.dropdown-cart-products');
        var cartTotalPrice = 0;

        if (cart.length === 0) {
            cartProductsContainer.html('<p class="empty-cart">Your cart is empty!</p>');
            $('.cart-total-price').text('$0.00');
            return;
        }

        var cartHTML = '';
        var cartTotalPrice = 0; 

        cart.forEach(function (item) {
            var itemTotal = parseFloat(item.price.replace('GHC ', '').replace(',', '')) * 1; 
            cartTotalPrice += itemTotal;

            cartHTML += `
            <div class="product">
                <div class="product-details">
                    <h4 class="product-title">
                        <a href="#">${item.name}</a>
                    </h4>
                    <span class="cart-product-info">
                        <span class="cart-product-qty">1</span>
                        × ${item.price}
                    </span>
                </div>
                <figure class="product-image-container">
                    <a href="#" class="product-image">
                        <img src="${item.image}" alt="product" style="height:80px" width="80" height="80">
                    </a>
                    <a href="#" class="btn-remove" title="Remove Product" data-id="${item.id}">
                        <span>×</span>
                    </a>
                </figure>
            </div>`;
        });

        // Add the subtotal to the cart HTML
        /* cartHTML += `
        <div class="dropdown-cart-total">
            <span>SUBTOTAL:</span>
            <span class="cart-total-price float-right">GHC ${cartTotalPrice.toFixed(2)}</span>
        </div>`; */



        cartProductsContainer.html(cartHTML);
        $('.cart-total-price').text('GHC ' + cartTotalPrice.toFixed(2));
    }

    // Add to Cart functionality
    $(document).on('click', '.addCart', function () {
        var prodId = $(this).attr('prodId');
        var productDetails = {
            id: prodId,
            name: $(this).closest('.product-details').find('.product-title a').text(),
            price: $(this).closest('.product-details').find('.product-price').text(),
            image: $(this).closest('.product-default').find('img').attr('src')
        };

        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (!cart.find(item => item.id === prodId)) {
            cart.push(productDetails);
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        updateCartCount();
        updateCartDropdown();
    });


    // Clear Cart functionality
    $(document).on('click', '.clearCart', function () {
        localStorage.removeItem('cart');
        updateCartCount(); 
        updateCartDropdown(); 
    });


    // Remove single item from Cart
    $(document).on('click', '.btn-remove', function (e) {
        e.preventDefault();

        var prodId = $(this).data('id');
        console.log('Product ID to remove:', prodId); 

        // Fetch the cart from localStorage
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        console.log('Cart before removal:', cart); 

        // Remove the product with the matching id (ensure comparison is of the same type)
        var updatedCart = cart.filter(item => String(item.id) !== String(prodId));
        console.log('Cart after removal:', updatedCart);  

        // If cart is empty, clear localStorage
        if (updatedCart.length === 0) {
            localStorage.removeItem('cart');
        } else {
            // Save the updated cart back to localStorage
            localStorage.setItem('cart', JSON.stringify(updatedCart));
        }

        // Update the cart count and dropdown
        updateCartCount();
        updateCartDropdown();
    });


    // Initialize on page load
    $(document).ready(function () {
        updateCartCount();
        updateCartDropdown(); 
    });

</script>

    
</body>


</html>