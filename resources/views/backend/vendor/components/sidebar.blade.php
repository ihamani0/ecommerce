

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
            <a href="{{route(App\Constants\Constants::VENDOR_DASHBOARD)}}" >
                <div class="parent-icon"><i class="fa-light fa-house fa-sm"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>



        @if(auth()->user()->status)
            {{--Product Manag--}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-duotone fa-shop"></i>
                    </div>
                    <div class="menu-title">Products</div>
                </a>
                <ul>
                    <li> <a href="{{route(\App\Constants\Constants::Vendor_Products_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List Products</a>
                    </li>
                    <li> <a href="{{route(\App\Constants\Constants::Vendor_Products_ADD)}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                    </li>
                </ul>
            </li>

            {{--Orders Manag--}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-sm fa-duotone fa-truck-fast"></i>
                    </div>
                    <div class="menu-title">Orders</div>
                </a>
                <ul>
                    <li> <a href="{{route(\App\Constants\Constants::Vendor_ORDER_INDEX)}}"><i class="bx bx-right-arrow-alt"></i>List Orders</a>
                    </li>
                    <li> <a href="{{route(\App\Constants\Constants::Vendor_ORDER_RETURN)}}"><i class="bx bx-right-arrow-alt"></i>Return List</a>
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
                    <li> <a href="{{route(\App\Constants\Constants::Vendor_Review_List)}}"><i class="bx bx-right-arrow-alt"></i>Review List</a>
                    </li>

                </ul>
            </li>
        @endif



        <li class="menu-label">Support Pages</li>

        {{--Profile --}}
        <li>
            <a href="{{ route(App\Constants\Constants::VENDOR_PROFILE_INDEX) }}">
                <div class="parent-icon"><i class="fa-sm fa-light fa-circle-user"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>

        <li>
            <a href="faq.html">
                <div class="parent-icon"><i class="fa-sm fa-light fa-circle-info"></i>
                </div>
                <div class="menu-title">FAQ</div>
            </a>
        </li>


        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="fa-light fa-headset fa-sm"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>

