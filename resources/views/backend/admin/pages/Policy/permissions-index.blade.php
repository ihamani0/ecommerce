@extends("backend.admin.layout.master")

@section("title")
    Permissions | List
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
                        <li class="breadcrumb-item active" aria-current="page">Permissions List</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <a  href="{{route(App\Constants\Constants::Admin_Permission_Add)}}" type="button" class="btn btn-outline-secondary">Add Permission</a>
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
                            <th>Permission Name </th>
                            <th>Group Name </th>
                            <th>Guard Name </th>

                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Permissions as  $permissions)
                            <tr>

                                <td> {{ $loop->iteration }} </td>

                                <td>{{ $permissions->name }}</td>
                                <td class="fw-bold text-secondary">{{ strtoupper($permissions->group) }}</td>
                                <td>{{ strtoupper($permissions->guard_name) }}</td>


                                <td>

                                    <a href="{{route(\App\Constants\Constants::Admin_Permission_Edit , $permissions->id)}}" class="btn btn-outline-secondary" >
                                        <i class="fa-duotone fa-pen-nib"></i></a>

                                    <form class="d-inline" method="POST" action="{{route(\App\Constants\Constants::Admin_Permission_Destroy)}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$permissions->id}}">
                                    <button type="submit"  class="btn btn-outline-danger" id="danger">
                                        <i class="fa-duotone fa-trash-can"></i></button></form>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Num</th>
                            <th>Permission Name </th>
                            <th>Group Name </th>
                            <th>Guard Name </th>
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
