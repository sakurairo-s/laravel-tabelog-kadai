@extends('layouts.app')

@section('content')
<div class="container">
   <h1>新しい店舗を追加</h1>

   <form action="{{ route('shops.store') }}" method="POST">
       @csrf
       <div class="form-group">
           <label for="shop-name">商品名</label>
           <input type="text" name="name" id="shop-name" class="form-control">
       </div>
       <div class="form-group">
           <label for="shop-description">商品説明</label>
           <textarea name="description" id="shop-description" class="form-control"></textarea>
       </div>
       <div class="form-group">
           <label for="shop-price">最小価格</label>
           <input type="number" name="price_min" id="shop-price" class="form-control">
       </div>
       <div class="form-group">
           <label for="shop-price">最大価格</label>
           <input type="number" name="price_max" id="shop-price" class="form-control">
       </div>
        <div class="form-group">
           <label for="business-hour">営業時間（開店）</label>
           <input type="time" name="business_hour_start" id="business-hour" class="form-control">
       </div>
        <div class="form-group">
           <label for="business-hour">営業時間（閉店）</label>
           <input type="time" name="business_hour_end" id="business-hour" class="form-control">
       </div>
        <div class="form-group">
           <label for="postal-code">郵便番号</label>
           <input type="text" name="posstal_code" id="postal-code" class="form-control">
       </div>
        <div class="form-group">
           <label for="holiday">定休日</label>
           <input type="text" name="holiday" id="holiday" class="form-control">
       </div>
        <div class="form-group">
           <label for="address">住所</label>
           <input type="text" name="address" id="address" class="form-control">
        </div>
        <div class="form-group">
           <label for="shop-phonenumber">電話番号</label>
           <input type="text" name="phone_number" id="shop-phonenumber" class="form-control">
       </div>
       <div class="form-group">
           <label for="shop-category">カテゴリ</label>
           <select name="category_id" class="form-control" id="shop-category">
               @foreach ($categories as $category)
                   <option value="{{ $category->id }}">{{ $category->name }}</option>
               @endforeach
           </select>
       </div>
       <button type="submit" class="btn btn-success">商品を登録</button>
   </form>

   <a href="{{ route('shops.index') }}">商品一覧に戻る</a>
</div>
@endsection