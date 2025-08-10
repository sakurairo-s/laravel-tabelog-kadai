@extends('layouts.app')

@section('content')
<div class="container">
    <br>
  {{-- パンくず --}}
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('shops.index') }}">ホーム</a></li>
      <li class="breadcrumb-item"><a href="{{ route('mypage') }}">マイページ</a></li>
      <li class="breadcrumb-item active" aria-current="page">パスワード変更</li>
    </ol>
  </nav>

  {{-- 成功メッセージ（任意） --}}
  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('password.update') }}">
      @csrf
      @method('PUT')

      {{-- 現在のパスワード --}}
      <div class="form-group row mb-3">
        <label class="col-md-3 col-form-label text-md-right">現在のパスワード</label>
        <div class="col-md-7">
          <input type="password" name="current_password"
                 class="form-control @error('current_password') is-invalid @enderror"
                 required autocomplete="current-password">
          @error('current_password')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>

      {{-- 新しいパスワード --}}
      <div class="form-group row mb-3">
        <label for="password" class="col-md-3 col-form-label text-md-right">新しいパスワード</label>
        <div class="col-md-7">
          <input id="password" type="password"
                 class="form-control @error('password') is-invalid @enderror"
                 name="password" required autocomplete="new-password">
          @error('password')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>

      {{-- 確認用 --}}
      <div class="form-group row mb-3">
        <label for="password-confirm" class="col-md-3 col-form-label text-md-right">確認用</label>
        <div class="col-md-7">
          <input id="password-confirm" type="password" class="form-control"
                 name="password_confirmation" required autocomplete="new-password">
        </div>
      </div>

      <div class="form-group d-flex justify-content-center">
        <button type="submit" class="btn btn-success w-25">パスワード更新</button>
      </div>
  </form>
</div>
@endsection
