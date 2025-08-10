@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
   <div class="w-50">
                <nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('shops.index') }}">ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">マイページ</li>
        </ol>
    </nav>

       <h1>マイページ</h1>

       <hr>

       <div class="container">
           <div class="d-flex justify-content-between">
               <div class="row">
                   <div class="col-2 d-flex align-items-center">
                       <i class="fas fa-user fa-3x"></i>
                   </div>
                   <div class="col-9 d-flex align-items-center ms-2 mt-3">
                       <div class="d-flex flex-column">
                           <label for="user-name">会員情報の編集</label>
                           <p>アカウント情報の編集</p>
                       </div>
                   </div>
               </div>
               <div class="d-flex align-items-center">
                   <a href="{{route('mypage.edit')}}">
                       <i class="fas fa-chevron-right fa-2x"></i>
                   </a>
               </div>
           </div>
       </div>

       <hr>

       <div class="container">
           <div class="d-flex justify-content-between">
               <div class="row">
                   <div class="col-2 d-flex align-items-center">
                <i class="fa-solid fa-calendar-days fa-3x"></i>
                   </div>
                   <div class="col-9 d-flex align-items-center ms-2 mt-3">
                       <div class="d-flex flex-column">
                           <label for="user-name">予約一覧</label>
                           <p>予約履歴を確認できます</p>
                       </div>
                   </div>
               </div>
               <div class="d-flex align-items-center">
                   <a href="{{route('reservations.index')}}">
                       <i class="fas fa-chevron-right fa-2x"></i>
                   </a>
               </div>
           </div>
       </div>

        <hr>

        <div class="container">
           <div class="d-flex justify-content-between">
               <div class="row">
                   <div class="col-2 d-flex align-items-center">
                <i class="fa-solid fa-heart fa-3x"></i>
                   </div>
                   <div class="col-9 d-flex align-items-center ms-2 mt-3">
                       <div class="d-flex flex-column">
                           <label for="user-name">お気に入り一覧</label>
                           <p>お気に入りを確認できます</p>
                       </div>
                   </div>
               </div>
               <div class="d-flex align-items-center">
                   <a href="{{route('mypage.favorite')}}">
                       <i class="fas fa-chevron-right fa-2x"></i>
                   </a>
               </div>
           </div>
       </div>

        <hr>

       <div class="container">
           <div class="d-flex justify-content-between">
               <div class="row">
                   <div class="col-2 d-flex align-items-center">
                    <i class="fa-solid fa-web-awesome fa-3x"></i>
                   </div>
                   <div class="col-9 d-flex align-items-center ms-2 mt-3">
                       <div class="d-flex flex-column">
                           <label for="user-name">有料会員登録</label>
                           <p>有料プランへアップグレード</p>
                       </div>
                   </div>
               </div>
               <div class="d-flex align-items-center">
                   <a href="{{route('subscription')}}">
                       <i class="fas fa-chevron-right fa-2x"></i>
                   </a>
               </div>
           </div>
       </div>

       <hr>
                    <div class="container">
           <div class="d-flex justify-content-between">
               <div class="row">
                   <div class="col-2 d-flex align-items-center">
                    <i class="fa-solid fa-credit-card fa-3x"></i>
                   </div>
                   <div class="col-9 d-flex align-items-center ms-2 mt-3">
                       <div class="d-flex flex-column">
                           <label for="user-name">クレジットカード情報</label>
                           <p>※有料会員様限定機能</p>
                       </div>
                   </div>
               </div>
               <div class="d-flex align-items-center">
                   <a href="{{route('subscription')}}">
                       <i class="fas fa-chevron-right fa-2x"></i>
                   </a>
               </div>
           </div>
       </div>

       <hr>

              <div class="container">
           <div class="d-flex justify-content-between">
               <div class="row">
                   <div class="col-2 d-flex align-items-center">
                    <i class="fa-solid fa-face-sad-tear fa-3x"></i>
                   </div>
                   <div class="col-9 d-flex align-items-center ms-2 mt-3">
                       <div class="d-flex flex-column">
                           <label for="user-name">有料会員解約</label>
                           <p>有料プラン退会はこちら</p>
                       </div>
                   </div>
               </div>
               <div class="d-flex align-items-center">
                   <a href="{{route('subscription.cancel')}}">
                       <i class="fas fa-chevron-right fa-2x"></i>
                   </a>
               </div>
           </div>
       </div>

            <hr>


       <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-lock fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ms-2 mt-3">
                        <div class="d-flex flex-column">
                            <label for="user-name">パスワード変更</label>
                            <p>パスワードを変更します</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('mypage.edit_password') }}">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr>

       <div class="container">
           <div class="d-flex justify-content-between">
               <div class="row">
                   <div class="col-2 d-flex align-items-center">
                       <i class="fas fa-sign-out-alt fa-3x"></i>
                   </div>
                   <div class="col-9 d-flex align-items-center ms-2 mt-3">
                       <div class="d-flex flex-column">
                           <label for="user-name">ログアウト</label>
                           <p>ログアウトします</p>
                       </div>
                   </div>
               </div>
                <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    <button type="submit" class="btn p-0 border-0 bg-transparent d-flex align-items-center text-decoration-none text-primary">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </button>
                </form>
               </div>
           </div>
       </div>

       <hr>
   </div>
</div>
@endsection