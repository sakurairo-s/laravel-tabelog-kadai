@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="w-75">
        <nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('shops.index') }}">ホーム</a> > <a href="{{ route('mypage') }}">マイページ</a></li>
                <li class="breadcrumb-item active" aria-current="page">お気に入り一覧</li>
            </ol>
        </nav>
        
        <h1>お気に入り一覧</h1>

        <hr>

        @foreach ($favorite_shops as $favorite_shop)
        <div class="row mb-3">
            <div class="col-md-9 d-flex">
                <a href="{{ route('shops.show', $favorite_shop->id) }}" class="me-3" style="width: 120px;">
                    @if ($favorite_shop->image !== "")
                        <img src="{{ asset($favorite_shop->image) }}" class="img-thumbnail" style="width: 100%;">
                    @else
                        <img src="{{ asset('img/hitumabusi.jpg')}}" class="img-thumbnail" style="width: 100%;">
                    @endif
                </a>
                <div>
                    <div class="d-flex justify-content-center align-items-center w-100" style="height: 100%;">
                    <h5 class="nagoyameshi-favorite-item-text">{{ $favorite_shop->name }}</h5>
                    <!-- <h6 class="nagoyameshi-favorite-item-text">&yen;{{ $favorite_shop->price_min }}</h6> -->
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-center justify-content-end">
                <a href="{{ route('favorites.destroy', $favorite_shop->id) }}" class="nagoyameshi-favorite-item-delete"
                   onclick="event.preventDefault(); document.getElementById('favorites-destroy-form{{$favorite_shop->id}}').submit();">
                    解除
                </a>
                <form id="favorites-destroy-form{{$favorite_shop->id}}" action="{{ route('favorites.destroy', $favorite_shop->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
        @endforeach

        <hr>
    </div>
</div>
@endsection
