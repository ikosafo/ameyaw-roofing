<?php include ('includes/header.php');
extract($data);
?>

	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
			<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
				<div class="d-flex align-items-center flex-wrap mr-1">
					<div class="d-flex flex-column">
						<h2 class="text-white font-weight-bold my-2 mr-5">Dashboard</h2>
					</div>
				</div>
				
			</div>
		</div>

		<div class="d-flex flex-column-fluid">
			<div class="container">

					<div class="row">
						<div class="col-xl-3">
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-header h-auto border-0">
									<div class="card-title py-5">
										<h3 class="card-label">
											<span class="d-block text-dark font-weight-bolder">Sales Metrics</span>
										</h3>
									</div>
				
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-12 d-flex flex-column">
											<div class="bg-light-warning p-8 rounded-xl flex-grow-1">
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars(number_format($salesRevenue,2)); ?></div>
														<div class="font-size-sm text-muted">Total Sales Revenue</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($unitsSold ?? ''); ?></div>
														<div class="font-size-sm text-muted">Units Sold</div>
													</div>
												</div>
												<!-- <div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars(Tools::getProductName($topSelling)); ?></div>
														<div class="font-size-sm text-muted">Top-Selling Product</div>
													</div>
												</div> -->
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars(number_format($currentGrowthRate, 2)).'%' ?>
                                                        </div>
														<div class="font-size-sm text-muted">Sales Growth Rate</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Charts Widget 6-->
						</div>
                        <div class="col-xl-3">
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-header h-auto border-0">
									<div class="card-title py-5">
										<h3 class="card-label">
											<span class="d-block text-dark font-weight-bolder">Product Metrics</span>
										</h3>
									</div>
				
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-12 d-flex flex-column">
											<div class="bg-light-warning p-8 rounded-xl flex-grow-1">
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($productNumber ?? ''); ?></div>
														<div class="font-size-sm text-muted">Products</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($categoryNumber ?? ''); ?></div>
														<div class="font-size-sm text-muted">Categories</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($materialNumber ?? ''); ?></div>
														<div class="font-size-sm text-muted">Material Types</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Charts Widget 6-->
						</div>

						<div class="col-xl-3">
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-header h-auto border-0">
									<div class="card-title py-5">
										<h3 class="card-label">
											<span class="d-block text-dark font-weight-bolder">Order Metrics</span>
										</h3>
									</div>
				
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-12 d-flex flex-column">
											<div class="bg-light-warning p-8 rounded-xl flex-grow-1">
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($totalOrders ?? ''); ?></div>
														<div class="font-size-sm text-muted">Total Inspections</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($totalInvoices ?? ''); ?></div>
														<div class="font-size-sm text-muted">Total Invoicing</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($totalSales ?? ''); ?></div>
														<div class="font-size-sm text-muted">Total Sales</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Charts Widget 6-->
						</div>
						
                        <div class="col-xl-3">
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-header h-auto border-0">
									<div class="card-title py-5">
										<h3 class="card-label">
											<span class="d-block text-dark font-weight-bolder">User Metrics</span>
										</h3>
									</div>
				
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-12 d-flex flex-column">
											<div class="bg-light-warning p-8 rounded-xl flex-grow-1">
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($totalUsers ?? ''); ?></div>
														<div class="font-size-sm text-muted">Users</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($totalAdministrators ?? ''); ?></div>
														<div class="font-size-sm text-muted">Administrators</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($getLastLogin ?? '') ?></div>
														<div class="font-size-sm text-muted">Last Login</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Charts Widget 6-->
						</div>
                        
						
					</div>

				
				<!--end::Dashboard-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Entry-->
	</div>
	<!--end::Content-->

<?php include ('includes/footer.php'); ?>