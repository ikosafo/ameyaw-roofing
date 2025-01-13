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


</style>

    <main class="main about">
        <div class="page-header page-header-bg text-left" style="background: 50%/cover #D4E1EA url('<?php echo URLROOT ?>/public/webassets/images/custom/11.jpg');">
            <div class="container">
                <h1 class="text-white"><span class="text-white"></span>SHOP</h1>
            </div>
        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/pages/index"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                </ol>
            </div>
        </nav>


        <section class="trendy-section mb-2 mt-5">
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
                                                <div class="price-box">
                                                    <span class="old-price">GHC <?= number_format($result->unitPrice * 1.2, 2) ?></span> <br>
                                                    <span class="product-price">GHC <?= number_format($result->unitPrice, 2) ?></span>
                                                </div>
                                                <div class="product-action">
                                                    <a href="javascript:void(0);" class="btn-icon-wish" title="wishlist" prodId="<?= $result->productId ?>" data-name="<?= $result->productName ?>" data-image="<?= Tools::websiteProductImages($result->uuid) ?>">
                                                        <i class="icon-heart"></i>
                                                    </a>
                                                    <a href="<?php echo URLROOT ?>/pages/cart" prodId='<?= $result->productId ?>' class="addCart btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                                    <a href="javascript:void(0);" class="btn-quickview product-detail-div" title="Quick View" data-description="<?= $result->description ?>" ><i class="fas fa-external-link-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Structure -->
        <div id="productModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p id="modalDescription"></p>
            </div>
        </div>


    </main>

<?php include ('includes/webfooter.php') ?>   

<script>
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
