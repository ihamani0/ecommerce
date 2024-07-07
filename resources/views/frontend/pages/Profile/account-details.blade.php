@extends('frontend.pages.account')

@section('account')
    {{--Account Details--}}

    <div>
        <div class="card">
            <div class="card-header">
                <h5>Account Details</h5>
            </div>
            <div class="card-body">

                <form method="post" name="enq" action="{{route(Constants::USER_ACCOUNT_UPDATE)}}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name <span class="required">*</span></label>
                            <input required="" class="form-control" name="name" type="text" value="{{auth()->user()->name}}"/>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Email Address <span class="required">*</span></label>
                            <input class="form-control" name="email" type="email" value="{{auth()->user()->email}}" />

                        </div>

                        <div class="form-group col-md-12">
                            <label>Phone Number <span class="required">*</span></label>
                            <input required="" class="form-control" name="phone_number" type="text" value="{{auth()->user()->phone_number}}" />
                        </div>

                        <div class="form-group col-md-12">
                            <label>Address <span class="required">*</span></label>
                            <input required="" class="form-control" name="street_address" type="text" value="{{auth()->user()->street_address}}" />
                        </div>

                        <div class="form-group col-md-6">
                            <label>City: <span class="required">*</span></label>
                            <input required="" class="form-control" name="city" type="text" value="{{auth()->user()->city}}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Postal code: <span class="required">*</span></label>
                            <input required="" class="form-control" name="postal_code" type="text" value="{{auth()->user()->postal_code}}" />
                        </div>



                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit">Save Change</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection
@push('script')
    <script>
        $("#account-detail-tab").addClass('active');
    </script>
@endpush
