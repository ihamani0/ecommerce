
@extends('frontend.pages.account')

@section('account')

    {{--Delete Account--}}
    <div>
        <div class="card">

            <div class="card-header">
                <h3 class="mb-0"><i class="fi-rs-trash"></i> Delete Account</h3>
            </div>

            <div class="card-body contact-from-area">

                <div class="row">
                    <div class="col-lg-8">

                        <form class="contact-form-style mt-30 mb-50" action="{{route(Constants::USER_ACCOUNT_DELETE)}}" method="post">



                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-12">
                                <label>Password <span class="required text-danger">*</span></label>
                                <input name="password"   class="form-control" type="password" />
                            </div>

                            <button class="submit submit-auto-width" style="background-color: #d92129" type="submit">Delete</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        $("#delete-account-tab").addClass('active');
    </script>
@endpush
