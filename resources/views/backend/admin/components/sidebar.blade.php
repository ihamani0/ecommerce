
{{--@php
    $user = auth()->guard('admin')->user();
    dd($user->getAllPermissions()->pluck('name'));
@endphp--}}

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">

            {{-- Logo --}}
        <div>
            <img src="{{ asset("backend/assets/images/logo-icon.png") }}" class="logo-icon" alt="logo icon">
        </div>

        <div>
            <h4 class="logo-text">eComme</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">


        <li>
            <a href="{{route(\App\Constants\Constants::Admin_DASHBOARD)}}" >
                <div class="parent-icon"><i class="fa-duotone fa-house fa-xs"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


        {{--Brand --}}
        @if(auth()->guard('admin')->user()->can('view.brand'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-sharp fa-solid fa-bookmark fa-xs"></i>
                    </div>
                    <div class="menu-title">Brand</div>
                </a>
                <ul>
                    @if(auth()->guard('admin')->user()->can('view.brand'))
                        <li> <a href="{{route(Constants::Admin_BRAND_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List Brand</a>
                        </li>
                    @endif
                    @if(auth()->guard('admin')->user()->can('add.brand'))
                        <li> <a href="{{route(Constants::Admin_BRAND_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        {{--Category --}}

        @if(auth()->guard('admin')->user()->can('view.category'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-solid fa-rectangle-vertical-history fa-xs"></i>
                    </div>
                    <div class="menu-title">Category</div>
                </a>
                <ul>
                    @if(auth()->guard('admin')->user()->can('view.category'))
                        <li> <a href="{{route(Constants::Admin_Category_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List Category</a>
                        </li>
                    @endif
                    @if(auth()->guard('admin')->user()->can('add.category'))
                        <li> <a href="{{route(Constants::Admin_Category_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        {{--SubCategory --}}
        @if(auth()->guard('admin')->user()->can('view.subcategory'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-duotone fa-clone fa-xs"></i>
                    </div>
                    <div class="menu-title">SubCategory</div>
                </a>
                <ul>
                    @if(auth()->guard('admin')->user()->can('view.subcategory'))
                        <li> <a href="{{route(\App\Constants\Constants::Admin_SubCategory_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List SubCategory</a>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->can('add.subcategory'))
                        <li> <a href="{{route(\App\Constants\Constants::Admin_SubCategory_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add SubCategory</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif

        {{--Products Managmnet--}}
        @if(auth()->guard('admin')->user()->can('view.product'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-duotone fa-shop fa-xs"></i>
                </div>
                <div class="menu-title">Products</div>
            </a>
            <ul>
                @if(auth()->guard('admin')->user()->can('view.product'))
                    <li> <a href="{{route(\App\Constants\Constants::Admin_Products_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List Products</a>
                    </li>
                @endif
                @if(auth()->guard('admin')->user()->can('add.product'))
                    <li> <a href="{{route(\App\Constants\Constants::Admin_Products_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                    </li>
                @endif
            </ul>
        </li>
        @endif

        {{--Stock Managmnet--}}
        @if(auth()->guard('admin')->user()->can('view.stock'))
        <li>
            <a href="{{route(\App\Constants\Constants::Admin_Stock_Index)}}" >
                <div class="parent-icon"><i class="fa-duotone fa-stocking fa-xs"></i>
                </div>
                <div class="menu-title">Stock Manage</div>
            </a>
        </li>
        @endif
        {{--Coupons System--}}

        @if(auth()->guard('admin')->user()->can('view.coupon'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-duotone fa-badge-percent fa-xs"></i>
                </div>
                <div class="menu-title">Coupons</div>
            </a>
            <ul>
                @if(auth()->guard('admin')->user()->can('view.coupon'))
                    <li> <a href="{{route(\App\Constants\Constants::Admin_Coupon_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List Coupon</a>
                    </li>
                @endif
                @if(auth()->guard('admin')->user()->can('add.coupon'))
                    <li> <a href="{{route(\App\Constants\Constants::Admin_Coupon_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                    </li>
                @endif
            </ul>
        </li>
        @endif

        {{--Vendors Status--}}
        @if(auth()->guard('admin')->user()->can('view.vendor'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-duotone fa-users fa-xs"></i>
                </div>
                <div class="menu-title">Vendors</div>
            </a>
            <ul>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Vendor_StatusActive_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>Active List</a>
                </li>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Vendor_StatusInActive_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>InActive List</a>
                </li>
            </ul>
        </li>
        @endif


        @if(auth()->guard('admin')->user()->can('view.order'))
            <li class="menu-label">Orders </li>


            {{--Orders Status--}}
            <li class="">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-solid fa-bag-shopping fa-xs"></i>
                    </div>
                    <div class="menu-title">Orders Mange</div>
                </a>
                <ul>
                    @if(auth()->guard('admin')->user()->can('view.order'))
                    <li> <a href="{{route(\App\Constants\Constants::Admin_Order_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>Orders List</a>
                    </li>
                    @endif

                    @if(auth()->guard('admin')->user()->can('view.order-return'))
                        <li> <a href="{{route(\App\Constants\Constants::Admin_Order_Return_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>Return List</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif



        @if(auth()->guard('admin')->user()->hasPermissionTo('register.users'))
            {{--Register --}}
            <li class="menu-label">Register</li>

            <li class="">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-duotone fa-book-user fa-xs"></i>
                    </div>
                    <div class="menu-title">Register Users</div>
                </a>
                <ul>
                    @if(auth()->guard('admin')->user()->can('view.register-users'))
                        <li> <a href="{{route(\App\Constants\Constants::Admin_Register_Users)}}"><i class="bx bx-right-arrow-alt"></i>Client List</a>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->can('view.register-vendors'))
                            <li> <a href="{{route(\App\Constants\Constants::Admin_Register_Vendor)}}"><i class="bx bx-right-arrow-alt"></i>Vendor List</a>
                            </li>
                    @endif

                    @if(auth()->guard('admin')->user()->can('view.register-admins'))
                        <li> <a href="{{route(\App\Constants\Constants::Admin_Register_Admin)}}"><i class="bx bx-right-arrow-alt"></i>Admin List</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif
        {{--Role\Permissions --}}

        @if(auth()->guard('admin')->user()->can('view.role'))
        <li class="">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-duotone fa-solid fa-scale-balanced fa-xs"></i>
                </div>
                <div class="menu-title">Role & Permissions</div>
            </a>
            <ul>
                @if(auth()->guard('admin')->user()->can('view.permissions'))
                    <li> <a href="{{route(\App\Constants\Constants::Admin_Permission_Index)}}"><i class="bx bx-right-arrow-alt"></i>Permissions List</a>
                    </li>
                @endif

                @if(auth()->guard('admin')->user()->can('view.role'))
                <li> <a href="{{route(\App\Constants\Constants::Admin_Role_Index)}}"><i class="bx bx-right-arrow-alt"></i>Role List</a>
                </li>
                @endif
            </ul>
        </li>
        @endif


        @if(auth()->guard('admin')->user()->can('view.review'))
        <li class="">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-duotone fa-comment fa-xs"></i>
                </div>
                <div class="menu-title">Review Mange</div>
            </a>
            <ul>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Review_List)}}"><i class="bx bx-right-arrow-alt"></i>Review List</a>
                </li>

            </ul>
        </li>
        @endif

        <hr>
        {{--Report Status--}}
        @if(auth()->guard('admin')->user()->can('view.report'))

        <li class="">
            <a href="{{route(\App\Constants\Constants::Admin_Report_Index)}}" >
                <div class="parent-icon"><i class="fa-duotone fa-file-spreadsheet fa-xs"></i>
                </div>
                <div class="menu-title">Report Mange</div>
            </a>

        </li>
        @endif



        @if(auth()->guard('admin')->user()->can('view.slider'))
        <li class="menu-label">Landing Page</li>

        {{--Slide Panel--}}
        <li>
            <a class="has-arrow" href="javascript:;" >
                <div class="parent-icon"><i class="fa-duotone fa-layer-group fa-xs"></i>
                </div>
                <div class="menu-title">Slide Panel</div>
            </a>
            <ul>
                @if(auth()->guard('admin')->user()->can('view.slider'))
                    <li> <a href="{{route(\App\Constants\Constants::Admin_Slide_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>Slide List</a>
                    </li>
                @endif

                @if(auth()->guard('admin')->user()->can('add.slider'))
                    <li> <a href="{{route(\App\Constants\Constants::Admin_Slide_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Slide</a>
                    </li>
                @endif
            </ul>
        </li>
        @endif

        {{--Banner Panel--}}
        @if(auth()->guard('admin')->user()->can('view.banner'))
        <li>
            <a class="has-arrow" href="javascript:;" >
                <div class="parent-icon"><i class="fa-duotone fa-layer-group fa-xs"></i>
                </div>
                <div class="menu-title">Banner Panel</div>
            </a>
            <ul>
                @if(auth()->guard('admin')->user()->can('view.banner'))
                <li> <a href="{{route(\App\Constants\Constants::Admin_Banner_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>Banner List</a>
                </li>
                @endif
                @if(auth()->guard('admin')->user()->can('add.banner'))
                <li> <a href="{{route(\App\Constants\Constants::Admin_Banner_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>
                @endif
            </ul>
        </li>
        @endif





        <hr>
        <li>
            <a href="{{ route("admin.profile") }}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>

        @if(auth()->guard('admin')->user()->can('view.config'))
        <li>
            <a href="{{ route(\App\Constants\Constants::Admin_Setting_Index) }}">
                <div class="parent-icon"><i class="fa-duotone fa-solid fa-gear"></i>
                </div>
                <div class="menu-title">Config WebSite</div>
            </a>
        </li>
        @Endif

        <li>
            <a href="faq.html">
                <div class="parent-icon"><i class="bx bx-help-circle"></i>
                </div>
                <div class="menu-title">FAQ</div>
            </a>
        </li>


        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>

