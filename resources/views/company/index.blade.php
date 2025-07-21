@extends('layouts.app') {{-- 通常のユーザー向けレイアウト --}}

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">会社概要</h1>

    <table class="table table-bordered">
        <tr><th>会社名</th><td>{{ $company->name }}</td></tr>
        <tr><th>郵便番号</th><td>{{ $company->postal_code }}</td></tr>
        <tr><th>住所</th><td>{{ $company->address }}</td></tr>
        <tr><th>代表者</th><td>{{ $company->representative }}</td></tr>
        <tr><th>設立</th><td>{{ $company->establishment_date }}</td></tr>
        <tr><th>資本金</th><td>{{ $company->capital }}</td></tr>
        <tr><th>事業内容</th><td>{{ $company->business }}</td></tr>
        <tr><th>従業員数</th><td>{{ $company->number_of_employees }}</td></tr>
    </table>
</div>
@endsection
