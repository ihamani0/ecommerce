@extends("backend.admin.layout.master")

@section("title")
    Role | Add
@endsection


@section("admin")
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route(Constants::Admin_DASHBOARD)}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{route(\App\Constants\Constants::Admin_Role_Index)}}">Role List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Role Add</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        {{--Table Data--}}
        <div class="card">
            <div class="card-body">
                <div class="form-body mt-4">
                    <form  id="myForm" method="post" action="{{route(App\Constants\Constants::Admin_Role_Store)}}"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3 form-group" >
                                    <label for="inputProductTitle" class="form-label">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="inputProductTitle" placeholder="Enter product title" required>
                                </div>
                                <div class=" mb-3 text-secondary">
                                    <input type="submit" class="btn btn-outline-success px-4" value="Add Role" />
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    </div>
@endsection
