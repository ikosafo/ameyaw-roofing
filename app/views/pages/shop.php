<?php include ('includes/webheader.php');
extract($data);
?>

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
                    <h2 class="section-title appear-animate animated fadeInUpShorter appear-animation-visible" data-animation-name="fadeInUpShorter" data-animation-delay="200" style="animation-duration: 1000ms;">Sample products</h2>

                    <div class="row appear-animate animated fadeInUpShorter appear-animation-visible" data-animation-name="fadeInUpShorter" data-animation-delay="200" style="animation-duration: 1000ms;">
                        <div class="products-slider 5col owl-carousel owl-theme owl-loaded owl-drag" data-owl-options="{
                            'margin': 0
                        }">
                            
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 1147px;">
                            
                                <?php  foreach ($listWebsiteProducts as $result) { ?>
                                    <div class="owl-item active" style="width: 229.278px;">
                                        <div class="product-default">
                                        <figure>
                                            <a href="<?php echo URLROOT ?>/pages/productDetail">
                                                <img src="<?= Tools::websiteProductImages($result->uuid) ?>"
                                                style="width:400px; height:200px"
                                                width="280" height="280" alt="product">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-list">
                                                <a href="javascript:void(0);" class="product-category"><?= Tools::getProductCategoryName($result->categoryId) ?></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="<?php echo URLROOT ?>/pages/productDetail"><?= $result->productName ?></a>
                                            </h3>
                                            <div class="price-box">
                                                <span class="old-price">GHC <?= number_format($result->unitPrice * 1.2,2) ?></span> <br>
                                                <span class="product-price">GHC <?= number_format($result->unitPrice,2) ?></span>
                                            </div>
                                            <div class="product-action">
                                                <a href="<?php echo URLROOT ?>/pages/wishlist" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                                <a href="<?php echo URLROOT ?>/pages/cart"  prodId='<?= $result->productId ?>' class="addCart btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                                <a href="<?php echo URLROOT ?>/ajax/product" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                <?php } ?>
                              
                            </div>
                        </div>
                    <div class="owl-nav disabled">
                        <button type="button" title="nav" role="presentation" class="owl-prev">
                            <i class="icon-angle-left"></i>
                        </button>
                        <button type="button" title="nav" role="presentation" class="owl-next">
                            <i class="icon-angle-right"></i>
                        </button>
                    </div>
                    <div class="owl-dots disabled"></div></div>
                    </div>                  
                </div>
            </section>

    </main>

<?php include ('includes/webfooter.php') ?>   