@extends('backend.vendor.layout.master')

@section('title')
    Vendor | E-comme
@endsection

@push('style')
@endpush

@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Profile</div>

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Vendor Profile</li>

                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                        <a class="dropdown-item" href="{{ route('vendor.profile.ChangePassword.index') }} ">Change
                            Password</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">

                                    {{-- Photo Profile --}}

                                    <img src="{{ !empty($user->photo_profile) ? url("upload/vendor.photo/$user->photo_profile") : url('upload/user.png') }}"
                                        alt="Admin" class="rounded-circle p-2 bg-dark" width="110">
                                    <div class="mt-3">

                                        {{-- ------------ --}}
                                        <h4>{{ $user->name }}</h4>
                                        <p class="text-secondary mb-1">Email: {{ $user->email }}</p>
                                        <p class="text-secondary mb-1">Phone: {{ $user->phone_number }}</p>

                                    </div>
                                </div>
                                <hr class="my-4" />


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">


                                @if ($errors->any())
                                    <div class="alert alert-danger border-0 alert-dismissible">
                                        @foreach ($errors->all() as $error)
                                            <div>{{ $error }}</div><br>
                                        @endforeach
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif





                                {{-- Start Form  --}}
                                <form action="{{ route('vendor.profile.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $user->name }} " />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input class="form-control mb-3" type="text" placeholder="Disabled input"
                                                aria-label="Disabled input example" value="{{ $user->email }}"
                                                disabled="">
                                        </div>
                                    </div>
                                    @error('email')
                                        <div id="emailServerUsernameFeedback" class="invalid-feedback">{{ $message }}
                                        </div>
                                    @enderror


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label for="validationServerUsername" class="form-label">
                                                <h6>Username</h6>
                                            </label>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                                <input type="text"
                                                    class="form-control @error('username') is-invalid @enderror "
                                                    name="username" id="validationServerUsername"
                                                    aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback"
                                                    value="{{ $user->username }}">
                                                @error('username')
                                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>




                                    {{-- --------------- --}}

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                class="form-control   @error('phone_number') is-invalid @enderror "
                                                name="phone_number" value="{{ $user->phone_number }}" />
                                        </div>

                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mb-3">
                                        {{-- city  --}}
                                        <div class="col-sm-3">
                                            <label for="validationServer03" class="form-label">
                                                <h6>Address</h6>
                                            </label>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                class="form-control @error('street_address') is-invalid @enderror"
                                                name="street_address" id="validationServer03"
                                                value="{{ $user->street_address }}"
                                                aria-describedby="validationServer03Feedback">
                                            @error('street_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        {{-- city  --}}
                                        <div class="col-sm-3">
                                            <label for="validationServer03" class="form-label">
                                                <h6>City</h6>
                                            </label>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                class="form-control  @error('city') is-invalid @enderror" name="city"
                                                value="{{ $user->city }}" id="validationServer03"
                                                aria-describedby="validationServer03Feedback">
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        {{-- city  --}}
                                        <div class="col-sm-3">
                                            <label for="validationServer05" class="form-label">
                                                <h6>Zip</h6>
                                            </label>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                class="form-control  @error('postal_code') is-invalid @enderror"
                                                name="postal_code" id="validationServer05"
                                                value="{{ $user->postal_code }}"
                                                aria-describedby="validationServer05Feedback">
                                            <div id="validationServer05Feedback" class="invalid-feedback">Please provide a
                                                valid zip.</div>
                                            @error('postal_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>





                                    {{-- --------------- --}}

                                    <div class="row mb-5">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Photo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" class="form-control" id="image" name='photo'
                                                accept="image/*" />
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img src="{{ !empty($user->photo_profile) ? url("upload/vendor.photo/$user->photo_profile") : url('upload/user.png') }}"
                                                id="showImage" alt="avatar" style="width:100px;height:100px"
                                                class="rounded-circle p-1 bg-dark">
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="password"
                                                class="form-control  @error('errorPassword') is-invalid @enderror "
                                                name="password" oncopy="return false;" onpaste="return false;"
                                                required />
                                            @error('errorPassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-outline-success px-4"
                                                value="Save Changes" />
                                        </div>
                                    </div>
                                </form>
                                {{-- end Form  --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imageInput = document.getElementById('image');

            imageInput.addEventListener('change', function(event) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var showImage = document.getElementById('showImage');
                    showImage.src = event.target.result;
                };

                reader.readAsDataURL(event.target.files[0]);
            });
        });
    </script>
@endpush
