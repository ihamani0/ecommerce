@extends("backend.admin.layout.master")

@section("title")
    Vendors | List
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
                        <li class="breadcrumb-item active" aria-current="page">Vendors List</li>
                    </ol>
                </nav>
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
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Activity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Vendors as  $vendor)
                            <tr>

                                <td> {{ $loop->iteration }} </td>
                                <td>
                                    @if($vendor->photo_profile)
                                        <img class="smallImg cursor-pointer rounded-2"
                                             src="{{  \Illuminate\Support\Facades\Storage::url($vendor->photo_profile) }}"
                                             style="width: 70px; height:40px;" alt="Image" >
                                    @else
                                        <img class="smallImg cursor-pointer rounded-2"
                                             src="{{  \Illuminate\Support\Facades\Storage::url('/upload/no-image.svg') }}"
                                             style="width: 70px; height:40px;" alt="Image" >
                                    @endif
                                </td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->username }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>{{ $vendor->phone_number }}</td>
                                <td>
                                    @if($vendor->status)
                                        <span class="badge bg-success text-light">Active</span>
                                    @else
                                        <span class="badge bg-danger text-light">InActive</span>
                                    @endif
                                </td>

                                <td>
                                    @if($vendor->isOnline())
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

                                <td>{{--Action--}}</td>

                            </tr>
                        @endforeach



                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
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
