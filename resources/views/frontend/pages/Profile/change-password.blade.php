
@extends('frontend.pages.account')

@section('account')

    {{--Change Password--}}
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Change Password</h3>
            </div>

            <div class="card-body contact-from-area">
                <div class="row">
                    <div class="col-lg-8">
                        <form class="contact-form-style mt-30 mb-50" action="{{route("password.update")}}" method="post">
                            @csrf
                            @method('PUT')
                                    <div class="form-group col-md-12">
                                        <label>Current Password <span class="required text-danger">*</span></label>
                                        <input name="current_password"   class="form-control" type="password" />
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>New Password <span class="required text-danger">*</span></label>
                                        <input name="new_password"  class="form-control"  type="password" />
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Confirm Password <span class="required text-danger">*</span></label>
                                        <input name="new_password_confirmation"  class="form-control" type="password" />
                                    </div>

                                    <button class="submit submit-auto-width" type="submit">Change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        $("#change-password-tab").addClass('active');
    </script>
@endpush

