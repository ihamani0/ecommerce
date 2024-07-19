@extends("backend.admin.layout.master")

@section("title")
    Setting | List
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
                    </ol>
                </nav>
            </div>
            @if($Setting)
            <div class="ms-auto">
                <div class="btn-group">
                    <a  href="{{route(\App\Constants\Constants::Admin_Setting_Edite)}}" class="btn btn-outline-warning">Edit Config</a>
                    <a  href="" class="btn btn-outline-danger">Delete</a>
                </div>
            </div>
            @else
                <div class="ms-auto">
                    <div class="btn-group">
                        <a  href="{{route(\App\Constants\Constants::Admin_Setting_Add)}}" class="btn btn-outline-secondary">Add Config</a>
                    </div>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="header"><h4>Config Details</h4> </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                <tr>
                                    <th>Company Name:</th>
                                    <th>{{ $Setting->company_name }}</th>
                                </tr>
                                <tr>
                                    <th>Logo:</th>
                                    <th><img src="{{\Illuminate\Support\Facades\Storage::url($Setting->logo)}}" style="width: 80px;height: 80px"></th>
                                </tr>

                                <tr>
                                    <th>Phone Support:</th>
                                    <th>{{ $Setting->support_phone }}</th>
                                </tr>

                                <tr>
                                    <th>Address:</th>
                                    <th>{{ $Setting->address }}</th>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="header"><h4>Social Media</h4> </div>
                        <hr>
                        @foreach($Setting->social as $social)
                        <div class="table-responsive">
                            <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                <tr>
                                    <th>Name:</th>
                                    <th>{{ $social->name }}</th>
                                </tr>
                                <tr>
                                    <th>Url:</th>
                                    <th>{{ $social->url }}</th>
                                </tr>

                                <tr>
                                    <th>Logo:</th>
                                    <th><img src="{{\Illuminate\Support\Facades\Storage::url($social->logo)}}" style="width: 40px;height: 40px"  ></th>
                                </tr>
                            </table>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>

@endsection
