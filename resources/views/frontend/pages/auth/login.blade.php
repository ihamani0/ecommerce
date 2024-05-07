@extends("frontend.pages.auth.master-auth")
@section("title")
    eCommerce - Login
@endsection


@section("auth")
    <main class="main">

        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row shadow-lg p-3 mb-5 bg-body rounded" >
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <img class="border-radius-15" src="{{asset("frontend/assets/imgs/page/login-1.jpg")}}" alt="" />
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Login</h1>
                                            <p class="mb-30">Don't have an account? <a href="{{route("register")}}">Create here</a></p>
                                        </div>

                                        @if ($errors->any())
                                            <div class="row mb-3 alert alert-danger">
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li>{{$error}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        {{--Start Form--}}
                                        <form method="post" action="{{route("login.store")}}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="Username or Email *" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" placeholder="Your password *" />
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <input type="text" required="" name="securityCodeInput" placeholder="Security code *" autocomplete="no" />
                                                </div>
                                                {{--input hiddesn for display code --}}
                                                <input type="hidden" id="securityCode" name="securityCodeInput_confirmation" >
                                                <span class="security-code" id="displayCode">
                                                    {{--scurty code--}}
                                                    <b class="text-new" id="new"></b>
                                                    <b class="text-hot"  id="hot"></b>
                                                    <b class="text-sale" id="sale"></b>
                                                    <b class="text-best" id="best"></b>
                                                </span>

                                            </div>


                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                                <a class="text-muted" href="{{route("password.request")}}">Forgot password?</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Log in</button>
                                            </div>
                                        </form>
                                        {{--end form--}}
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



