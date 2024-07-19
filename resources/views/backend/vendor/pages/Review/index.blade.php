@extends("backend.vendor.layout.master")

@section("title")
    Review | List
@endsection


@section("vendor")
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route(\App\Constants\Constants::VENDOR_DASHBOARD)}}"><i class="fa-duotone fa-home-lg-alt fa-xs"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Review List</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    {{--Table Data--}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="MyTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name User</th>
                        <th>Comment</th>
                        <th>Rating</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Reviews as $review)
                        <tr>

                            <td> {{ $loop->iteration }} </td>
                            <td>{{ $review->user->username }}</td>
                            <td>{{ $review->comment}}</td>
                            <td>
                                @switch($review->rating)
                                    @case('1')  <div class="cursor-pointer"><i class="bx bxs-star text-warning"></i><i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i><i class="bx bxs-star text-secondary"></i><i class="bx bxs-star text-secondary"></i></div> @break
                                    @case('2')<div class="cursor-pointer"><i class="bx bxs-star text-warning"></i><i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-secondary"></i><i class="bx bxs-star text-secondary"></i><i class="bx bxs-star text-secondary"></i></div> @break
                                    @case('3')<div class="cursor-pointer"><i class="bx bxs-star text-warning"></i><i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i><i class="bx bxs-star text-secondary"></i><i class="bx bxs-star text-secondary"></i></div> @break
                                    @case('4') <div class="cursor-pointer"><i class="bx bxs-star text-warning"></i><i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i><i class="bx bxs-star text-warning"></i><i class="bx bxs-star text-secondary"></i></div> @break
                                    @case('5') <div class="cursor-pointer"><i class="bx bxs-star text-warning"></i><i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i><i class="bx bxs-star text-warning"></i><i class="bx bxs-star text-warning"></i></div> @break
                                @endswitch
                            </td>
                            <td onclick="showImg(this)"  class="cursor-pointer" data-src="{{\Illuminate\Support\Facades\Storage::url($review->product->product_thumbnail)}}">
                                {{ $review->product->product_name}}</td>
                            <td> @if($review->status)
                                    <span class="badge bg-success text-light">active</span>
                                @else
                                    <span class="badge bg-danger text-light">inactive</span>
                                @endif</td>
                            <td>
                                <a  href="{{route(App\Constants\Constants::Vendor_Review_Approve, $review->id)}}" class="btn btn-outline-secondary" title="approve" id="approve"><i class="fa-duotone fa-comment"></i></a>
                            </td>

                        </tr>
                    @endforeach



                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name User</th>
                        <th>Comment</th>
                        <th>Rating</th>
                        <th>Products</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
    {{--End table--}}
</div>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body text-center">
                <img id="largeImage" src="" alt="Large Image" style="width: 160px; height: 160px;">
            </div>
        </div>
    </div>
</div>




@endsection

@push('script')
    <script>
        $(function(){
            $(document).on('click','#approve',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Approve This Comment?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Approve!',
                            'Your Comment has been Approved.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>

    {{--Pop up a image in real size--}}
    <script>
        $(document).ready(function() {
            $('#productImg').on('click', function() {
                let src = $(this).data('src')
                $('#largeImage').attr('src', src);
                $('#imageModal').modal('show');
            });
        });

        function showImg(element){
            let src = element.getAttribute('data-src');
            $('#largeImage').attr('src', src);
            $('#imageModal').modal('show');
        }
    </script>
@endpush
