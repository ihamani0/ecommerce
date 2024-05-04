@extends("backend.vendor.layout.master")

@section("title")
    Change-password | E-comme
@endsection

@push("style")


@endpush

@section("vendor")
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Profile</div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vendor.profile')}}">Vendor Profile</a></li>


                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    {{-- Container --}}

    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-10">
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

                            @if (session("success"))
                                <div class="row mb-3 alert alert-success">
                                    <div class="col-sm-9 text-secondary">
                                        {{  session("success") }}
                                    </div>
                                </div>
                            @endif

                            
                            {{-- Start Form  --}}
                            <form action="{{ route("vendor.profile.update.password") }}" method="post" enctype="multipart/form-data" >
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Old Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" class="form-control  @error('old_password') is-invalid @enderror "
                                        name="old_password" oncopy="return false;" onpaste="return false;"  placeholder="Old Password" required/>
                                        @error('old_password')<span class="text-danger mt-2">{{ $message }}</span>@enderror
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">New Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror"
                                        id="new_password"   placeholder="New Password" oncopy="return false;" onpaste="return false;" required/>

                                        @error('new_password')<span class="text-danger ">{{ $message }}</span>@enderror

                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Confirm New Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation"
                                        placeholder="Confirm New Password" oncopy="return false;" onpaste="return false;" required />
                                        @error('confirm_new_password')<span class="text-danger mt-2">{{ $message }}</span>@enderror
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-outline-success px-4" value="Save Changes" />
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


    {{-- end Container  --}}



    </div>
@endsection



