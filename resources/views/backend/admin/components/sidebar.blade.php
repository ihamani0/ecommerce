

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
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-duotone fa-house fa-xs"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li> <a href="{{route(\App\Constants\Constants::Admin_DASHBOARD)}}"><i class="bx bx-right-arrow-alt"></i>Default</a>
                </li>
            </ul>
        </li>

        {{--Brand --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-sharp fa-solid fa-bookmark fa-xs"></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{route(Constants::Admin_BRAND_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List Brand</a>
                </li>
                <li> <a href="{{route(Constants::Admin_BRAND_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                </li>
            </ul>
        </li>

        {{--Category --}}

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-rectangle-vertical-history fa-xs"></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li> <a href="{{route(Constants::Admin_Category_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List Category</a>
                </li>
                <li> <a href="{{route(Constants::Admin_Category_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>
            </ul>
        </li>

        {{--SubCategory --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-duotone fa-clone fa-xs"></i>
                </div>
                <div class="menu-title">SubCategory</div>
            </a>
            <ul>
                <li> <a href="{{route(\App\Constants\Constants::Admin_SubCategory_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List SubCategory</a>
                </li>
                <li> <a href="{{route(\App\Constants\Constants::Admin_SubCategory_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add SubCategory</a>
                </li>
            </ul>
        </li>

        {{--Products Managmnet--}}

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-duotone fa-shop fa-xs"></i>
                </div>
                <div class="menu-title">Products</div>
            </a>
            <ul>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Products_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List Products</a>
                </li>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Products_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
            </ul>
        </li>

        {{--Coupons System--}}

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-duotone fa-badge-percent fa-xs"></i>
                </div>
                <div class="menu-title">Coupons</div>
            </a>
            <ul>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Coupon_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List Coupon</a>
                </li>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Coupon_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                </li>
            </ul>
        </li>


        {{--Vendors Status--}}
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

        <li class="menu-label">Orders </li>

        {{--Orders Status--}}
        <li class="">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-bag-shopping fa-xs"></i>
                </div>
                <div class="menu-title">Orders Mange</div>
            </a>
            <ul>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Order_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>Orders List</a>
                </li>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Order_Return_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>Return List</a>
                </li>
            </ul>
        </li>


        {{--Register --}}
        <li class="menu-label">Register</li>

        <li class="">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-duotone fa-book-user fa-xs"></i>
                </div>
                <div class="menu-title">Register Users</div>
            </a>
            <ul>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Register_Users)}}"><i class="bx bx-right-arrow-alt"></i>Client List</a>
                </li>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Register_Vendor)}}"><i class="bx bx-right-arrow-alt"></i>Vendor List</a>
                </li>
            </ul>
        </li>


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

        <hr>
        {{--Report Status--}}
        <li class="">
            <a href="{{route(\App\Constants\Constants::Admin_Report_Index)}}" >
                <div class="parent-icon"><i class="fa-duotone fa-file-spreadsheet fa-xs"></i>
                </div>
                <div class="menu-title">Report Mange</div>
            </a>

        </li>




        <li class="menu-label">Landing Page</li>

        {{--Slide Panel--}}
        <li>
            <a class="has-arrow" href="javascript:;" >
                <div class="parent-icon"><i class="fa-duotone fa-layer-group fa-xs"></i>
                </div>
                <div class="menu-title">Slide Panel</div>
            </a>
            <ul>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Slide_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>Slide List</a>
                </li>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Slide_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Slide</a>
                </li>
            </ul>
        </li>

        {{--Banner Panel--}}
        <li>
            <a class="has-arrow" href="javascript:;" >
                <div class="parent-icon"><i class="fa-duotone fa-layer-group fa-xs"></i>
                </div>
                <div class="menu-title">Banner Panel</div>
            </a>
            <ul>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Banner_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>Banner List</a>
                </li>
                <li> <a href="{{route(\App\Constants\Constants::Admin_Banner_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>
            </ul>
        </li>





        <hr>
        <li>
            <a href="{{ route("admin.profile") }}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>

        <li>
            <a href="{{ route(\App\Constants\Constants::Admin_Setting_Index) }}">
                <div class="parent-icon"><i class="fa-duotone fa-solid fa-gear"></i>
                </div>
                <div class="menu-title">Config WebSite</div>
            </a>
        </li>

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

