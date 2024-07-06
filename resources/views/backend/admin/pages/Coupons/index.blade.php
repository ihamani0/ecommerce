@extends("backend.admin.layout.master")

@section("title")
    Coupon | List
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
                    <li class="breadcrumb-item active" aria-current="page">Coupons List</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <a  href="{{route(App\Constants\Constants::Admin_Coupon_ADD)}}" type="button" class="btn btn-outline-primary">Add Coupon</a>
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
                        <th>Num</th>
                        <th>Coupon Name</th>
                        <th>Coupon Discount</th>
                        <th>Coupon Validate</th>
                        <th>Coupon status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as   $item)
                        <tr>

                            <td> {{ $loop->iteration }} </td>
                            <td>{{ $item->coupon_name }}</td>
                            <td>{{ $item->coupon_discount }}</td>
                            <td>{{ $item->coupon_validate }}</td>
                            <td>
                                @if($item->status)
                                    <span class="badge bg-success">active</span>
                                @else
                                    <span class="badge bg-danger">inactive</span>
                                @endif

                            </td>
                            <td>

                                @if(!$item->status)
                                    <a href="{{route(\App\Constants\Constants::Admin_Coupon_STATUS,$item->coupon_uuid)}}"   class="btn btn-outline-success" id="confirmBtn"><i class="fa-duotone fa-badge-check"></i>
                                    </a>
                                @else
                                    <a href="{{route(\App\Constants\Constants::Admin_Coupon_STATUS,$item->coupon_uuid)}}"  type="button" class="btn btn-outline-warning" id="confirmBtn"><i class="fa-solid fa-circle-xmark"></i>
                                    </a>
                                @endif

                                    <a  href="{{route(\App\Constants\Constants::Admin_Coupon_EDIT,$item->coupon_uuid)}}" class="btn btn-outline-secondary" id="edit"><i class="bx bx-pen me-0"></i></a>
                                    <a href="{{route(\App\Constants\Constants::Admin_Coupon_DESTORY,$item->coupon_uuid)}}"  type="button" class="btn btn-outline-danger" id="deleteBtn"><i class="bx bx-trash me-0"></i>
                                    </a>

                            </td>

                        </tr>
                    @endforeach



                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Num</th>
                        <th>Coupon Name</th>
                        <th>Coupon Discount</th>
                        <th>Coupon Validate</th>
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

@push('script')
    <script>
        $(function(){
            $(document).on('click','#deleteBtn',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })


            });

        });
    </script>
@endpush
