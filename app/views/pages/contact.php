<?php include ('includes/webheader.php') ?>

<main class="main">
			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="demo4.html"><i class="icon-home"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Contact Us
						</li>
					</ol>
				</div>
			</nav>


            <iframe
                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1984.9985287419233!2d-0.36663346167788974!3d5.7135586674538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNcKwNDInNDguOCJOIDDCsDIxJzU1LjMiVw!5e0!3m2!1sen!2sgh!4v1736299755390!5m2!1sen!2sgh&maptype=satellite" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>


                <div class="container contact-us-container mt-5">
                    <div class="contact-info mb-5">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="ls-n-25 m-b-1">
                                    We'd Love to Hear From You
                                </h2>

                                <p>
                                    Please don't hesitate to reach out to us through the form below, or use the contact details provided.
                                </p>
                            </div>
   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">

                            <form class="mb-0" action="#">
                                <div class="form-group">
                                    <label class="mb-1" for="contactName">Your Name
                                        <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="contactName" required="">
                                </div>

                                <div class="form-group">
                                    <label class="mb-1" for="contactEmail">Your E-mail
                                        <span class="required">*</span></label>
                                    <input type="email" class="form-control" id="contactEmail" required="">
                                </div>

                                <div class="form-group">
                                    <label class="mb-1" for="contactMessage">Your Message
                                        <span class="required">*</span></label>
                                    <textarea cols="30" rows="1" id="contactMessage" class="form-control" required=""></textarea>
                                </div>

                                <div class="form-footer mb-0">
                                    <button type="button" class="btn btn-dark font-weight-normal" id="saveContact">
                                        Send Message
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">   

                                <div class="col-sm-6 col-lg-6">
                                    <div class="feature-box text-center">
                                        <i class="sicon-location-pin"></i>
                                        <div class="feature-box-content">
                                            <!-- <h3>Address</h3> -->
                                            <h5><?= Tools::companyLocation ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="feature-box text-center">
                                        <i class="fa fa-mobile-alt"></i>
                                        <div class="feature-box-content">
                                            <h3>Phone Number</h3>
                                            <h5><?= Tools::companyTelephone ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="feature-box text-center">
                                        <i class="far fa-envelope"></i>
                                        <div class="feature-box-content">
                                            <h3>E-mail Address</h3>
                                            <h5><?= Tools::companyEmail ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="feature-box text-center">
                                        <i class="far fa-calendar-alt"></i>
                                        <div class="feature-box-content">
                                            <h3>Working Days/Hours</h3>
                                            <h5>Mon - Sat / 9:00AM - 5:00PM</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>

			<div class="mb-8"></div>
		</main>

<?php include ('includes/webfooter.php') ?>   