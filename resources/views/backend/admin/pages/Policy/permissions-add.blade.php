@extends("backend.admin.layout.master")

@section("title")
    Permissions | Add
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
                            <a href="{{route(\App\Constants\Constants::Admin_Permission_Index)}}">Permissions List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Permissions Add</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        {{--Table Data--}}
        <div class="card">
            <div class="card-body">
                <div class="form-body mt-4">
                    <form  id="myForm" method="post" action="{{route(App\Constants\Constants::Admin_Permission_Store)}}"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3 form-group" >
                                    <label for="inputProductTitle" class="form-label">Permission Name <span class="text-danger">*</span> <span class="text-secondary fw-light">
                                            (add banner , view banner , edit banner , delete banner)
                                        </span></label>
                                    <input type="text" class="form-control" name="name" id="inputProductTitle" placeholder="Enter product title" required>
                                </div>

                                    <div class="form-group text-secondary">
                                        <select name="group" class="form-select mb-3" aria-label="Default select ">
                                            <option disabled selected="">Open this select Group</option>
                                            <option value="dashboard">Dashboard</option>
                                            <option value="brand">Brand</option>
                                            <option value="category">Category</option>
                                            <option value="subcategory">Subcategory</option>
                                            <option value="product">Product</option>
                                            <option value="stock">Stock</option>
                                            <option value="coupon">Coupon</option>
                                            <option value="vendor">Vendor</option>
                                            <option value="order">Order</option>
                                            <option value="user-management">User Management</option>
                                            <option value="permissions">Permissions</option>
                                            <option value="role">Role</option>
                                            <option value="review">Review</option>
                                            <option value="report">Report</option>
                                            <option value="slider">Slider</option>
                                            <option value="banner">Banner</option>
                                            <option value="config">Config</option>
                                        </select>
                                    </div>

                                <div class=" mb-3 text-secondary">
                                    <input type="submit" class="btn btn-outline-success px-4" value="Add Permission" />
                                </div>
                            </div>


                            </div>
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
