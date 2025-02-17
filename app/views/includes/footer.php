<?php echo $userId = $_SESSION['uid'];?>

<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
							
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted font-weight-bold mr-2">&copy; <?= date ('Y'); ?></span>
								<a href="#" target="_blank" class="text-dark-75 text-hover-primary"><?= Tools::companyName ?></a>
							</div>
							<div class="nav nav-dark order-1 order-md-2">
								<a href="#" target="_blank" class="nav-link pr-3 pl-0">Developer</a>
								<a href="#" target="_blank" class="nav-link px-3">Team</a>
								<a href="#" target="_blank" class="nav-link pl-3 pr-0">Contact</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">USER PROFILE</h3>
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<div class="offcanvas-content pr-5 mr-n5">
				
				<div class="d-flex align-items-center mt-5">
					<div class="d-flex flex-column">
						<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= Tools::fullName($userId); ?></a>
						
						<div class="navi mt-2">
							<a href="#" class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-icon mr-1">
										<span class="svg-icon svg-icon-lg svg-icon-primary">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
													<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
												</g>
											</svg>
										</span>
									</span>
									<span class="navi-text text-muted text-hover-primary"><?= Tools::userEmail($userId); ?></span>
								</span>
							</a>
						</div>
						<div class="text-muted mt-1"><?= Tools::jobTitle($userId); ?></div>
						<div class="text-muted mt-1"><?= Tools::userTelephone($userId); ?></div>
					</div>
				</div>
				
				<div class="separator separator-dashed my-7"></div>
				
				<div>
					<a href="<?=URLROOT?>/auth/login" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
						
				</div>
			</div>
		</div>
	
		
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
			</span>
		</div>
		<ul class="sticky-toolbar nav flex-column pl-2 pr-2 pt-3 pb-3 mt-4">
			
			<li class="nav-item" id="kt_sticky_toolbar_chat_toggler" data-toggle="tooltip" title="Add User" data-placement="left">
				<a class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger" href="<?php echo URLROOT ?>/users/index">
					<i class="flaticon2-user-1"></i>
				</a>
			</li>
		</ul>

		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<script src="<?php echo URLROOT ?>/public/assets/plugins/global/plugins.bundle1ff3.js?v=7.1.2"></script>
		<script src="<?php echo URLROOT ?>/public/assets/plugins/custom/prismjs/prismjs.bundle1ff3.js?v=7.1.2"></script>
		<script src="<?php echo URLROOT ?>/public/assets/js/scripts.bundle1ff3.js?v=7.1.2"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="<?php echo URLROOT ?>/public/assets/plugins/custom/fullcalendar/fullcalendar.bundle1ff3.js?v=7.1.2"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?php echo URLROOT ?>/public/assets/js/pages/widgets1ff3.js?v=7.1.2"></script>
		<script src="<?php echo URLROOT ?>/public/assets/js/pages/features/miscellaneous/session-timeout1ff3.js?v=7.1.2"></script>
		<script src="<?php echo URLROOT ?>/public/assets/plugins/custom/datatables/datatables.bundle1ff3.js?v=7.1.2"></script>
		<script src="<?php echo URLROOT ?>/public/assets/js/pages/crud/datatables/extensions/buttons1ff3.js?v=7.1.2"></script>
		<script src="<?php echo URLROOT ?>/public/assets/js/pages/custom/notify.js"></script>
		<script src="<?php echo URLROOT ?>/public/assets/jquery-confirm/js/jquery-confirm.js"></script>
		<script src="<?php echo URLROOT ?>/public/assets/js/flatpickr.js"></script>
		<script src="<?php echo URLROOT ?>/public/assets/js/pages/crud/forms/widgets/typeahead1ff3.js?v=7.1.2"></script>
		<script src="<?php echo URLROOT ?>/public/assets/js/print.js" integrity="sha512-/fgTphwXa3lqAhN+I8gG8AvuaTErm1YxpUjbdCvwfTMyv8UZnFyId7ft5736xQ6CyQN4Nzr21lBuWWA9RTCXCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="<?php echo URLROOT ?>/pages-js/custom.js"></script>
		<script src="<?php echo URLROOT ?>/public/assets/uploadifive/jquery.uploadifive.min.js"></script>
		<script src="<?php echo URLROOT ?>/public/assets/js/pages/custom/ecommerce/checkout1ff3.js"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->

	<script>
		 window.addEventListener('load', function() {
            var preloader = document.getElementById('preloader');
            preloader.style.display = 'none';
        });

	</script>

</html>