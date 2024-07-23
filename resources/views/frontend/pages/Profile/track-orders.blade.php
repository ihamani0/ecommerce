@extends('frontend.pages.account')

@section('account')

    {{--track-orders--}}
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Orders tracking</h3>
            </div>
            <div class="card-body contact-from-area">
                <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                <div class="row">
                    <div class="col-lg-8">
                        <form action="{{route(\App\Constants\Constants::USER_ACCOUNT_Submit_Track_Orders)}}" method="POST">
                            @csrf
                            <div class="input-style mb-20">
                                <label for="order-id">Order Number</label>
                                <input id="order-id"  name="order_number" placeholder="Found in your order " type="text" />
                            </div>
                            <button class="submit submit-auto-width" type="submit">Find</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        $("#track-orders-tab").addClass('active');
    </script>

    <script>

    </script>
@endpush
