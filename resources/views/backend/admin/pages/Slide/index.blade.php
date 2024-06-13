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
                        <th>Num</th>
                        <th>Title</th>
                        <th>Text</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Slides as  $key => $item)
                        <tr>

                            <td> {{ $loop->iteration }} </td>
                            <td>{{ $item->slide_title }}</td>
                            <td>{{ $item->slide_text }}</td>
                            <td> <img class="smallImg cursor-pointer rounded-2" src="{{  Storage::url($item->slide_image) }}" style="width: 70px; height:40px;" alt="Image" >  </td>
                            <td>
                                <a  href="{{route(\App\Constants\Constants::Admin_Slide_EDIT,$item->slide_uuid)}}" class="btn btn-outline-secondary" id="edit"><i class="bx bx-pen me-0"></i></a>
                                <a href="{{route(Constants::Admin_Slide_DESTORY,$item->slide_uuid)}}"  type="button" class="btn btn-outline-danger" id="deleteBtn"><i class="bx bx-trash me-0"></i>
                                </a>

                            </td>

                        </tr>
                    @endforeach



                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Num</th>
                        <th>Title</th>
                        <th>text</th>
                        <th>Image</th>
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
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body text-center">
                <img id="largeImage" src="" alt="Large Image" style="width: 1376px; height: 507px;">
            </div>
        </div>
    </div>
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

    {{--Pop up a image in real size--}}
    <script>
        $(document).ready(function() {
            $('.smallImg').on('click', function() {
                let src = $(this).attr('src');
                $('#largeImage').attr('src', src);
                $('#imageModal').modal('show');
            });
        });
    </script>
@endpush
