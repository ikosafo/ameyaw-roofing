<?php
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$currentPath = parse_url($currentUrl, PHP_URL_PATH);
/* $userId = Tools::getMISUserid($_SESSION['uid']);
$userPermissions = Tools::getUserPermissions($userId); */

?>
<!DOCTYPE html>

<html lang="en">
	
    <head>
		<meta charset="utf-8" />
		<title>MIS Admin Portal | Allied Health Professions Council</title>
		<meta name="description" content="Allied Health Professions Council Admin Portal" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/css/font.css" />
		<link href="<?php echo URLROOT ?>/public/assets/plugins/custom/fullcalendar/fullcalendar.bundle1ff3.css?v=7.1.2" rel="stylesheet" type="text/css" />
		<link href="<?php echo URLROOT ?>/public/assets/plugins/global/plugins.bundle1ff3.css?v=7.1.2" rel="stylesheet" type="text/css" />
		<link href="<?php echo URLROOT ?>/public/assets/plugins/custom/prismjs/prismjs.bundle1ff3.css?v=7.1.2" rel="stylesheet" type="text/css" />
		<link href="<?php echo URLROOT ?>/public/assets/css/pages/wizard/wizard-41ff3.css?v=7.1.2" rel="stylesheet" type="text/css" />
		<link href="<?php echo URLROOT ?>/public/assets/css/style.bundle1ff3.css?v=7.1.2" rel="stylesheet" type="text/css" />
        <link href="<?php echo URLROOT ?>/public/assets/css/customstyles.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo URLROOT ?>/public/assets/jquery-confirm/css/jquery-confirm.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo URLROOT ?>/public/assets/css/print.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo URLROOT ?>/public/assets/css/flatpickr.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo URLROOT ?>/public/assets/media/logos/logo.png" rel="shortcut icon" />
		<link href="<?php echo URLROOT ?>/public/assets/uploadifive/uploadifive.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo URLROOT ?>/public/assets/js/general.js"></script>
		<script src="<?php echo URLROOT ?>/public/assets/js/chart.js"></script>
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

		<!-- <script type="text/javascript">
			(function(c,l,a,r,i,t,y){
				c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
				t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
				y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
			})(window, document, "clarity", "script", "o5l6qb07xl");
		</script> -->


	</head>
	

	<body id="kt_body" style="background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), 
    url('<?php echo URLROOT ?>/public/assets/media/bg/roofing2.jpg')" 
	class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">


	<div id="preloader"></div>
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile">
			<!--begin::Logo-->
			<a href="<?php echo URLROOT ?>/pages/index">
				<img alt="Logo" src="<?php echo URLROOT ?>/public/assets/media/logos/logo.png" 
                class="logo-default max-h-30px headerLogo" />
			</a>
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<button class="btn btn-icon btn-hover-transparent-white p-0 ml-3" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header header-fixed">
						<div class="container d-flex align-items-stretch justify-content-between">
							<div class="d-flex align-items-stretch mr-3">
								<div class="header-logo">
									<a href="<?php echo URLROOT ?>/pages/index">
										<img alt="Logo" src="<?php echo URLROOT ?>/public/assets/media/logos/logo.png" class="logo-default max-h-20px headerLogo" />
										<img alt="Logo" src="<?php echo URLROOT ?>/public/assets/media/logos/logo.png" class="logo-sticky max-h-20px headerLogo" />
									</a>
								</div>
								<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
									<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
									<ul class="menu-nav">
										<!-- Dashboard -->
										<li class="menu-item" aria-haspopup="true">
											<a href="<?php echo URLROOT ?>/pages/index" class="menu-link">
												<span class="menu-text">Dashboard</span>
											</a>
										</li>
										
										<!-- Products -->
										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Products <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/products/add" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Add New Product</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/products/list" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">List Products</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/products/categories" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Categories Management</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<!-- Inventory -->
										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Inventory <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/inventory/manage" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Stock Management</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/inventory/lowStock" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Low Stock Notifications</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/inventory/restock" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Restock Items</span>
														</a>
													</li>
													<!-- <li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/inventory/history" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">View Inventory History</span>
														</a>
													</li> -->
												</ul>
											</div>
										</li>

										<!-- Orders -->
										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Orders <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/create" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Create New Order</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/list" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Order History</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/status" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Order Status</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/customer" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Customer Orders History</span>
														</a>
													</li>
												</ul>
											</div>
										</li>

										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Suppliers <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/suppliers/add" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Add New Supplier</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/suppliers/list" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">List Suppliers</span>
														</a>
													</li>
													
												</ul>
											</div>
										</li>

										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Payments <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/payments/process" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Process Payments</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/payments/history" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">View Payment History</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/payments/pending" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Pending Payments</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/payments/refunds" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Refunds Management</span>
														</a>
													</li>
												</ul>
											</div>
										</li>

										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Reports <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/reports/sales" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Sales Report</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/reports/inventory" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Inventory Report</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/reports/customers" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Customer Report</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/reports/suppliers" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Supplier Report</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/reports/payments" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Payment Report</span>
														</a>
													</li>
												</ul>
											</div>
										</li>


										<!-- Add more menus similarly -->
									</ul>

									</div>
								</div>
							</div>
							<div class="topbar">
								<div class="dropdown">
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-hover-transparent-white btn-lg btn-dropdown mr-1">
											<span class="svg-icon svg-icon-xl">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
														<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
													</g>
												</svg>
											</span>
										</div>
									</div>
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
										<div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
											<form method="get" class="quick-search-form">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<span class="svg-icon svg-icon-lg">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24" />
																		<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																	</g>
																</svg>
															</span>
														</span>
													</div>
													<input type="text" class="form-control" placeholder="Search..." />
													<div class="input-group-append">
														<span class="input-group-text">
															<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
														</span>
													</div>
												</div>
											</form>
											<div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!--end::Header-->