 <!-- ========== App Menu ========== -->
 <div class="app-menu navbar-menu">
     <!-- LOGO -->
     <div class="navbar-brand-box">
         <!-- Dark Logo-->
         <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
             <span class="logo-sm">
                 <img src="{{ asset('admin/assets') }}/images/logo-sm.png" alt="" height="25">
             </span>
             <span class="logo-lg">
                 <img src="{{ asset('assets/images/home/logo/logo.svg') }}" alt="" height="50">
             </span>
         </a>
         <!-- Light Logo-->
         <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
             <span class="logo-sm">
                 <img src="{{ asset('admin/assets') }}/images/logo-sm.png" alt="" height="25">
             </span>
             <span class="logo-lg">
                 <img src="{{ asset('assets/images/home/logo/logo.svg') }}" alt="" height="50">
             </span>
         </a>
         <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
             id="vertical-hover">
             <i class="ri-record-circle-line"></i>
         </button>
     </div>

     <div class="dropdown sidebar-user m-1 rounded">
         <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
             data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <span class="d-flex align-items-center gap-2">
                 <img class="rounded header-profile-user" src="{{ asset('admin/assets') }}/images/users/avatar-1.jpg"
                     alt="Header Avatar">
                 <span class="text-start">
                     <span class="d-block fw-medium sidebar-user-name-text">{{ auth()->user()->name }}</span>
                     <span class="d-block fs-14 sidebar-user-name-sub-text"><i
                             class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span
                             class="align-middle">Online</span></span>
                 </span>
             </span>
         </button>
         <div class="dropdown-menu dropdown-menu-end">
             <!-- item-->
             <h6 class="dropdown-header">Welcome {{ auth()->user()->name }}!</h6>
             <a class="dropdown-item" href="pages-profile.html"><i
                     class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                     class="align-middle">Profile</span></a>
             <a class="dropdown-item" href="apps-chat.html"><i
                     class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span
                     class="align-middle">Messages</span></a>
             <a class="dropdown-item" href="apps-tasks-kanban.html"><i
                     class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span
                     class="align-middle">Taskboard</span></a>
             <a class="dropdown-item" href="pages-faqs.html"><i
                     class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span
                     class="align-middle">Help</span></a>
             <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="pages-profile.html"><i
                     class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance :
                     <b>$5971.67</b></span></a>
             <a class="dropdown-item" href="pages-profile-settings.html"><span
                     class="badge bg-success-subtle text-success mt-1 float-end">New</span><i
                     class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                     class="align-middle">Settings</span></a>
             <a class="dropdown-item" href="auth-lockscreen-basic.html"><i
                     class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock
                     screen</span></a>
             <a class="dropdown-item" href="auth-logout-basic.html"><i
                     class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                     data-key="t-logout">Logout</span></a>
         </div>
     </div>
     <div id="scrollbar">
         <div class="container-fluid">


             <div id="two-column-menu">
             </div>
             <!-- resources/views/layouts/partials/sidebar.blade.php -->
             <ul class="navbar-nav" id="navbar-nav">
                 <!-- Dashboard -->
                 @hasRoutePermission('admin.dashboard')
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                             href="{{ route('admin.dashboard') }}">
                             <i class="ri-dashboard-line"></i> <span data-key="t-dashboards">Dashboard</span>
                         </a>
                     </li>
                 @endhasRoutePermission

                 <!-- Orders -->
                 @hasRoutePermission('admin.orders.list')
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.orders*', 'admin.order*') ? 'active' : '' }}"
                             href="{{ route('admin.orders.list') }}">
                             <i class="ri-shopping-bag-3-line"></i> <span data-key="t-widgets">Orders</span>
                         </a>
                     </li>
                 @endhasRoutePermission

                 <!-- Sales Report -->
                 @hasRoutePermission('admin.sales.report')
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.sales.report*') ? 'active' : '' }}"
                             href="{{ route('admin.sales.report') }}">
                             <i class="ri-pages-line"></i> <span data-key="t-widgets">Sales Report</span>
                         </a>
                     </li>
                 @endhasRoutePermission

                 <!-- Categories -->
                 @hasRoutePermission('admin.categories.list')
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('admin.categories*', 'admin.category*') ? 'active' : '' }}"
                            href="{{ route('admin.categories.list') }}">
                            <i class="ri-list-unordered"></i> <span data-key="t-widgets">Categories</span>
                        </a>
                    </li>
                 @endhasRoutePermission

                 <!-- Products -->
                 @hasRoutePermission('admin.products.list')
                     {{-- <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.products*', 'admin.product*') ? 'active' : '' }}"
                             href="{{ route('admin.products.list') }}">
                             <i class="ri-store-line"></i> <span data-key="t-widgets">Products</span>
                         </a>
                     </li> --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('admin.products*', 'admin.product*') ? 'active' : '' }}"
                            href="#sidebarProduct" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarProduct">
                            <i class="ri-store-line"></i>
                            <span data-key="t-blog">Product Management</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('admin.blogs*', 'admin.blog*', 'admin.blogcategories*', 'admin.blogcategory*') ? 'show' : '' }}"
                            id="sidebarProduct">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.products*', 'admin.product*') ? 'active' : '' }}"
                                        href="{{ route('admin.products.list') }}">
                                        Products
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.attributes*', 'admin.attributes*') ? 'active' : '' }}"
                                        href="{{ route('admin.attributes.list') }}">
                                        Attributes
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('product-bundle*', 'product-bundle*') ? 'active' : '' }}"
                                        href="{{ route('product-bundle.index') }}">
                                        Product Bundles
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('monthly-product*') ? 'active' : '' }}"
                                        href="{{ route('monthly-product.index') }}">
                                        Monthly Products
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </li>
                @endhasRoutePermission

                {{-- <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.tickets*', 'admin.tickets*') ? 'active' : '' }}"
                        href="{{ route('admin.tickets.list') }}">
                        <i class="ri-ticket-2-line"></i> <span data-key="t-widgets">Tickets</span>
                    </a>
                </li> --}}

                 <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.blogs*', 'admin.blog*', 'admin.blogcategories*', 'admin.blogcategory*') ? 'active' : '' }}"
                        href="#sidebarBlog" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarBlog">
                        <i class="ri-article-line"></i>
                        <span data-key="t-blog">Blog Management</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('admin.blogs*', 'admin.blog*', 'admin.blogcategories*', 'admin.blogcategory*') ? 'show' : '' }}"
                        id="sidebarBlog">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.blogcategories.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.blogcategories*', 'admin.blogcategory*') ? 'active' : '' }}"
                                    data-key="t-blog-categories">
                                    Blog Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.blogs.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.blogs*', 'admin.blog*') ? 'active' : '' }}"
                                    data-key="t-blogs">
                                    Blogs
                                </a>
                            </li>
                        </ul>
                    </div>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link menu-link {{ request()->routeIs('shipping.*') ? 'active' : '' }}"
                         href="{{ route('shipping.index') }}">
                         <i class="ri-truck-line"></i> <span data-key="t-widgets">Shipping</span>
                     </a>
                 </li>
                 <!-- Gift Card Inventory -->
                 @hasRoutePermission('admin.code.list')
                     {{-- <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.code*') ? 'active' : '' }}"
                             href="{{ route('admin.code.list') }}">
                             <i class="ri-gift-line"></i> <span data-key="t-widgets">Gift Card Inventory</span>
                         </a>
                     </li> --}}
                 @endhasRoutePermission

                 <!-- Customer Management -->
                 @hasRoutePermission('admin.customers.list')
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.customers*', 'admin.customer*') ? 'active' : '' }}"
                             href="{{ route('admin.customers.list') }}">
                             <i class="ri-user-3-line"></i> <span data-key="t-widgets">Customer Management</span>
                         </a>
                     </li>
                 @endhasRoutePermission

                 <!-- Subscription -->
                 <li class="nav-item">
                     <a class="nav-link settings {{ request()->routeIs('admin.subscription-plan*', 'admin.subscription.orders*', 'admin.subscriber*') ? 'active' : '' }}"
                         href="#sidebarSubscription" data-bs-toggle="collapse" role="button" aria-expanded="false"
                         aria-controls="sidebarSubscription">
                         <i class="ri-money-dollar-box-line"></i>
                         <span data-key="t-settings">Subscription</span>
                     </a>
                     <div class="collapse menu-dropdown {{ request()->routeIs('admin.subscription-plan*', 'admin.subscription.orders*', 'admin.subscriber*') ? 'show' : '' }}"
                         id="sidebarSubscription">
                         <ul class="nav nav-sm flex-column">
                             <li class="nav-item">
                                 <a href="{{ route('admin.subscription-plan.list') }}"
                                     class="nav-link {{ request()->routeIs('admin.subscription-plan.') ? 'active' : '' }}"
                                     data-key="t-footer">
                                     Subscription Plans
                                 </a>
                                 <a href="{{ route('admin.subscription.orders.list') }}"
                                     class="nav-link {{ request()->routeIs('admin.subscription.orders*', 'admin.subscription.order*') ? 'active' : '' }}"
                                     data-key="t-footer">
                                     Orders
                                 </a>
                                 <a href="{{ route('admin.subscriber.index') }}"
                                     class="nav-link {{ request()->routeIs('admin.subscriber.index*') ? 'active' : '' }}"
                                     data-key="t-footer">
                                     Subscribers
                                 </a>
                                 <a href="{{ route('admin.subscription.index') }}"
                                     class="nav-link {{ request()->routeIs('admin.subscription.index*') ? 'active' : '' }}"
                                     data-key="t-footer">
                                     Subscriptions
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>
                 <!-- Coupon Management -->
                 @hasRoutePermission('admin.customers.list')
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.coupon*') ? 'active' : '' }}"
                             href="{{ route('admin.coupon.index') }}">
                             <i class="ri-coupon-4-line"></i> <span data-key="t-widgets">Coupons</span>
                         </a>
                     </li>
                 @endhasRoutePermission
                 <!-- Wallet Transactions -->
                 @hasRoutePermission('admin.wallet.list')
                     <!-- <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.wallet*') ? 'active' : '' }}"
                             href="{{ route('admin.wallet.list') }}">
                             <i class="ri-wallet-line"></i> <span data-key="t-widgets">Wallet Transactions</span>
                         </a>
                     </li> -->
                 @endhasRoutePermission

                 <!-- Users -->
                 @hasRoutePermission('admin.users.list')
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.users*', 'admin.user*') ? 'active' : '' }}"
                             href="{{ route('admin.users.list') }}">
                             <i class="ri-user-settings-line"></i> <span data-key="t-widgets">Users</span>
                         </a>
                     </li>
                 @endhasRoutePermission

                 <!-- Suppliers -->
                 {{-- <li class="nav-item">
                     <a class="nav-link menu-link {{ request()->routeIs('admin.apiservices*', 'admin.apiservices*') ? 'active' : '' }}"
                         href="{{ route('admin.apiservices.list') }}">
                         <i class="ri-box-3-line"></i> <span data-key="t-widgets">Suppliers</span>
                     </a>
                 </li> --}}

                 <!-- Role Permissions -->
                 @if (auth()->user()->hasRole('admin'))
                     {{-- <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.permissions*') ? 'active' : '' }}"
                             href="{{ route('admin.permissions.list') }}">
                             <i class="ri-shield-user-line"></i> <span data-key="t-widgets">Role Permissions</span>
                         </a>
                     </li> --}}
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('admin.logs*') ? 'active' : '' }}"
                             href="{{ route('admin.logs.list') }}">
                             <i class=" ri-history-line"></i> <span data-key="t-widgets">Logs & History</span>
                         </a>
                     </li>
                 @endif

                 <!-- Settings (Collapsible) -->
                 @if (auth()->check() &&
                         auth()->user()->hasPermissionTo(\App\Services\PermissionMap::getPermission('admin.home_sliders.list')))
                     <li class="nav-item">
                         <a class="nav-link settings {{ request()->routeIs('admin.home_sliders*', 'admin.home_slider*', 'admin.footer*') ? 'active' : '' }}"
                             href="#sidebarSettings" data-bs-toggle="collapse" role="button" aria-expanded="false"
                             aria-controls="sidebarSettings">
                             <i class="ri-settings-2-line"></i>
                             <span data-key="t-settings">Settings</span>
                         </a>
                         <div class="collapse menu-dropdown {{ request()->routeIs('admin.home_sliders*', 'admin.home_slider*', 'admin.footer*') ? 'show' : '' }}"
                             id="sidebarSettings">
                             <ul class="nav nav-sm flex-column">
                                 @hasRoutePermission('admin.home_sliders.list')
                                     <li class="nav-item">
                                         <a href="{{ route('admin.home_sliders.list') }}"
                                             class="nav-link {{ request()->routeIs('admin.home_sliders*', 'admin.home_slider*') ? 'active' : '' }}"
                                             data-key="t-home-sliders">
                                             Home Sliders
                                         </a>
                                     </li>
                                 @endhasRoutePermission
                                 <li class="nav-item">
                                     <a href="{{ route('admin.footer.index') }}"
                                         class="nav-link {{ request()->routeIs('admin.footer*') ? 'active' : '' }}"
                                         data-key="t-footer">
                                         Footer Management
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="{{ route('admin.lang.index') }}"
                                         class="nav-link {{ request()->routeIs('admin.lang.index*') ? 'active' : '' }}"
                                         data-key="t-language">
                                         Language Management
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="{{ route('admin.free-shipping') }}"
                                         class="nav-link {{ request()->routeIs('admin.footer*') ? 'active' : '' }}"
                                         data-key="t-footer">
                                         Free shipping
                                     </a>
                                 </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.subscription.settings') }}"
                                        class="nav-link {{ request()->routeIs('admin.subscription.settings*') ? 'active' : '' }}"
                                        data-key="t-subscription">
                                        Subscription Settings
                                    </a>
                                </li>
                             </ul>
                         </div>
                     </li>
                 @endif
             </ul>
         </div>
         <!-- Sidebar -->
     </div>

     <div class="sidebar-background"></div>
 </div>
 <!-- Left Sidebar End -->
 <!-- Vertical Overlay-->
 <div class="vertical-overlay"></div>
