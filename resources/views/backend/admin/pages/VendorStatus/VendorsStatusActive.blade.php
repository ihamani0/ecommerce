@extends("backend.admin.layout.master")

@section("title")
    Vendors Status | List
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
                    <li class="breadcrumb-item active" aria-current="page">Vendors Status Active</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div >
        <div class="card">
            <div class="card-body">
                <div class="table-responsive"  >
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Num Active</th>
                            <th>Shop Name</th>
                            <th>Create At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vendors as  $key => $item)
                            <tr>

                                <td> {{ $key+1 }} </td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->created_at?->format("Y-m-d") }}</td>
                                <td><span class="badge bg-success">active</span></td>
                                <td>
                                    <a href=""   class="btn btn-outline-primary">info
                                    </a>
                                    <a href=""  type="button" class="btn btn-outline-danger" id="disablebtn">inactive
                                    </a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Num Active</th>
                            <th>Shop Name</th>
                            <th>Create At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('script')
    <script>
        $(function(){
            $(document).on('click','#disableBtn',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Disable This Vendor?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Disable it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Disable!',
                            'Your Vendor has been Disable it.',
                            'success'
                        )
                    }
                })


            });

        });
    </script>
@endpush


