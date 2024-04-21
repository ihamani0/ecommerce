
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
	<title>Verify | login-vendor</title>

    <style>
        .jumbotron.text-center {
            height: 17em;
        }

        input.form-control.col-md-6 {
            width: 50%;
            margin-right: 1em;
            display: inline;
        }

        div#notes {
            margin-top: 2%;
            width: 98%;
            margin-left: 1%;
        }

        @media (min-width: 991px) {
            .col-md-9.col-sm-12 {
                margin-left: 12%;
            }
        }
    </style>
</head>

<body class="bg-login">
	<!--wrapper-->
    <div class="container">
        <!-- Instructions -->
        <div class="row">
          <div class="alert alert-success col-md-12" role="alert" id="notes">
            <h4>NOTES</h4>
            <ul>
              <li>You will recieve a verification code on your mail after you registered. Enter that code below.</li>
              <li>If somehow, you did not recieve the verification email then <a href="#">resend the verification email</a></li>
            </ul>
          </div>
        </div>

        @if ($errors->has('Error'))
            <div class="row mb-3 alert alert-danger">

                <div class="col-sm-9 text-secondary">
                    {{ $errors->first('Error')}}
                </div>
            </div>
        @endif


        <!-- Verification Entry Jumbotron -->
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron text-center">
              <h2><i>Enter the verification code</i></h2>

              <!-- Verification Entry Form -->
              <form method="post" action="{{ route("verification.confirm") }}" role="form">
                @csrf
                <div class="col-md-9 col-sm-12">
                  <div class="form-group form-group-lg">
                    <input type="text" class="form-control col-md-6 col-sm-6 col-sm-offset-2 @error('otp') is-invalide @enderror"
                     name="otp" required>



                    <input class="btn btn-primary btn-lg col-md-2 col-sm-2 "
                        type="submit" value="Verify">

                  </div>
                  @error('otp')
                  <span class="text-danger mt-2">{{ $message }}</span>
                  @enderror
                </div>
              </form>
              <!-- End Verification Email -->

            </div>
          </div>
        </div>
      </div>

    <!-- Bootstrap JS -->
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
		});
	</script>
	<!--app JS-->
    <script src="{{ asset("backend/assets/js/app.js") }}"></script>
</body>

</html>
