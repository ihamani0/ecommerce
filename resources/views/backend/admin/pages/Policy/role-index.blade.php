@extends("backend.admin.layout.master")

@section("title")
    Role | List
@endsection


@section("admin")
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route(Constants::Admin_DASHBOARD)}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Role List</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <a  href="{{route(App\Constants\Constants::Admin_Role_Add)}}" type="button" class="btn btn-outline-secondary">Add Role</a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->

        {{--Table Data--}}
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <td>Num</td>
                            <th>Role Name </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Roles as  $role)
                            <tr>

                                <td> {{ $loop->iteration }} </td>

                                <td class="fw-bold text-secondary">{{ $role->name }}</td>
                                <td>

                                    <a href="{{route(\App\Constants\Constants::Admin_Role_Edit , $role->id)}}" class="btn btn-outline-secondary" >
                                        <i class="fa-duotone fa-pen-nib"></i></a>

                                    <form class="d-inline" method="POST" action="{{route(\App\Constants\Constants::Admin_Role_Destroy)}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$role->id}}">
                                        <button type="submit"  class="btn btn-outline-danger" id="danger">
                                            <i class="fa-duotone fa-trash-can"></i></button></form>

                                    <a href="{{route(\App\Constants\Constants::Admin_Permission_To_Role , $role->id)}}" class="btn btn-outline-success" title="add role to permission" >
                                        <i class="fa-duotone fa-book-law"></i></a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Num</td>
                            <th>Role Name </th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        {{--End table--}}
    </div>
@endsection
