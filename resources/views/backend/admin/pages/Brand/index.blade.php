@extends("backend.admin.layout.master")

@section("title")
    Brand | List
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
                    <li class="breadcrumb-item active" aria-current="page">Brand List</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
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
                        <th>Name Brand</th>
                        <th>Logo</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as  $key => $item)
                        <tr>

                            <td> {{ $key+1 }} </td>
                            <td>{{ $item->brand_name }}</td>
                            <td> <img src="{{  Storage::url($item->brand_img) }}" style="width: 70px; height:40px;" alt="{{$item->slug}}" >  </td>
                            <td>
                                <a  href="{{route(\App\Constants\Constants::Admin_BRAND_EDIT,$item->uuid_brand)}}" class="btn btn-outline-secondary" id="edit"><i class="bx bx-pen me-0"></i></a>
                                <a href="{{route(Constants::Admin_BRAND_DESTORY,$item->uuid_brand)}}"  type="button" class="btn btn-outline-danger" id="deleteBtn"><i class="bx bx-trash me-0"></i>
                                </a>

                            </td>

                        </tr>
                    @endforeach



                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Num</th>
                        <th>Name Brand</th>
                        <th>Logo</th>
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
