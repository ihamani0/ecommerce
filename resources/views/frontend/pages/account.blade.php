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
                    <div class="col-lg-10 m-auto">
                        <div class="row">

                            {{--Side Nav--}}
                            <div class="col-md-3">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="change-password-tab" data-bs-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="true"><i class="fi-rs-lock mr-10"></i>Change password</a>
                                        </li>
                                        {{--delete-account-tab--}}
                                        <li class="nav-item">
                                            <a class="nav-link" id="delete-account-tab" data-bs-toggle="tab" href="#delete-account" role="tab" aria-controls="delete-account" aria-selected="true"><i class="fi-rs-delete mr-10"></i>Delete Account</a>
                                        </li>

                                        <li class="nav-item">
                                            <form method="post" action="{{route(Constants::USER_LOGOUT)}}" id="logoutForm">
                                                @csrf
                                                <a class="nav-link" href="{{route(Constants::USER_LOGOUT)}}"
                                                   onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                                                ><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                            </form>

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


                                    {{--dashboard--}}
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">{{\Illuminate\Support\Facades\Auth::user()->name}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <p>
                                                    From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                                                    manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Orders--}}
                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Your Orders</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>#1357</td>
                                                            <td>March 45, 2020</td>
                                                            <td>Processing</td>
                                                            <td>$125.00 for 2 item</td>
                                                            <td><a href="#" class="btn-small d-block">View</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>#2468</td>
                                                            <td>June 29, 2020</td>
                                                            <td>Completed</td>
                                                            <td>$364.00 for 5 item</td>
                                                            <td><a href="#" class="btn-small d-block">View</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>#2366</td>
                                                            <td>August 02, 2020</td>
                                                            <td>Completed</td>
                                                            <td>$280.00 for 3 item</td>
                                                            <td><a href="#" class="btn-small d-block">View</a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{--Track Orders--}}
                                    <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Orders tracking</h3>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                            <div class="input-style mb-20">
                                                                <label>Order ID</label>
                                                                <input name="order-id" placeholder="Found in your order confirmation email" type="text" />
                                                            </div>
                                                            <div class="input-style mb-20">
                                                                <label>Billing email</label>
                                                                <input name="billing-email" placeholder="Email you used during checkout" type="email" />
                                                            </div>
                                                            <button class="submit submit-auto-width" type="submit">Track</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Address Details--}}
                                    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">Billing Address</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>
                                                            3522 Interstate<br />
                                                            75 Business Spur,<br />
                                                            Sault Ste. <br />Marie, MI 49783
                                                        </address>
                                                        <p>New York</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Shipping Address</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>
                                                            4299 Express Lane<br />
                                                            Sarasota, <br />FL 34249 USA <br />Phone: 1.941.227.4444
                                                        </address>
                                                        <p>Sarasota</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--account details--}}
                                    <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Account Details</h5>
                                            </div>
                                            <div class="card-body">

                                        <form method="post" name="enq" action="{{route(Constants::USER_ACCOUNT_UPDATE)}}">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>First Name <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="name" type="text" value="{{auth()->user()->name}}"/>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Email Address <span class="required">*</span></label>
                                                    <input class="form-control" name="email" type="email" value="{{auth()->user()->email}}" />

                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Phone Number <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="phone_number" type="text" value="{{auth()->user()->phone_number}}" />
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Address <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="street_address" type="text" value="{{auth()->user()->street_address}}" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>City: <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="city" type="text" value="{{auth()->user()->city}}" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Postal code: <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="postal_code" type="text" value="{{auth()->user()->postal_code}}" />
                                                </div>



                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit">Save Change</button>
                                                </div>
                                            </div>

                                        </form>

                                            </div>
                                        </div>

                                    </div>

                                    {{--Password Change --}}

                                    <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                                        <div class="card">

                                            <div class="card-header">
                                                <h3 class="mb-0">Change Password</h3>
                                            </div>

                                            <div class="card-body contact-from-area">

                                                <div class="row">
                                                    <div class="col-lg-8">

                                                        <form class="contact-form-style mt-30 mb-50" action="{{route("password.update")}}" method="post">

                                                            @csrf
                                                            {{--@method('PUT')--}}
                                                            <div class="form-group col-md-12">
                                                                <label>Current Password <span class="required text-danger">*</span></label>
                                                                <input name="current_password"   class="form-control" type="password" />
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>New Password <span class="required text-danger">*</span></label>
                                                                <input name="new_password"  class="form-control"  type="password" />
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>Confirm Password <span class="required text-danger">*</span></label>
                                                                <input name="new_password_confirmation"  class="form-control" type="password" />
                                                            </div>

                                                            <button class="submit submit-auto-width" type="submit">Change</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Delete Account--}}
                                    <div class="tab-pane fade" id="delete-account" role="tabpanel" aria-labelledby="delete-account-tab">
                                            <div class="card">

                                                <div class="card-header">
                                                    <h3 class="mb-0"><i class="fi-rs-trash"></i> Delete Account</h3>
                                                </div>

                                                <div class="card-body contact-from-area">

                                                    <div class="row">
                                                        <div class="col-lg-8">

                                                            <form class="contact-form-style mt-30 mb-50" action="{{route(Constants::USER_ACCOUNT_DELETE)}}" method="post">



                                                                @csrf
                                                                {{--@method('PUT')--}}
                                                                <div class="form-group col-md-12">
                                                                    <label>Password <span class="required text-danger">*</span></label>
                                                                    <input name="password"   class="form-control" type="password" />
                                                                </div>

                                                                <button class="submit submit-auto-width" style="background-color: #d92129" type="submit">Delete</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
