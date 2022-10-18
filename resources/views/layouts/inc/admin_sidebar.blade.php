<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Statistics</div>
                            <a class="nav-link {{ Request::is('admin/dashboard') ? 'active':''}}" href="{{url('admin/dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-line-chart"></i></div>
                                Dashboard
                            </a>

                            <div class="sb-sidenav-menu-heading">Account</div>
                            <a class="nav-link {{ Request::is('admin/account') ? 'active':''}}" href="{{url('admin/account')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-cogs"></i></div>
                                Account Information
                            </a>
                            <a class="nav-link {{ Request::is('admin/consumer_list') ? 'active':''}}" href="{{url('admin/consumer_list')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-address-book"></i></div>
                                Customer List
                            </a>
                            <a class="nav-link {{ Request::is('admin/product') ? 'active':''}}" href="{{url('/admin/product')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-database"></i></div>
                                Stock Product List
                            </a>

                            <div class="sb-sidenav-menu-heading">Facebook</div>
                            <a class="nav-link {{ Request::is('admin/facebook/post') ? 'active':''}}" href="{{url('/admin/facebook/post')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-list" aria-hidden="true"></i></div>
                                Facebook Post List
                            </a>

                            <div class="sb-sidenav-menu-heading">Live Sales</div>
                            <a class="nav-link {{ Request::is('admin/live/setup') ? 'active':''}}" href="{{url('/admin/live/setup')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-podcast"></i></div>
                                Live Setting
                            </a>
                            <a class="nav-link {{ Request::is('admin/live') ? 'active':''}}" href="{{url('/admin/live')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-cubes"></i></div>
                                Live Session List
                            </a>
                            <a class="nav-link {{ Request::is('admin/live/product/list_bid') ? 'active':''}}" href="{{url('/admin/live/product/list_bid')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-link"></i></div>
                                List of bid
                            </a>

                            <div class="sb-sidenav-menu-heading">Sales Order</div>
                            <a class="nav-link {{ Request::is('admin/sales/list') ? 'active':''}}" href="{{url('/admin/sales/list')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-cart-plus"></i></div>
                                Sales Order List
                            </a>
                            <a class="nav-link {{ Request::is('admin/order/list') ? 'active':''}}" href="{{url('/admin/order/list')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-cart-arrow-down"></i></div>
                                Order List
                            </a>
                            <a class="nav-link {{ Request::is('admin/order/shipping') ? 'active':''}}" href="{{url('/admin/order/shipping')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-truck"></i></div>
                                Order Shipping
                            </a>
                        </div>
                    </div>
                </nav>
            </div>