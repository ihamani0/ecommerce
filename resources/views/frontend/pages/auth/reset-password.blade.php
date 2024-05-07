@extends("frontend.pages.auth.master-auth")

@section("title")
    Reset Password
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
                                <img class="border-radius-15" src="{{asset("frontend/assets/imgs/page/reset_password.svg")}}" alt="" />

                                @if ($errors->any())
                                    <div class="row mb-3 alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <h2 class="mb-15 mt-15">Set new password</h2>
                                <p class="mb-30">Please create a new password that you don’t use on any other site.</p>
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">

                                        <form method="post"  action="{{ route('password.store') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                            <input type="hidden"  name="email" value="{{$request->email}}"/>
                                            <div class="form-group">
                                                <input type="password" required="" name="password" placeholder="Password *" />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" required="" name="password_confirmation" placeholder="Confirm you password *" />
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up">Reset Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{--<div class="col-lg-6 pl-50">
                                <h6 class="mb-15">Password must:</h6>
                                <p>Be between 9 and 64 characters</p>
                                <p>Include at least tow of the following:</p>
                                <ol class="list-insider">
                                    <li>An uppercase character</li>
                                    <li>A lowercase character</li>
                                    <li>A number</li>
                                    <li>A special character</li>
                                </ol>
                            </div>--}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
