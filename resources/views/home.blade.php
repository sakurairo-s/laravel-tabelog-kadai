@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ホーム</h1>
        <p>ようこそ、{{ Auth::user()->name }}さん！</p>
    </div>
@endsection
