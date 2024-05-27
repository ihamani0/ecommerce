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
                    <li class="breadcrumb-item active" aria-current="page">Vendors Status InActive</li>
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
                                <td>{{ ($item->username)??"N/A" }}</td>
                                <td>{{ $item->created_at?->format("Y-m-d") }}</td>
                                <td><span class="badge bg-danger">inactive</span></td>
                                <td>
                                    <a href=""   data-bs-toggle="modal" data-bs-target="#details"   onclick="fetchVendorDetails({{ $item->id }})"  class="btn btn-outline-primary">info
                                    </a>
                                    <a href=""  type="button" class="btn btn-outline-success" id="disablebtn">active
                                    </a>
                                </td>

                            </tr>

                           {{-- @include('backend.admin.pages.VendorStatus.vendor-details')--}}
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


   @include('backend.admin.pages.VendorStatus.vendor-details')
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

    <script>
        function fetchVendorDetails(vendorId) {
            $(document).ready(function (){
                $.ajax({
                    url: '/admin/vendor-status/details/' + vendorId,
                    method: 'GET',
                    success: function(vendor) {

                        var modalId = '#details' + vendorId;
                        var modalBody = $('#details .modal-body table tbody');

                        var nameShopRow = $('<tr></tr>');
                        nameShopRow.append("<th>Shop Name: </th>")
                        nameShopRow.append("<td>"+ (vendor.username  || 'N/A' )+"</td>")
                        modalBody.append(nameShopRow)

                        var nameRow = $('<tr></tr>');
                        nameRow.append("<th>Name : </th>")
                        nameRow.append("<td>"+ vendor.name +"</td>")
                        modalBody.append(nameRow)


                        var emailRow = $('<tr></tr>');
                        emailRow.append("<th>Email : </th>")
                        emailRow.append("<td>"+ vendor.email +"</td>")
                        modalBody.append(emailRow)

                        var phoneRow = $('<tr></tr>');
                        phoneRow.append("<th>Phone Number: </th>")
                        phoneRow.append("<td>"+ (vendor.phone_number || 'N/A') +"</td>")
                        modalBody.append(phoneRow)

                        var streetRow = $('<tr></tr>');
                        streetRow.append("<th>Street Address: </th>")
                        streetRow.append("<td>"+ (vendor.street_address || 'N/A') +"</td>")
                        modalBody.append(streetRow)


                        var cityRow = $('<tr></tr>');
                        cityRow.append("<th>City: </th>")
                        cityRow.append("<td>"+ (vendor.city || 'N/A') +"</td>")
                        modalBody.append(cityRow)


                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching vendor details:', error);
                    }
                });
            });
            }

        // Add this event listener
        $('#details').on('hidden.bs.modal', function () {
            var modalBody = $(this).find('.modal-body table tbody');
            modalBody.empty();
        });

    </script>
@endpush


