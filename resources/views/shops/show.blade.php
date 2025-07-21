@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
   <div class="row w-75">
       <div class="col-5 offset-1">
            @if ($shop->image !== "")
                <img src="{{ asset($shop->image) }}" class="img-thumbnail">
            @else
                <img src="{{ asset('img/hitumabusi.jpg')}}" class="img-thumbnail">
            @endif
       </div>
       <div class="col">
           <div class="d-flex flex-column">
              <p><strong>店名：</strong> {{$shop->name}}</p><hr>
              <p><strong>説明：</strong> {{$shop->description}}</p><hr>
              <p><strong>カテゴリ：</strong> {{$shop->category->name}}</p><hr>
              <p><strong>最低価格：</strong> {{$shop->price_min}}円</p><hr>
              <p><strong>最高価格：</strong> {{$shop->price_max}}円</p><hr>
              <p><strong>営業時間（開始）：</strong> {{ substr($shop->business_hour_start, 0, 5)}}</p><hr>
              <p><strong>営業時間（終了）：</strong> {{ substr($shop->business_hour_end, 0, 5)}}</p><hr>
              <p><strong>郵便番号：</strong> {{$shop->postal_code}}</p><hr>
              <p><strong>住所：</strong> {{$shop->address}}</p><hr>
              <p><strong>電話番号：</strong> {{$shop->phone_number}}</p><hr>
              <p class="d-flex align-items-end"><strong>定休日：</strong> {{$shop->holiday}}</p><hr>
           </div>

           {{-- ボタン表示 --}}
           <div class="d-flex gap-2 mt-3">
               {{-- 予約ボタン --}}
               @auth
                   @if(auth()->user()->subscribed('premium_plan'))
                       <a href="{{ route('shops.reservations.create', $shop->id) }}" class="btn btn-success flex-fill">
                           <i class="fas fa-calendar-check"></i> この店舗を予約する
                       </a>
                   @else
                       <a href="{{ route('subscription.create') }}" class="btn btn-success flex-fill">
                           <i class="fas fa-calendar-check"></i> 有料プラン登録はこちら
                       </a>
                   @endif
               @else
                   <a href="{{ route('login') }}" class="btn btn-success flex-fill">
                       <i class="fas fa-calendar-check"></i> ログインして予約
                   </a>
               @endauth

               {{-- お気に入りボタン --}}
               @auth
                   @if(auth()->user()->subscribed('premium_plan'))
                       @if(Auth::user()->favorite_shops()->where('shop_id', $shop->id)->exists())
                           <a href="{{ route('favorites.destroy', $shop->id) }}" class="btn nagoyameshi-favorite-button text-favorite flex-fill"
                              onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                               <i class="fa fa-heart"></i> お気に入り解除
                           </a>
                       @else
                           <a href="{{ route('favorites.store', $shop->id) }}" class="btn nagoyameshi-favorite-button text-favorite flex-fill"
                              onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                               <i class="fa fa-heart"></i> お気に入り
                           </a>
                       @endif
                   @else
                       <a href="{{ route('subscription.create') }}" class="btn nagoyameshi-favorite-button text-favorite flex-fill">
                           <i class="fa fa-heart"></i> お気に入り（有料会員限定）
                       </a>
                   @endif
               @else
                   <a href="{{ route('login') }}" class="btn nagoyameshi-favorite-button text-favorite flex-fill">
                       <i class="fa fa-heart"></i> ログインしてお気に入り登録
                   </a>
               @endauth
           </div>

           {{-- フォーム（有料会員だけが使う） --}}
           @auth
               @if(auth()->user()->subscribed('premium_plan'))
                   <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $shop->id) }}" method="POST" class="d-none">
                       @csrf
                       @method('DELETE')
                   </form>
                   <form id="favorites-store-form" action="{{ route('favorites.store', $shop->id) }}" method="POST" class="d-none">
                       @csrf
                   </form>
               @endif
           @endauth
       </div>

       <div class="offset-1 col-11">
           <hr class="w-100">
           <h3 class="float-left">カスタマーレビュー</h3>
       </div>

       <div class="offset-1 col-10">
            <div class="row">
                @foreach($reviews as $review)
                <div class="offset-md-5 col-md-5">
                    <h3 class="review-score-color">{{ str_repeat('★', $review->score) }}</h3>
                    <p class="h3">{{$review->title}}</p>
                    <p class="h3">{{$review->content}}</p>
                    <label>
                        {{$review->created_at}}
                        @if ($review->user)
                            {{$review->user->name}}
                        @else
                            退会済ユーザー
                        @endif
                    </label>
                </div>
                @endforeach
            </div><br />

@auth
    @if(auth()->user()->subscribed('premium_plan'))
        {{-- 有料会員：レビュー投稿フォーム --}}
        <div class="row">
            <div class="offset-md-5 col-md-5">
                <form method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    <h4>評価</h4>
                    <select name="score" class="form-control m-2 review-score-color">
                        <option value="5" class="review-score-color">★★★★★</option>
                        <option value="4" class="review-score-color">★★★★</option>
                        <option value="3" class="review-score-color">★★★</option>
                        <option value="2" class="review-score-color">★★</option>
                        <option value="1" class="review-score-color">★</option>
                    </select>
                    <h4>タイトル</h4>
                    @error('title')
                        <strong class="text-danger">タイトルを入力してください</strong>
                    @enderror
                    <input type="text" name="title" class="form-control m-2">
                    <h4>レビュー内容</h4>
                    @error('content')
                        <strong class="text-danger">レビュー内容を入力してください</strong>
                    @enderror
                    <textarea name="content" class="form-control m-2"></textarea>
                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                    <button type="submit" class="btn nagoyameshi-submit-button ml-2">レビューを追加</button>
                </form>
            </div>
        </div>
    @else
        {{-- 無料会員：メッセージと誘導 --}}
        <div class="row">
            <div class="offset-md-5 col-md-5 mt-3">
                <div class="alert alert-warning">
                    <p class="mb-2">レビュー投稿は有料会員限定機能です。</p>
                    <a href="{{ route('subscription.create') }}" class="btn btn-warning w-100">
                        有料プランに登録する
                    </a>
                </div>
            </div>
        </div>
    @endif
@else
    {{-- 未ログインユーザー：ログイン誘導 --}}
    <div class="row">
        <div class="offset-md-5 col-md-5 mt-3">
            <div class="alert alert-info">
                <p class="mb-2">レビューを投稿するにはログインが必要です。</p>
                <a href="{{ route('login') }}" class="btn btn-info w-100">
                    ログインする
                </a>
            </div>
        </div>
    </div>
@endauth


       </div>
   </div>
</div>
@endsection
