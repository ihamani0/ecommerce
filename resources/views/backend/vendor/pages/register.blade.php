<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset("backend/assets/images/favicon-32x32.png") }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset("backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css") }}" rel="stylesheet"/>
    <link href="{{ asset("backend/assets/plugins/simplebar/css/simplebar.css") }}" rel="stylesheet" />
    <link href="{{ asset("backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css") }}" rel="stylesheet" />
    <link href="{{ asset("backend/assets/plugins/metismenu/css/metisMenu.min.css") }}" rel="stylesheet" />


    <!-- loader-->
    <link href="{{ asset("backend/assets/css/pace.min.css") }}" rel="stylesheet" />
    <script src="{{ asset("backend/assets/js/pace.min.js") }}"></script>


    <!-- Bootstrap CSS -->
    <link href="{{ asset("backend/assets/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("backend/assets/css/app.css") }}" rel="stylesheet">
    <link href="{{ asset("backend/assets/css/icons.css") }}" rel="stylesheet">


    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset("backend/assets/css/dark-theme.css") }}" />
    <link rel="stylesheet" href="{{ asset("backend/assets/css/semi-dark.css") }}" />
    <link rel="stylesheet" href="{{ asset("backend/assets/css/header-colors.css") }}" />
	<title>Ecomme | register-vendor</title>
</head>
<body>


    <body class="bg-login">
        <!--wrapper-->
        <div class="wrapper">
            <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                        <div class="col mx-auto">
                            <div class="my-4 text-center">
                                <img src="{{ asset("backend/assets/images/logo-img.png") }}" width="180" alt="" />
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Sign Up</h3>
                                            <p>Already have an account? <a href="{{ route("vendor.login") }}">Sign in here</a>
                                            </p>
                                        </div>

    @if ($errors->any())
        <div class="row mb-3 alert alert-danger">

            <div class="col-sm-9 text-secondary">
                {{ $errors->first('Error')}}
            </div>
        </div>
    @endif


                                        <div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
                                            <hr/>
                                        </div>
                                        <div class="form-body">
                                            {{-- start  Form register --}}


<form class="row g-3" method="post" action="{{ route("vendor.register.store") }}">
    @csrf
    <div class="col-sm-6">
        <label for="inputFirstName" class="form-label">First Name</label>
        <input type="text" class="form-control @error('firstname') is-invalide @enderror " name="firstname"  id="inputFirstName" placeholder="Jhon" value="{{ old("firstname") }}" required>
    </div>
    @error('firstname')<span class="text-danger mt-2">{{ $message }}</span>@enderror


    <div class="col-sm-6">
        <label for="inputLastName" class="form-label">Last Name</label>
        <input type="text" class="form-control @error('lastname') is-invalide @enderror "
        name="lastname" id="inputLastName" placeholder="Deo" value="{{ old("lastname") }}" required>
    </div>
    @error('lastname')<span class="text-danger mt-2">{{ $message }}</span>@enderror


    <div class="col-12">
        <label for="inputEmailAddress" class="form-label">Email Address</label>
        <input type="email" class="form-control @error('email') is-invalide @enderror "
        name="email" id="inputEmailAddress" placeholder="example@user.com" value="{{ old("email") }}">
    </div>
    @error('email')<span class="text-danger mt-2">{{ $message }}</span>@enderror

    <div class="col-12">
        <label for="inputChoosePassword" class="form-label">Password</label>
        <div class="input-group" id="show_hide_password">

            <input type="password" class="form-control border-end-0  @error('password') is-invalide @enderror "
            name="password"  id="password"  placeholder="Enter Password"
                oncopy="return false;" onpaste="return false;" required >

                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
        </div>
        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="col-12">
        <label for="inputChoosePassword" class="form-label">Confirme Password</label>
        <div class="input-group" id="show_hide_confirm_password">
            <input type="password" class="form-control border-end-0" name="password_confirmation" id="password_confirmation"  placeholder="Confirme Password"
            oncopy="return false;" onpaste="return false;" required>
                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
        </div>
    </div>




    {{-- Trem and condtion --}}
    {{-- <div class="col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
            <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
        </div>
    </div> --}}

    <div class="col-12">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
        </div>
    </div>
</form>

                                            {{-- end Form register --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <!--end wrapper-->

<script src="{{ asset("backend/assets/js/bootstrap.bundle.min.js") }}"></script>
<!--plugins-->
<script src="{{ asset("backend/assets/js/jquery.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/simplebar/js/simplebar.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/metismenu/js/metisMenu.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js") }}"></script>
<!--Password show & hide js -->
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
        //show_hide_confirm_password

        $("#show_hide_confirm_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_confirm_password input').attr("type") == "text") {
                $('#show_hide_confirm_password input').attr('type', 'password');
                $('#show_hide_confirm_password i').addClass("bx-hide");
                $('#show_hide_confirm_password i').removeClass("bx-show");
            } else if ($('#show_hide_confirm_password input').attr("type") == "password") {
                $('#show_hide_confirm_password input').attr('type', 'text');
                $('#show_hide_confirm_password i').removeClass("bx-hide");
                $('#show_hide_confirm_password i').addClass("bx-show");
            }
        });


    });
</script>
<!--app JS-->
<script src="{{ asset("backend/assets/js/app.js") }}"></script>
</body>

</html>
