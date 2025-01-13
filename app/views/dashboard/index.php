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
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($unitsSold); ?></div>
														<div class="font-size-sm text-muted">Units Sold</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars(Tools::getProductName($topSelling)); ?></div>
														<div class="font-size-sm text-muted">Top-Selling Product</div>
													</div>
												</div>
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
											<span class="d-block text-dark font-weight-bolder">Inventory Metrics</span>
										</h3>
									</div>
				
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-12 d-flex flex-column">
											<div class="bg-light-warning p-8 rounded-xl flex-grow-1">
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($stockLevel); ?></div>
														<div class="font-size-sm text-muted">Stock Levels</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($lowStockLevel); ?></div>
														<div class="font-size-sm text-muted">Low Stock Alerts</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold">0%</div>
														<div class="font-size-sm text-muted">Stock Turnover Rate</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold"><?= htmlspecialchars($removedStock); ?></div>
														<div class="font-size-sm text-muted">Transferred/Removed Stock</div>
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
											<span class="d-block text-dark font-weight-bolder">Financial Metrics</span>
										</h3>
									</div>
				
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-12 d-flex flex-column">
											<div class="bg-light-warning p-8 rounded-xl flex-grow-1">
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold">D<!-- <?= htmlspecialchars($countAccount); ?> --></div>
														<div class="font-size-sm text-muted">Profit Margins</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold">D<!-- <?= htmlspecialchars($countPayments); ?> --></div>
														<div class="font-size-sm text-muted">Pending Payments</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold">D<!-- <?= htmlspecialchars($countOpened); ?> --></div>
														<div class="font-size-sm text-muted">Expenditures</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold">D</div>
														<div class="font-size-sm text-muted">Outstanding Invoices</div>
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
														<div class="font-size-sm font-weight-bold">D<!-- <?= htmlspecialchars($countAccount); ?> --></div>
														<div class="font-size-sm text-muted">Total Orders</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold">D<!-- <?= htmlspecialchars($countPayments); ?> --></div>
														<div class="font-size-sm text-muted">Order Fulfillment Time</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold">D<!-- <?= htmlspecialchars($countOpened); ?> --></div>
														<div class="font-size-sm text-muted">Order Value</div>
													</div>
												</div>
												<div class="d-flex align-items-center mb-5">
													<div>
														<div class="font-size-sm font-weight-bold">D</div>
														<div class="font-size-sm text-muted">Delivery Status</div>
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