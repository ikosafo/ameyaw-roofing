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
		<title>Admin Portal | <?= Tools::companyName ?></title>
		<meta name="description" content="<?= Tools::companyName ?> Admin Portal" />
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
		<link href="<?php echo Tools::companyLogo() ?>" rel="shortcut icon" />
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
	

	<body id="kt_body" style="background-image: linear-gradient(rgba(77, 14, 177, 0.8), rgba(14, 2, 43, 0.8)), 
    url('<?php echo URLROOT ?>/public/assets/media/bg/r1.jpg')" 
	class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">


	<div id="preloader"></div>
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile">
			<!--begin::Logo-->
			<a href="<?php echo URLROOT ?>/pages/index">
				<img alt="Logo" src="<?php echo Tools::companyLogo() ?>" style="width:100px;height:80px"
                class="logo-default" />
			</a>
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<button class="btn btn-icon btn-hover-transparent-white p-0 ml-3" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
					</span>
				</button>
			</div>
		</div>
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-row flex-column-fluid page">
				
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<div id="kt_header" class="header header-fixed">
						<div class="container d-flex align-items-stretch justify-content-between">
							<div class="d-flex align-items-stretch mr-3">
								<div class="header-logo">
									<a href="<?php echo URLROOT ?>/pages/index">
										<img alt="Logo" src="<?php echo Tools::companyLogo() ?>"  style="width:95px;height:100px" class="logo-default" />
										<img alt="Logo" src="<?php echo Tools::companyLogo() ?>"  style="width:80px;height:60px" class="logo-sticky" />
									</a>
								</div>
								<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
									<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
									<ul class="menu-nav">
										<!-- Dashboard -->
										<li class="menu-item <?php echo ($currentPath == '//pages/index' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
											<a href="<?php echo URLROOT ?>/pages/index" class="menu-link">
												<span class="menu-text">Dashboard</span>
											</a>
										</li>
										
										<!-- Products -->
										<li class="menu-item menu-item-submenu menu-item-rel 
										<?php echo ($currentPath == '//products/add' || $currentPath == '//products/list'
										 || $currentPath == '//products/categories' || $currentPath == '//products/materialTypes'
										 ? 'menu-item-here' : ''); ?>" data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Products <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item <?php echo ($currentPath == '//products/add' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/products/add" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Add New Product</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '//products/list' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/products/list" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">List Products</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '//products/categories' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/products/categories" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Categories Management</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '//products/materialTypes' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/products/materialTypes" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Material Types</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<!-- Inventory -->
										<!-- <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
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
												</ul>
											</div>
										</li> -->


										<!-- Website -->
										<li class="menu-item menu-item-submenu menu-item-rel 
											<?php echo ($currentPath == '//products/websiteProducts' || $currentPath == '//web/contacts'
											 || $currentPath == '//web/support' || $currentPath == '//web/contactForm' ? 'menu-item-here' : ''); ?>" 
											data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Websites <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item <?php echo ($currentPath == '//web/contacts' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/web/contacts" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Contacts & Address</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '//web/support' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/web/support" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Support Center</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '//web/contactForm' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/web/contactForm" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Contact Us Form</span>
														</a>
													</li>
													<!-- <li class="menu-item <?php echo ($currentPath == '//products/websiteProducts' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/products/websiteProducts" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Website Products</span>
														</a>
													</li> -->
												</ul>
											</div>
										</li>


										<!-- Orders -->
										<li class="menu-item menu-item-submenu menu-item-rel 
											<?php echo ($currentPath == '//orders/customers' || $currentPath == '//orders/sales' || $currentPath == '//orders/list' || 
														$currentPath == '//orders/status' || $currentPath == '//orders/invoice' || 
														$currentPath == '//orders/customer' ? 'menu-item-here' : ''); ?>" 
											data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Orders <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item <?php echo ($currentPath == '//orders/customers' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/customers" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Customers</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '//orders/invoice' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/invoice" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">New Order</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '//orders/sales' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/sales" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Sales</span>
														</a>
													</li>
													<!-- <li class="menu-item <?php echo ($currentPath == '//orders/create' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/create" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Create New Order</span>
														</a>
													</li> -->
													<!-- <li class="menu-item <?php echo ($currentPath == '//orders/list' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/list" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Order History</span>
														</a>
													</li> -->
													<li class="menu-item <?php echo ($currentPath == '//orders/status' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/status" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Order Status</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '//orders/customer' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/orders/customer" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Customer Orders History</span>
														</a>
													</li>
												</ul>
											</div>
										</li>



										<!-- <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
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
										</li> -->


										<!-- Payments -->
										<li class="menu-item menu-item-submenu menu-item-rel 
											<?php echo ($currentPath == '//payments/process' || $currentPath == '//payments/history' ? 'menu-item-here' : ''); ?>" 
											data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Payments <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item <?php echo ($currentPath == '//payments/process' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/payments/process" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Process Payments</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '//payments/history' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/payments/history" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">View Payment History</span>
														</a>
													</li>
													<!-- Uncomment if needed -->
													<!-- <li class="menu-item <?php echo ($currentPath == '//payments/pending' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/payments/pending" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Pending Payments</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '//payments/refunds' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/payments/refunds" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Refunds Management</span>
														</a>
													</li> -->
												</ul>
											</div>
										</li>


										<!-- Reports -->
										<li class="menu-item menu-item-submenu menu-item-rel 
											<?php echo (strpos($currentPath, '/reports/') !== false ? 'menu-item-here' : ''); ?>" 
											data-menu-toggle="hover" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Reports <i class="menu-arrow"></i></span>
												<span class="menu-desc"></span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item <?php echo ($currentPath == '/reports/sales' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/reports/sales" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Sales Report</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '/reports/inventory' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/reports/inventory" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Inventory Report</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '/reports/customers' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/reports/customers" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Customer Report</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '/reports/suppliers' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/reports/suppliers" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Supplier Report</span>
														</a>
													</li>
													<li class="menu-item <?php echo ($currentPath == '/reports/payments' ? 'menu-item-here' : ''); ?>" aria-haspopup="true">
														<a href="<?php echo URLROOT ?>/reports/payments" class="menu-link">
															<i class="menu-bullet menu-bullet-dot"><span></span></i>
															<span class="menu-text">Payment Report</span>
														</a>
													</li>
												</ul>
											</div>
										</li>


									</ul>

									</div>
								</div>
							</div>
							<!--begin::Topbar-->
							<div class="topbar">
								
								<!--begin::Quick Actions-->
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1">
											<span class="svg-icon svg-icon-xl">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
														<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
														<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
														<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
													</g>
												</svg>
											</span>
										</div>
									</div>
									<!--end::Toggle-->
									<!--begin::Dropdown-->
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
										<!--begin:Header-->
										<div class="d-flex flex-column flex-center py-10 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(<?php echo URLROOT ?>/public/assets/media/bg/roofing.jpg)">
											<h4 class="text-white font-weight-bold">Quick Actions</h4>
										</div>
										<!--end:Header-->
										<!--begin:Nav-->
										<div class="row row-paddingless">
										
											
											<!--begin:Item-->
											<div class="col-6">
												<a href="<?php echo URLROOT ?>/accounts/accountmanagement" class="d-block py-10 px-5 text-center bg-hover-light border-right">
													<span class="svg-icon svg-icon-3x svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
																<path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
															</g>
														</svg>
													</span>
													<span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Account Management</span>
												</a>
											</div>
											<!--end:Item-->
											<!--begin:Item-->
											<div class="col-6">
												<a href="<?php echo URLROOT ?>/users/index" class="d-block py-10 px-5 text-center bg-hover-light">
													<span class="svg-icon svg-icon-3x svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
															</g>
														</svg>
													</span>
													<span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">User Management</span>
												</a>
											</div>
											<!--end:Item-->
										</div>
										<!--end:Nav-->
									</div>
									<!--end::Dropdown-->
								</div>
								<!--end::Quick Actions-->
								
								<!--begin::User-->
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item">
										<div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
											<span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
											<span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4"><?= ucwords($_SESSION['username']) ?></span>
											<span class="symbol symbol-35">
												<span class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30"><?= strtoupper(substr($_SESSION['username'], 0, 1)) ?></span>
											</span>
										</div>
									</div>
									<!--end::Toggle-->
								</div>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						</div>
					</div>

					<!--end::Header-->