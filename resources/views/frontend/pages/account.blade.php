@extends("frontend.layout.master")

@section("main")
    <main class="main pages">


        {{--Verify Verification Email--}}
        @if(! \Illuminate\Support\Facades\Auth::user()->hasVerifiedEmail())
            <div class="row shadow-lg p-3 mb-5 bg-body rounded ">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div>
                        Please Verify you email we send you verification
                    </div>
                </div>
            </div>
        @endif


        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route(\App\Constants\Constants::WELCOME)}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="row">

                            {{--Side Nav--}}
                            <div class="col-md-3">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a  class="nav-link" id="dashboard-tab"
                                                href="{{route(\App\Constants\Constants::USER_ACCOUNT_DASHBOARD)}}">
                                                <i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_Orders)}}">
                                                <i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_Track_Orders)}}">
                                                <i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_ADDRESS_DETAILS)}}" >
                                                <i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_UPDATE_INDEX)}}" >
                                                <i class="fi-rs-user mr-10"></i>Account details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="change-password-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_CHANGE_PASSWORD)}}" >
                                                <i class="fi-rs-lock mr-10"></i>Change password</a>
                                        </li>
                                        {{--delete-account-tab--}}
                                        <li class="nav-item">
                                            <a class="nav-link" id="delete-account-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_DELETE_INDEX)}}">
                                                <i class="fi-rs-delete mr-10"></i>Delete Account</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route(\App\Constants\Constants::USER_LOGOUT)}}">
                                                    <i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{--End Side Nav--}}
                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content pl-50">

                                    @if ($errors->any())
                                        <div class="row mb-3 alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif



                                        {{--Slot Her --}}
                                        @yield("account")
                                        {{----}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
