@extends("frontend.pages.auth.master-auth")
@section("title")
    eCommerce | Forget passwrod
@endsection

@section("auth")
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
                                <h2 class="mb-15 mt-15">Forget password</h2>
                                <p class="mb-30 ">Forgot your password? No problem. Just let us know your email address
                                        and we will email you a password reset link that will allow you to choose a new one</p>

                                @if (session('status'))
                                    <span class="text-green-600 ">
                                        {{ session('status') }}
                                    </span>
                                @endif

                                @if ($errors->any())
                                    <div class="row mb-3 alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">

                                        <form method="post"  action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="Email *"  value="{{old('email')}}" />
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up">
                                                    Email Password Reset Link
                                                </button>
                                            </div>
                                        </form>
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
