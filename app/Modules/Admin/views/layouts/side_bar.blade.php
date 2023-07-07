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
								<div class="media-title font-weight-semibold">{{\Auth::guard('admin')->user()->first_name}} {{\Auth::guard('admin')->user()->last_name}}</div>

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
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-home4"></i>
								<span>Dashboard</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.categories')}}" class="nav-link">
								<i class="icon-home2"></i>
								<span>Categories</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.entities')}}" class="nav-link">
								<i class="icon-office"></i>
								<span>Entities</span>
							</a>
						</li>

                        <li class="nav-item">
							<a href="{{route('admin.sponsored')}}" class="nav-link">
								<i class="icon-magazine"></i>
								<span>Sponsored</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-package"></i>
								<span>Packages</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.cuisines')}}" class="nav-link">
								<i class="icon-stack4"></i>
								<span>Cuisine</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-stack2"></i>
								<span>Dishes</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.orderstatus')}}" class="nav-link">
								<i class="icon-file-stats2"></i>
								<span>Order Status</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('admin.orders')}}" class="nav-link">
								<i class="icon-stack4"></i>
								<span>Order Management</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('admin.customers')}}" class="nav-link">
								<i class="icon-stack4"></i>
								<span>Customer Management</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('admin.affiliates')}}" class="nav-link">
								<i class="icon-office"></i>
								<span>Affiliate Management</span>
							</a>
						</li>
                        <!-- <li class="nav-item">
                            <a href="{{route('admin.entity_settings')}}" class="nav-link">
                                <i class="icon-cog"></i>
                                <span>Entities Settings</span>
                            </a>
                        </li> -->

                        <li class="nav-item">
							<a href="{{route('admin.settings')}}" class="nav-link">
								<i class="icon-cog"></i>
								<span>Settings</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-magic-wand"></i>
								<span>Theme Settings</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.area_management')}}" class="nav-link">
								<i class="icon-map"></i>
								<span>Manage Location</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-file-spreadsheet"></i>
								<span>Voucher</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-file-text2"></i>
								<span>Invoice</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-cash3"></i>
								<span>Merchant Commission</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-stars"></i>
								<span>Ratings</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-address-book"></i>
								<span>Contact Settings</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-facebook2"></i>
								<span>Social Settings</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-coins"></i>
								<span>Manage Currency</span>
							</a>
						</li>
                         <li class="nav-item">
							<a href="{{route('admin.dashboard')}}" class="nav-link">
								<i class="icon-flag3"></i>
								<span>Manage Language</span>
							</a>
						</li>




					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->

		</div>
		<!-- /main sidebar -->
