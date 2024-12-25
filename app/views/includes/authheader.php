<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="UTF-8">
		<title>Login | Allied Health Professions Council</title>
		<meta name="description" content="Allied Health Professions Council, Login">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/css/font.css">
		<link href="<?php echo URLROOT ?>/public/assets/css/pages/login/classic/login-11ff3.css?v=7.1.2" rel="stylesheet" type="text/css">
		<link href="<?php echo URLROOT ?>/public/assets/plugins/global/plugins.bundle1ff3.css?v=7.1.2" rel="stylesheet" type="text/css">
		<link href="<?php echo URLROOT ?>/public/assets/plugins/custom/prismjs/prismjs.bundle1ff3.css?v=7.1.2" rel="stylesheet" type="text/css">
		<link href="<?php echo URLROOT ?>/public/assets/css/style.bundle1ff3.css?v=7.1.2" rel="stylesheet" type="text/css">
		<link rel="shortcut icon" href="<?php echo URLROOT ?>/public/assets/media/logos/logo.png">
		<script src="<?php echo URLROOT ?>/public/assets/js/general.js"></script>
		<script src="<?php echo URLROOT ?>/public/assets/js/scriptfunctions.js"></script>

		<script>
			 /*  var cvhead = {
					<?php
					/*
					* PHP 7 throws warnings about non-scalar values in constants...
					* serialized JSVARS to compensate.
					*/
					foreach (unserialize(JSVARS) as $jskey => $jsval) {
						echo $jskey . " : '" . $jsval . "',";
					}
					?>
				} */

    		//const urlroot = cvhead.urlroot;

			var cvhead = <?php echo json_encode(unserialize(JSVARS)); ?>;
			const urlroot = cvhead.urlroot;
		</script>
	</head>
	
	<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
		
		<div class="d-flex flex-column flex-root">
		
			<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
			
				<div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10" style="background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), 
    url('<?php echo URLROOT ?>/public/assets/media/bg/roofing.jpg')">
					<div class="d-flex flex-row-fluid flex-column justify-content-between">

                        <div style="text-align: center;">
                            <a href="#" 
                            class="flex-column-auto mt-5 pb-lg-0 pb-10" 
                            style="background-color: white; border-radius: 15px; padding: 10px; display: inline-block;">
                                <img src="<?php echo URLROOT ?>/public/assets/media/logos/logo.png" class="max-h-70px" alt="" />
                            </a>
                        </div>
					
						<div class="flex-column-fluid d-flex flex-column justify-content-center">
							<h3 class="font-size-h1 mb-5 text-white">Administrative Portal</h3>
							<p class="font-weight-lighter text-white opacity-80">Please log in to access your portal.</p>
						</div>
		
						<div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
							<div class="opacity-70 font-weight-bold text-white">&copy; <?php echo date('Y'); ?> R. K. AMEYAW ROOFING EXPERT</div>
						</div>
						
					</div>
					
				</div>
			