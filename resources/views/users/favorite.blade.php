@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="w-75">
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
                    <h5 class="nagoyameshi-favorite-item-text">{{ $favorite_shop->name }}</h5>
                    <!-- <h6 class="nagoyameshi-favorite-item-text">&yen;{{ $favorite_shop->price_min }}</h6> -->
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
