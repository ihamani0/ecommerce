@extends("backend.admin.layout.master")

@section("title")
    Admins | List
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
                        <li class="breadcrumb-item active" aria-current="page">Admins List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a  href="{{route(App\Constants\Constants::Admin_Register_Admin_ADD)}}" type="button" class="btn btn-outline-danger">Add New Admin</a>
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
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Name</th>

                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Activity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Admins as  $admin)
                            <tr>

                                <td> {{ $loop->iteration }} </td>
                                <td>
                                    @if($admin->photo_profile)
                                        <img class="smallImg cursor-pointer rounded-2"
                                             src="{{  \Illuminate\Support\Facades\Storage::url($admin->photo_profile) }}"
                                             style="width: 70px; height:40px;" alt="Image" >
                                    @else
                                        <img class="smallImg cursor-pointer rounded-2"
                                             src="{{  \Illuminate\Support\Facades\Storage::url('/upload/no-image.svg') }}"
                                             style="width: 70px; height:40px;" alt="Image" >
                                    @endif
                                </td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->phone_number }}</td>
                                <td>
                                    @foreach($admin->getRoleNames() as $role)
                                        <span class="badge rounded-2 p-2 bg-primary text-light" >
                                             {{ $role }}
                                        </span>
                                    @endforeach

                                </td>
                                <td>
                                    @if($admin->status)
                                        <span class="badge rounded-1 p-1 bg-success text-light">enable</span>
                                    @else
                                        <span class="badge rounded-1 p-1 bg-danger text-light">disable</span>
                                    @endif
                                </td>

                                <td>
                                    @if($admin->isOnline())
                                        <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>
                                            Online
                                        </div>
                                    @else
                                        <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>
                                            Offline
                                        </div>
                                    @endif
                                </td>

                                <td>{{--Action--}}

                                    {{--change status--}}
                                    <form class="d-inline" method="POST" action="{{route(\App\Constants\Constants::Admin_Register_Admin_Change_Status)}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{$admin->id}}">
                                        <button type="submit"  @if($admin->status) class="btn btn-outline-danger" title="pause-admin" @else class="btn btn-outline-success" title="enable-admin" @endif  >
                                            <i class="fa-duotone fa-play-pause"></i></button></form>
                                    {{--Edit Admins--}}

                                    <a href="{{route(App\Constants\Constants::Admin_Register_Admin_Edit , $admin->id)}}" class="btn btn-outline-secondary" title="edit">
                                        <i class="fa-duotone fa-pen"></i>
                                    </a>

                                    {{--delete user--}}
                                    <form class="d-inline" method="POST" action="{{route(\App\Constants\Constants::Admin_Register_Admin_Delete)}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$admin->id}}">
                                        <button type="submit"  class="btn btn-outline-danger" title="delete"  >
                                            <i class="fa-duotone fa-trash-alt-slash"></i></button></form>
                                    {{--Edit--}}
                                </td>

                            </tr>
                        @endforeach



                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Name</th>

                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Activity</th>
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
