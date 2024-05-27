

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
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li> <a href="index.html"><i class="bx bx-right-arrow-alt"></i>Default</a>
                </li>
            </ul>
        </li>

        {{--Brand --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
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
                <div class="parent-icon"><i class='bx bxs-category'></i>
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

        {{--Category --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-duplicate' ></i>
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

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bxs-user-pin'></i>
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




       {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li> <a href="index.html"><i class="bx bx-right-arrow-alt"></i>Default</a>
                </li>
                <li> <a href="dashboard-eCommerce.html"><i class="bx bx-right-arrow-alt"></i>eCommerce</a>
                </li>
                <li> <a href="dashboard-analytics.html"><i class="bx bx-right-arrow-alt"></i>Analytics</a>
                </li>
                <li> <a href="dashboard-digital-marketing.html"><i class="bx bx-right-arrow-alt"></i>Digital Marketing</a>
                </li>
                <li> <a href="dashboard-human-resources.html"><i class="bx bx-right-arrow-alt"></i>Human Resources</a>
                </li>
            </ul>
        </li>--}}



        <li>
            <a href="{{ route("admin.profile") }}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
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

