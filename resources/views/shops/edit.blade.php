@extends('layouts.app')

@section('content')
<div class="container">
   <h1>店舗情報更新</h1>

   <form action="{{ route('shops.update',$shop->id) }}" method="POST">
       @csrf
       @method('PUT')
       <div class="form-group">
           <label for="shop-name">店名</label>
           <input type="text" name="name" id="shop-name" class="form-control" value="{{ $shop->name }}">
       </div>
       <div class="form-group">
           <label for="shop-description">店舗説明</label>
            <textarea name="description" id="shop-description" class="form-control">{{ old('description', $shop->description) }}</textarea>
        </div>
       <div class="form-group">
           <label for="shop-price">最小価格</label>
            <input type="number" name="price_min" id="shop-price" class="form-control" value="{{ old('price_min', $shop->price_min) }}">
       </div>
       <div class="form-group">
           <label for="shop-price">最大価格</label>
            <input type="number" name="price_max" id="shop-price" class="form-control" value="{{ old('price_max', $shop->price_max) }}">
       </div>
        <div class="form-group">
           <label for="business-hour">営業時間（開店）</label>
            <input type="time" name="business_hour_start" id="business-hour" class="form-control" value="{{ old('business_hour_start', $shop->business_hour_start) }}">
       </div>
        <div class="form-group">
           <label for="business-hour">営業時間（閉店）</label>
            <input type="time" name="business_hour_end" id="business-hour" class="form-control" value="{{ old('business_hour_end', $shop->business_hour_end) }}">
       </div>
        <div class="form-group">
           <label for="postal-code">郵便番号</label>
            <input type="text" name="postal_code" id="postal-code" class="form-control" value="{{ old('postal_code', $shop->postal_code) }}">
        <div class="form-group">
           <label for="holiday">定休日</label>
            <input type="text" name="holiday" id="holiday" class="form-control" value="{{ old('holiday', $shop->holiday) }}">
       </div>
        <div class="form-group">
           <label for="address">住所</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $shop->address) }}">
       </div>
        </div>
        <div class="form-group">
           <label for="shop-phonenumber">電話番号</label>
            <input type="text" name="phone_number" id="shop-phonenumber" class="form-control" value="{{ old('phone_number', $shop->phone_number) }}">
       </div>
       <div class="form-group">
           <label for="shop-category">カテゴリ</label>
           <select name="category_id" class="form-control" id="shop-category">
               @foreach ($categories as $category)
               @if ($category->id == $shop->category_id)
               <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
               @else
               <option value="{{ $category->id }}">{{ $category->name }}</option>
               @endif
               @endforeach
           </select>
       </div>
       <button type="submit" class="btn btn-danger">更新</button>
   </form>

   <a href="{{ route('shops.index') }}">商品一覧に戻る</a>
</div>
@endsection