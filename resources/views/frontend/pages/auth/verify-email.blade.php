<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>eCommerce - verify-email</title>
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

{{--main --}}

<main class="main pages">
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
            <div class="row">
                <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                    <div class="row">
                        <div class="heading_s1">
                            <img class="border-radius-15" src="{{asset("frontend/assets/imgs/page/verify-email.jpg")}}" alt="" style="width: 150px;height: 150px"/>
                            <h2 class="mb-15 mt-15">Verification Email</h2>
                            <p class="mb-30">Thanks for signing up! Before getting started, could you verify your email address by
                                clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another</p>
                        </div>

                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">

                                    <div class="row">
                                        @if (session('status') == 'verification-link-sent')

                                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}

                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10 col-md-10">
                                            <form method="POST" action="{{ route('verification.send') }}">
                                                @csrf

                                                <div>
                                                    <button type="submit" class="btn btn-heading btn-block hover-up"><i class="bx bx-comment mr-1"></i>
                                                        Resend Verification Email
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-lg-2 col-md-2">
                                            <form method="POST" action="{{ route('user.logout') }}">
                                                @csrf

                                                <button type="submit" class="border border-red-500 text-red-500 rounded-md px-4 py-2 transition duration-300 ease-in-out hover:bg-red-500 hover:text-white"
                                                        href="{{route("user.logout")}}"><i class="fi-rs-sign-out mr-10"></i>Logout</button>
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
</main>


{{--end Main--}}

<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{asset("frontend/assets/imgs/theme/loading.gif")}}" alt="" />
            </div>
        </div>
    </div>
</div>

{{--footer--}}
@include("frontend.components.footer")
{{--SCript section--}}
@include("frontend.components.scriptefooter")
{{--End Body--}}

</body>
</html>
