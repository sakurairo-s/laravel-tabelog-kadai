@extends('layouts.app') 

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
    <script>
        flatpickr("#reservation_date", {
            locale: "ja",
            dateFormat: "Y-m-d",
            minDate: "today"
        });
    </script>
@endpush

@section('content')
<div class="container nagoyameshi-container pb-5">
    <div class="row justify-content-center">
        <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10">

            <nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('shops.index') }}">店舗一覧</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shops.show', $shop) }}">店舗詳細</a></li>
                    <li class="breadcrumb-item active" aria-current="page">予約</li>
                </ol>
            </nav>

            <h1 class="mb-2 text-center">{{ $shop->name }}</h1>
            <p class="text-center">
                <span class="nagoyameshi-star-rating me-1" data-rate="{{ round($shop->reviews->avg('score') * 2) / 2 }}"></span>
                {{ number_format(round($shop->reviews->avg('score'), 2), 2) }}（{{ $shop->reviews->count() }}件）
            </p>

            @if (session('flash_message'))
                <div class="alert alert-info" role="alert">
                    <p class="mb-0">{{ session('flash_message') }}</p>
                </div>
            @endif
            <hr>
                <h2 class="mb-3 text-left">予約メニュー</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('shops.reservations.store', $shop) }}">
                @csrf

                <input type="hidden" name="shop_id" value="{{ $shop->id }}">


                {{-- 予約日 --}}
                <div class="form-group row mb-3">
                    <label for="reservation_date" class="col-md-5 col-form-label text-md-left fw-bold">予約日</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="reservation_date" name="reservation_date" value="{{ old('reservation_date') }}">
                    </div>
                </div>

                {{-- 予約時間 --}}
                <div class="form-group row mb-3">
                    <label for="reservation_time" class="col-md-5 col-form-label text-md-left fw-bold">時間</label>
                    <div class="col-md-7">
                        <select class="form-control form-select" id="reservation_time" name="reservation_time">
                            <option value="" hidden>選択してください</option>
@php
    $start = strtotime($shop->business_hour_start ?? '00:00:00');
    $end = strtotime($shop->business_hour_end ?? '00:00:00');
@endphp

@if ($start !== false && $end !== false)
    @if ($end > $start)
        {{-- 通常の同日営業（例: 10:00～22:00） --}}
        @for ($time = $start; $time < $end; $time += 1800)
            @php $reservation_time = date('H:i', $time); @endphp
            <option value="{{ $reservation_time }}" {{ old('reservation_time') == $reservation_time ? 'selected' : '' }}>
                {{ $reservation_time }}
            </option>
        @endfor
    @else
        {{-- 深夜またぎ営業（例: 22:00～02:00） --}}
        @for ($time = $start; $time < strtotime('24:00:00'); $time += 1800)
            @php $reservation_time = date('H:i', $time); @endphp
            <option value="{{ $reservation_time }}" {{ old('reservation_time') == $reservation_time ? 'selected' : '' }}>
                {{ $reservation_time }}
            </option>
        @endfor
        @for ($time = strtotime('00:00:00'); $time < $end; $time += 1800)
            @php $reservation_time = date('H:i', $time); @endphp
            <option value="{{ $reservation_time }}" {{ old('reservation_time') == $reservation_time ? 'selected' : '' }}>
                {{ $reservation_time }}
            </option>
        @endfor
    @endif
@else
    <option disabled>店舗の営業時間が未登録です</option>
@endif
                        </select>
                    </div>
                </div>

                {{-- 人数 --}}
                <div class="form-group row mb-4">
                    <label for="number_of_people" class="col-md-5 col-form-label text-md-left fw-bold">人数</label>
                    <div class="col-md-7">
                        <select class="form-select" id="number_of_people" name="number_of_people">
                            <option value="" hidden>選択してください</option>
                            @for ($i = 1; $i <= 50; $i++)
                                <option value="{{ $i }}" {{ old('number_of_people') == $i ? 'selected' : '' }}>{{ $i }}名</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group d-flex justify-content-center mb-4">
                    <button type="submit" class="btn text-white shadow-sm w-50 nagoyameshi-btn">予約する</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
