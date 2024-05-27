<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>eCommerce - Register</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("frontend/assets/imgs/theme/favicon.svg")}}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset("frontend/assets/css/plugins/animate.min.css")}}" />
    <link rel="stylesheet" href="{{asset("frontend/assets/css/main.css?v=5.3")}}" />
</head>

{{--Start Body--}}
<body>

    {{--main--}}
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route(Constants::WELCOME)}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">

                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Create an Account</h1>
                                            <p class="mb-30">Already have an account? <a href="{{route(Constants::USER_LOGIN)}}">Login</a></p>
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

                                        {{--Start form--}}
                                        <form method="post" action="{{route(Constants::USER_Register_STORE)}}">
                                            @csrf

                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <input type="text" required="" name="name" placeholder="Name" />
                                                </div>
                                                <div class="col-6 form-group">
                                                    <input type="text" required="" name="last_name" placeholder="Last Name" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="Email" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" placeholder="Password" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password_confirmation" placeholder="Confirm password" />
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

                                            {{--<div class="payment_option mb-50">
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="" />
                                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">I am a customer</label>
                                                </div>
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="" />
                                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">I am a vendor</label>
                                                </div>
                                            </div>--}}

                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div>
                                            <div class="form-group mb-30">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Submit &amp; Register</button>
                                            </div>
                                            <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <img class="border-radius-15" src="{{asset("frontend/assets/imgs/page/login-1.png")}}" alt="" />
                            </div>
                            {{--oauth--}}
                            {{--<div class="col-lg-6 pr-30 d-none d-lg-block">
                                <div class="card-login mt-115">
                                    <a href="#" class="social-login facebook-login">
                                        <img src="assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                        <span>Continue with Facebook</span>
                                    </a>
                                    <a href="#" class="social-login google-login">
                                        <img src="assets/imgs/theme/icons/logo-google.svg" alt="" />
                                        <span>Continue with Google</span>
                                    </a>
                                    <a href="#" class="social-login apple-login">
                                        <img src="assets/imgs/theme/icons/logo-apple.svg" alt="" />
                                        <span>Continue with Apple</span>
                                    </a>
                                </div>
                            </div>--}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
{{--end Main--}}


    {{--footer--}}
    @include("frontend.components.footer")
    {{--SCript section--}}
    @include("frontend.components.scriptefooter")
    {{--End Body--}}

    <script>
        function generateSecurityCode() {
            return Math.floor(Math.random() * 1000) + 1000;
        }

        if(window.onload){
            const random = generateSecurityCode();
            document.getElementById("securityCode").value =  random ;

            let array_number = random.toString().split('');

            document.getElementById("new").textContent = array_number[0];
            document.getElementById("hot").textContent = array_number[1];
            document.getElementById("sale").textContent = array_number[2];
            document.getElementById("best").textContent = array_number[3];

        }

        /*const generatedCode = generateSecurityCode();
        console.log(generatedCode);*/


    </script>
</body>
</html>
