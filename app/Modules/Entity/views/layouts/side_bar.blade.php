	<!-- Main sidebar -->
		<div class="sidebar sidebar-light sidebar-main sidebar-fixed sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="{{asset('images/placeholders/placeholder.jpg')}}" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">{{\Auth::guard('entity')->user()->first_name}} </div>

							</div>


						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->

						<li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-home4"></i>
								<span>Dashboard</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.entityInfo')}}" class="nav-link">
								<i class="icon-home2"></i>
								<span>Entity Info</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.entity_settings')}}" class="nav-link">
								<i class="icon-office"></i>
								<span>Settings</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-stack2"></i>
								<span>Table Booking</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-stack2"></i>
								<span>Order Status</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('entity.productcategory')}}" class="nav-link">
								<i class="icon-stack2"></i>
								<span>Products Category</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.fooditems')}}" class="nav-link">
								<i class="icon-magazine"></i>
								<span>Product Items</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.addonscategory')}}" class="nav-link">
								<i class="icon-package"></i>
								<span>Add Ons Category</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.addons')}}" class="nav-link">
								<i class="icon-stack4"></i>
								<span>Add On Items</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('entity.evouchers')}}" class="nav-link">
								<i class="icon-stack4"></i>
								<span>E-Vouchers</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-stack2"></i>
								<span>Product Reference</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-file-stats2"></i>
								<span>Delivery Charges Rate</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-cog"></i>
								<span>Minimum Order Table</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-magic-wand"></i>
								<span>Offers</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-map"></i>
								<span>Gallary Settings</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-file-spreadsheet"></i>
								<span>Voucher</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-file-text2"></i>
								<span>Customer Reviews</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-cash3"></i>
								<span>Social Settings</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-stars"></i>
								<span>Alert Notifications</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('entity.dashboard')}}" class="nav-link">
								<i class="icon-address-book"></i>
								<span>Users</span>
							</a>
						</li>




					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->

		</div>
		<!-- /main sidebar -->
