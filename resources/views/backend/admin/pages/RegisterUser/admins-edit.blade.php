@extends("backend.admin.layout.master")

@section("title")
    Admin | Edit
@endsection


@section("admin")
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route(\App\Constants\Constants::Admin_DASHBOARD)}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route(\App\Constants\Constants::Admin_Register_Admin)}}">Admin List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Admin</li>
                    </ol>
                </nav>
            </div>


        </div>
        <!--end breadcrumb-->


        {{--ADD Brand--}}

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Admin</h5>
                <hr/>

                @if ($errors->any())
                    <div class="row mb-3 alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-body mt-4">
                    <form  id="myForm" method="post" action="{{route(App\Constants\Constants::Admin_Register_Admin_Update)}}"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$admin->id}}">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">

                                    <div class="mb-3 form-group" >
                                        <label for="inputProductTitle" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="inputProductTitle" value="{{$admin->name}}" placeholder="Enter Name" >
                                    </div>

                                    <div class="mb-3 form-group" >
                                        <label for="inputProductTitle" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="email" id="inputProductTitle" value="{{$admin->email}}" placeholder="Enter email" >
                                    </div>

                                    <div class="mb-3 form-group" >
                                        <label for="inputProductTitle" class="form-label">Password <span class="text-danger">not required</span></label>
                                        <input type="password" class="form-control" name="password" id="inputProductTitle" placeholder="Enter password" >
                                    </div>
                                    <div class="mb-3 form-group" >
                                        <label for="inputProductTitle" class="form-label">Confirm Password <span class="text-danger">not required</span></label>
                                        <input type="password" class="form-control" name="password_confirmation" id="inputProductTitle" placeholder=" Confirm Password her" >
                                    </div>

                                    <div class="mb-3 form-group" >
                                        <label for="role" class="form-label">Assigning Role<span class="text-danger">*</span></label>
                                        <select name="role" class="form-select" id="role">
                                            <option value="{{$roleIdBelongToUser}}">{{$roleNameBelongToUser}}</option>
                                            <option disabled>-----------</option>
                                            @foreach($Roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="mb-3 form-group" >
                                        <label for="inputProductTitle" class="form-label">Password Root<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error("password_super_admin") is-invalid @enderror "
                                               name="password_super_admin" id="inputProductTitle" placeholder=" Super Admin Password" >
                                    </div>
                                    <div class=" mb-3 text-secondary">
                                        <input type="submit" class="btn btn-outline-success px-4" value="Update" />
                                    </div>

                                </div>
                            </div>
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>


        {{--End Brand --}}
    </div>
@endsection
