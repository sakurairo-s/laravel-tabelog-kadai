@extends('layouts.app')

@section('content')
<div class="container  d-flex justify-content-center mt-3">
   <div class="w-75">
       <h1>お気に入り一覧</h1>

       <hr>

       <div class="row">
           @foreach ($favorite_shops as $favorite_shop)
               <div class="col-md-7 mt-2">
                   <div class="d-inline-flex">
                       <a href="{{ route('shops.show', $favorite_shop->id) }}" class="w-25">
                        @if ($favorite_shop->image !== "")
                        <img src="{{ asset($favorite_shop->image) }}" class="img-thumbnail">
                        @else
                        <img src="{{ asset('img/hitumabusi.jpg')}}" class="img-thumbnail">
                        @endif
                       </a>
                       <div class="container mt-3">
                           <h5 class="w-100 nagoyameshi-favorite-item-text">{{ $favorite_shop->name }}</h5>
                           <h6 class="w-100 nagoyameshi-favorite-item-text">&yen;{{ $favorite_shop->price_min }}</h6>
                       </div>
                   </div>
               </div>
               <div class="col-md-2 d-flex align-items-center justify-content-end">
                   <a href="{{ route('favorites.destroy', $favorite_shop->id) }}" class="nagoyameshi-favorite-item-delete" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form{{$favorite_shop->id}}').submit();">
                       解除
                   </a>
                   <form id="favorites-destroy-form{{$favorite_shop->id}}" action="{{ route('favorites.destroy', $favorite_shop->id) }}" method="POST" class="d-none">
                       @csrf
                       @method('DELETE')
                   </form>

           @endforeach
       </div>

       <hr>
   </div>
</div>
@endsection