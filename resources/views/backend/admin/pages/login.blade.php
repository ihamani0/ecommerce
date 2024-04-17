@extends('layouts.master')

@section("title")
 Ecommerce | Login
@endsection

@push("style")
<style>
    .btn-color{
    background-color: #0e1c36;
    color: #fff;

  }

  .profile-image-pic{
    height: 200px;
    width: 200px;
    object-fit: cover;
  }



  .cardbody-color{
    background-color: #ebf2fa;
  }

  a{
    text-decoration: none;
  }
</style>

@endpush

@section("contnet")

<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Login </h2>
        <div class="card my-5">

          <form class="card-body cardbody-color p-lg-5" method="POST" action="{{ route("admin.loginStore")}}">

            @csrf
            @error('error')
                <div class="text-center alert alert-danger">{{ $message }}</div>
            @enderror
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <div class="text-center">
              <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">
            </div>

            <div class="mb-3">
              <input type="text" class="form-control @error("email") is-invalid  @enderror " id="Email" aria-describedby="emailHelp"
                placeholder="exo@example.com" name="email" required>
            </div>

            @error('email')<div class="alert alert-danger">{{ $message }}</div>@enderror

            <div class="mb-3">
              <input type="password" class="form-control @error("password") is-invalid  @enderror " id="password" placeholder="password" name="password" @required(true)>
            </div>

            @error('password')<div class="alert alert-danger" role="alert">{{ $message }}</div>@enderror

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>


            <div class="text-center">
                <button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>
@endsection
