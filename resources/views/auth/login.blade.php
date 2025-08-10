@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
        <nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('shops.index') }}">ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">ログイン画面</li>
        </ol>
    </nav>
       <div class="col-md-5">
           <h3 class="mt-3 mb-3">ログイン</h3>

           <hr>
           <form method="POST" action="{{ route('login') }}">
               @csrf

               <div class="form-group">
                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror nagoyameshi-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">

                   @error('email')
                   <span class="invalid-feedback" role="alert">
                       <strong>メールアドレスが正しくない可能性があります。</strong>
                   </span>
                   @enderror
               </div>

               <div class="form-group">
                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror nagoyameshi-login-input" name="password" required autocomplete="current-password" placeholder="パスワード">

                   @error('password')
                   <span class="invalid-feedback" role="alert">
                       <strong>パスワードが正しくない可能性があります。</strong>
                   </span>
                   @enderror
               </div>

               <div class="form-group">
                   <div class="form-check">
                       <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                       <label class="form-check-label nagoyameshi-check-label w-100" for="remember">
                           次回から自動的にログインする
                       </label>
                   </div>
               </div>

               <div class="form-group">
                   <button type="submit" class="mt-3 btn nagoyameshi-submit-button w-100">
                       ログイン
                   </button>

                   <a class="btn btn-link mt-3 d-flex justify-content-center nagoyameshi-login-text" href="{{ route('password.request') }}">
                       パスワードをお忘れの場合
                   </a>
               </div>
           </form>

           <hr>

           <div class="form-group">
               <a class="btn btn-link mt-3 d-flex justify-content-center nagoyameshi-login-text" href="{{ route('register') }}">
                   新規登録
               </a>
           </div>
       </div>
   </div>
</div>
@endsection