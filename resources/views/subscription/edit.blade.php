@extends('layouts.app')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = @json(config('cashier.key'));
    </script>
    <script src="{{ asset('js/stripe.js') }}"></script>
@endpush

@section('content')
<div class="container nagoyameshi-container pb-5">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <nav class="my-3" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('shops.index') }}">ホーム</a></li>
                    <li class="breadcrumb-item active" aria-current="page">お支払い方法変更</li>
                </ol>
            </nav>

            <h1 class="mb-3 text-center">お支払い方法の変更</h1>

            <div class="card mb-4">
                <div class="card-header text-center">現在のカード情報</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">カード種別：{{ $user->pm_type ?? '不明' }}</li>
                    <li class="list-group-item">カード名義人：{{ $user->defaultPaymentMethod()->billing_details->name ?? '不明' }}</li>
                    <li class="list-group-item">カード番号：**** **** **** {{ $user->pm_last_four ?? '****' }}</li>
                </ul>
            </div>

            <hr class="mb-4">

            <div class="alert alert-danger" id="card-error" style="display: none;">
                <ul class="mb-0" id="error-list"></ul>
            </div>

            <form id="card-form" action="{{ route('subscription.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <input class="form-control mb-3" id="card-holder-name" type="text" placeholder="カード名義人" required>

                {{-- Stripeカード入力欄 --}}
                <div id="card-element" class="mb-4" style="
                    background-color: white;
                    padding: 12px;
                    border: 1px solid #ced4da;
                    border-radius: 5px;
                    min-height: 44px;
                "></div>

                <div class="d-flex justify-content-center">
                    <button type="button" class="btn nagoyameshi-btn shadow-sm w-50 text-white" id="card-button" data-secret="{{ $intent->client_secret }}">
                        変更
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
