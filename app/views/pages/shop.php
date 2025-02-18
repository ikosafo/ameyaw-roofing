<?php include ('includes/webheader.php');
extract($data);
?>

<style>

    .modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60%;
        height: 35%;
        max-width: 300px;
        padding: 20px;
        background: #fff;
        z-index: 1000;
        border-radius: 10px;
        overflow-y: scroll;
    }

    .modal-content {
        text-align: center;
    }

    .modal .close {
        position: absolute;
        top: 10px;
        right: 15px;
        cursor: pointer;
        font-size: 18px;
        color: #333;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 999;
        display: none;
    }

    .modal-content {
        border-radius: 0;
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 1) !important;
        position: static !important;
        border:none !important
    }


    .banner-big-sale {
        position: relative;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        overflow: hidden;
    }

    /* Blue overlay */
    .banner-big-sale::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(42, 149, 203, 0.7); /* Semi-transparent blue overlay */
        z-index: 1;
    }

    /* Ensure content stays above the overlay */
    .banner-content {
        position: relative;
        z-index: 2;
    }

    /* "Strong Roofs!" as a rhombus */
    .banner-content b {
        position: relative;
        display: inline-block;
        padding: 10px 20px;
        background: black;
        color: white;
        font-weight: bold;
        transform: rotate(-45deg);
        text-transform: uppercase;
    }

    /* Adjust inner text to rotate back to normal */
    .banner-content b::after {
        content: attr(data-text);
        display: block;
        transform: rotate(45deg);
    }

    /* Responsive height adjustments */
    @media (max-width: 768px) {
        .banner-big-sale {
            height: 280px; /* Smaller height on mobile */
        }
    }


</style>

    <main class="main about">
        <div class="page-header page-header-bg text-left" style="background: 50%/cover #D4E1EA url('<?php echo URLROOT ?>/public/webassets/images/custom/11.jpg');">
            <div class="container">
                <h1 class="text-white"><span class="text-white"></span>GALLERY</h1>
            </div>
        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/pages/index"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                </ol>
            </div>
        </nav>


       <!--  <section class="trendy-section mb-2 mt-5">
            <div class="container">
                <h2 class="section-title appear-animate animated fadeInUpShorter appear-animation-visible" data-animation-name="fadeInUpShorter" data-animation-delay="200" style="animation-duration: 1000ms;">Sample Products</h2>
                <div class="row appear-animate animated fadeInUpShorter appear-animation-visible" data-animation-name="fadeInUpShorter" data-animation-delay="200" style="animation-duration: 1000ms;">
                    <div class="products-slider 5col owl-carousel owl-theme owl-loaded owl-drag" data-owl-options="{ 'margin': 0 }">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <?php foreach ($listWebsiteProducts as $result) { ?>
                                    <div class="owl-item active" style="width: 229.278px;">
                                        <div class="product-default product-hover">
                                            <figure>
                                                <a href="javascript:void(0);" class="product-detail-div product-link" data-description="<?= $result->description ?>" data-prodId="<?= $result->productId ?>">
                                                    <img src="<?= Tools::websiteProductImages($result->uuid) ?>" style="width:400px; height:200px" width="280" height="280" alt="product">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="category-list">
                                                    <a href="javascript:void(0);" class="product-category"><?= Tools::getProductCategoryName($result->categoryId) ?></a>
                                                </div>
                                                <h3 class="product-title">
                                                    <a href="javascript:void(0);" class="product-link" data-prodId="<?= $result->productId ?>">
                                                        <?= $result->productName ?>
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Modal Structure -->
       <!--  <div id="productModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p id="modalDescription"></p>
            </div>
        </div> -->


        <section class="new-products-section">
                <div class="container">
                    <h2 class="section-title heading-border ls-20 border-0">Gallery</h2>

                    <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2 owl-loaded owl-drag" data-owl-options="{
						'dots': false,
						'nav': true,
						'responsive': {
							'992': {
								'items': 4
							},
							'1200': {
								'items': 5
							}
						}
					}">


                    <style>
                    /* Modal styling */
                    .image-modal {
                        display: none;
                        position: fixed;
                        z-index: 99999999 !important;
                        left: 0;
                        top: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.8);
                        justify-content: center;
                        align-items: center;
                    }

                    .image-modal img {
                        max-width: 80%;
                        max-height: 80%;
                        border-radius: 10px;
                    }

                    /* Close button */
                    .close-btn {
                        position: absolute;
                        top: 10px;
                        right: 30px;
                        color: white;
                        font-size: 30px;
                        cursor: pointer;
                    }
                    </style>

                    <!-- Modal Structure -->
                    <div id="imageModal" class="image-modal">
                        <span class="close-btn" onclick="closeModal()">&times;</span>
                        <img id="modalImage" src="" alt="Enlarged Image">
                    </div>
                        
                                 
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            <?php 
                            $images = ['15.jpg', '14.jpg', '13.jpg', '12.jpg', '11.jpg', '08.jpg'];
                            foreach ($images as $image) { ?>
                                <div class="owl-item active" style="width: 220px; margin-right: 20px;">
                                    <div class="product-default appear-animate animated fadeInRightShorter">
                                        <figure>
                                            <img src="<?php echo URLROOT ?>/public/webassets/images/custom/<?php echo $image; ?>" 
                                                style="width:300px;height:270px; cursor:pointer" 
                                                alt="product"
                                                onclick="openModal(this)">
                                        </figure>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                        <div class="owl-nav"><button type="button" title="nav" role="presentation" class="owl-prev disabled"><i class="icon-angle-left"></i></button><button type="button" title="nav" role="presentation" class="owl-next"><i class="icon-angle-right"></i></button></div><div class="owl-dots disabled"></div></div>
                    <!-- End .featured-proucts -->

                    <div class="banner banner-big-sale appear-animate animated fadeInUpShorter appear-animation-visible" data-animation-delay="200" data-animation-name="fadeInUpShorter" style="background: url(<?php echo URLROOT ?>/public/webassets/images/custom/07.jpg) center center / cover rgb(42, 149, 203); animation-duration: 1000ms;">
                        <div class="banner-content row align-items-center mx-0">
                            <div class="col-md-9 col-sm-8">
                                <h2 class="text-white text-uppercase text-center text-sm-left ls-n-20 mb-md-0 px-4">
                                    <b class="d-inline-block mr-3 mb-1 mb-md-0">Strong <br> Roofs!</b> Enjoy huge discounts
                                </h2>
                            </div>
                            <div class="col-md-3 col-sm-4 text-center text-sm-right">
                                <a class="btn btn-light btn-white btn-lg" href="<?php echo URLROOT ?>/pages/contact">Request Quote</a>
                            </div>
                        </div>
                    </div>

                    <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate animated fadeInUpShorter appear-animation-visible" data-animation-delay="100" data-animation-name="fadeInUpShorter" style="animation-duration: 1000ms;">Send a request today
                    </h2>
                </div>
            </section>


    </main>

<?php include ('includes/webfooter.php') ?>   

<script>


    function openModal(img) {
        document.getElementById("modalImage").src = img.src;
        document.getElementById("imageModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("imageModal").style.display = "none";
    }



    document.addEventListener('DOMContentLoaded', () => {
        const wishlistKey = 'wishlist'; // LocalStorage key for wishlist

        const loadWishlist = () => {
            try {
                return JSON.parse(localStorage.getItem(wishlistKey)) || [];
            } catch (e) {
                console.error('Error loading wishlist from localStorage', e);
                return [];
            }
        };

        const saveWishlist = (wishlist) => {
            try {
                localStorage.setItem(wishlistKey, JSON.stringify(wishlist));
            } catch (e) {
                console.error('Error saving wishlist to localStorage', e);
            }
        };

        document.querySelectorAll('.btn-icon-wish').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default behavior

                const prodId = button.getAttribute('prodId');
                const prodName = button.getAttribute('data-name'); // Get product name
                const prodImage = button.getAttribute('data-image'); // Get product image

                let wishlist = loadWishlist();
                const existingItem = wishlist.find(item => item.id === prodId);

                if (existingItem) {
                    // Remove from wishlist
                    wishlist = wishlist.filter(item => item.id !== prodId);
                    button.classList.remove('added-wishlist');
                } else {
                    // Add to wishlist
                    wishlist.push({ id: prodId, name: prodName, image: prodImage });
                    button.classList.add('added-wishlist');
                }

                // Save updated wishlist
                saveWishlist(wishlist);
            });
        });

        const updateWishlistUI = () => {
            const wishlist = loadWishlist();
            document.querySelectorAll('.btn-icon-wish').forEach(button => {
                const prodId = button.getAttribute('prodId');
                if (wishlist.some(item => item.id === prodId)) {
                    button.classList.add('added-wishlist');
                } else {
                    button.classList.remove('added-wishlist');
                }
            });
        };

        updateWishlistUI(); // Initialize the UI

        /* document.querySelectorAll('.product-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default link behavior
                const prodId = link.getAttribute('data-prodId');
                var hash = btoa(btoa(btoa(prodId)));
                if (prodId) {
                    window.location.href = `<?php echo URLROOT ?>/pages/productDetail?prodId=${hash}`;
                }
            });
        }); */
    });



    document.addEventListener("DOMContentLoaded", () => {
        const modal = document.getElementById("productModal");
        const modalContent = document.getElementById("modalDescription");
        const closeModal = document.querySelector(".modal .close");

        // Show modal on hover or click
        document.querySelectorAll(".product-detail-div").forEach(product => {
            product.addEventListener("click", () => {
                showModal(product.getAttribute("data-description"));
            });

            product.addEventListener("click", () => {
                showModal(product.getAttribute("data-description"));
            });
        });

        // Close modal on click of close button
        closeModal.addEventListener("click", () => {
            hideModal();
        });

        // Show modal function
        function showModal(description) {
            modalContent.textContent = description;
            modal.style.display = "block";
            document.body.insertAdjacentHTML('beforeend', '<div class="modal-overlay"></div>');
            document.querySelector('.modal-overlay').style.display = 'block';
        }

        // Hide modal function
        function hideModal() {
            modal.style.display = "none";
            const overlay = document.querySelector('.modal-overlay');
            if (overlay) overlay.remove();
        }
    });


</script>


<style>
.product-default .btn-icon-wish.added-wishlist i:before {
    content: ""; 
    color: #da5555; 
}
</style>
