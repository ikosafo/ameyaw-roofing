<?php include ('includes/webheader.php') ?>

<main class="main">
	<section class="intro-section" style="margin-bottom: -5.5px;">
		<div class="container">
			<div class="home-slider slide-animate owl-carousel owl-theme owl-carousel-lazy">
				<div class="home-slide home-slide-1 banner d-flex flex-wrap">
					<div class="col-lg-4 d-flex justify-content-center">
						<div class="d-flex flex-column justify-content-center appear-animate"
							data-animation-name="fadeInLeftShorter" data-animation-delay="200">
							<h4 class="text-light text-uppercase m-b-1">Affordable</h4>
							<h2 class="text-uppercase m-b-1">Roofing</h2>
							<h4 class="font-weight-bold text-uppercase heading-border m-b-3">SHEETS</h4>
							<h3 class="font5 m-b-5">Top Materials</h3>

							<div>
								<a href="<?php echo URLROOT ?>/pages/shop" class="btn btn-dark btn-lg">Buy Now!</a>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="appear-animate d-flex align-items-center justify-content-center" 
								data-animation-name="fadeInLeftShorter" 
								data-animation-delay="100">
								<img class="m-b-5 img-gradient" 
									src="<?php echo URLROOT ?>/public/webassets/images/custom/01.png" 
									alt="roofing sheet" />
						</div>

					</div>
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
						<h4 class="text-white">Reliable Delivery Services</h4>
					</div>
				</div>

				<div class="info-box info-box-icon-left">
					<i class="icon-money text-white"></i>

					<div class="info-box-content">
						<h4 class="text-white">Quality Assurance</h4>
					</div>
				</div>

				<div class="info-box info-box-icon-left">
					<i class="icon-support text-white"></i>

					<div class="info-box-content">
						<h4 class="text-white">Expert Support</h4>
					</div>
				</div>
			</div>
		</div>
	</section>


	<div class="banners-section" style="margin-bottom: -5.5px;">
		<div class="row row-sm">
			<div class="col-md-4">
				<div class="banner banner1 appear-animate" data-animation-name="fadeIn"
					data-animation-delay="200" style="background-color: #696f6f;">
					<figure>
						<img src="<?php echo URLROOT ?>/public/webassets/images/custom/02.png" alt="banner" width="640"
							height="640">
					</figure>
				</div>
			</div>
			<div class="col-md-8">
				<div class="about-section">
					<div class="container mt-2">
						<h2 class="subtitle">WHO WE ARE</h2>
						<p>At <?= Tools::companyName ?> company, we are dedicated to providing top-quality roofing solutions that stand the test of time. Our journey began with a simple mission:
						 to deliver exceptional roofing products and services to our community. Over the years, we have grown into a trusted name in the industry, known for our commitment to quality and customer satisfaction</p>
						<p>Our mission is to provide durable, high-quality roofing solutions that meet the unique needs of each client. We believe in combining top-grade materials with expert craftsmanship to ensure every project is completed to the highest standards.</p>
						
						<a href="<?php echo URLROOT ?>/pages/about"><div class="btn btn-lg btn-primary mt-2 mb-2">Read More</div></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="features-section bg-gray">
		<div class="container">
			<h2 class="subtitle">WHY CHOOSE US</h2>
			<div class="row">
				<div class="col-lg-4">
					<div class="feature-box bg-white">
						<i class="icon-shipped"></i>

						<div class="feature-box-content p-0">
							<h3>Fast and Reliable Delivery</h3>
							<p>Experience prompt delivery of roofing sheets exactly when and where you need them.</p>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="feature-box bg-white">
						<i class="icon-us-dollar"></i>

						<div class="feature-box-content p-0">
							<h3>Affordable Pricing</h3>
							<p>Our competitive prices make premium roofing solutions accessible without compromising on quality.</p>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="feature-box bg-white">
						<i class="icon-online-support"></i>

						<div class="feature-box-content p-0">
							<h3>Expert Guidance</h3>
							<p>Our knowledgeable team is here to help you choose the right roofing solution tailored to your needs.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
</main>

<?php include ('includes/webfooter.php') ?>   