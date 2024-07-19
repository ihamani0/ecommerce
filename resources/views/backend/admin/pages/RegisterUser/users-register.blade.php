@extends("backend.admin.layout.master")

@section("title")
    Slide | List
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
                        <li class="breadcrumb-item active" aria-current="page">Slide List</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <a  href="{{route(App\Constants\Constants::Admin_Slide_ADD)}}" type="button" class="btn btn-info">Add Slider</a>
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
                            <th>Name</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Activity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Users as  $user)
                            <tr>

                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $user->name }} </td>

                                <td> {{ $user->username }} </td>

                                <td> {{ $user->email }} </td>

                                <td>{{ $user->phone_number }}</td>
                                <td>
                                    @if($user->isOnline())
                                        <div class="badge rounded-pill text-success bg-light-success p-2  px-3">
                                            <i class="bx bxs-circle me-1"></i>
                                            Online
                                        </div>
                                    @else
                                        <div class="badge rounded-pill text-danger bg-light-danger p-2  px-3">
                                            <i class="bx bxs-circle me-1"></i>
                                            offline
                                        </div>
                                    @endif

                                </td>
                                <td>
                                </td>

                            </tr>
                        @endforeach



                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
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
