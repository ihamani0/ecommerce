@extends("backend.admin.layout.master")

@section("title")
    Role | Add Permission To Role
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
                        <li class="breadcrumb-item active" aria-current="page">Add Permission To Role</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        {{--Table Data--}}
        <div class="card">
            <div class="card-body">
                <div class="form-body mt-4">
                    <form  id="myForm" method="post" action="{{route(App\Constants\Constants::Admin_Update_Permission_To_Role)}}"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$role->id}}" >
                        <div class="row mb-3 d-flex justify-content-between">
                            <div class="col-lg-6">
                                <div class="mb-3 form-group" >
                                    <label for="inputProductTitle" class="form-label">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="inputProductTitle" value="{{$role->name}}" placeholder="Enter product title" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 ">
                                <div class=" mb-3 text-secondary">
                                    <input type="submit" class="btn btn-outline-success px-4" value="Add Permission To Role" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3 ">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <div class="form-check m-2">
                                                    <label class="form-check-label text-secondary" for="selectAll">
                                                        Select All
                                                    </label>
                                                    <input type="checkbox" id="selectAll">
                                                </div>
                                            </div>
                                        </div>
                                        @foreach($permissionsGroup as $key => $groups)
                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <span class="text-secondary fw-bold">{{$key}}</span>
                                                </div>
                                                <div class="col-lg-9">
                                                    @foreach($groups as $permission)
                                                        <div class="form-check m-2">
                                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   id="permission{{ $permission->id }}"
                                                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>

                                                            <label class="form-check-label" for="permission{{ $permission->id }}">
                                                                {{$permission->name}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('script')
    <script>
        $("#selectAll").on('click' , function(){
            if($(this).is(':checked')){
                $('input[type = checkbox]').prop('checked',true);
            }else{
                $('input[type = checkbox]').prop('checked',false);
            }
        });
    </script>
@endpush
