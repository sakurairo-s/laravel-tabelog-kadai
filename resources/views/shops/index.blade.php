@extends('layouts.app')

@section('content')

{{-- スライダー --}}
<div class="slider">
  <div class="slider-viewport">
    <div class="slider-track-wrapper">
      <div class="slider-track-offset">
        <div class="slider-track">
          <div class="slider-items">
            <div class="slider-slide">
              <div class="slider-image">
                <img src="img/img01.jpg" alt="名古屋グルメのひつまぶしの画像">
              </div>
            </div>
            <div class="slider-slide">
              <div class="slider-image">
                <img src="img/img02.jpg" alt="名古屋グルメの天むすの画像">
              </div>
            </div>
            <div class="slider-slide">
              <div class="slider-image">
                <img src="img/img03.jpg" alt="名古屋グルメの天むす味噌煮込みうどんの画像">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- 矢印 --}}
  <div class="slider-nav">
    <button type="button" aria-label="前のスライドへ">
      <i class="fas fa-chevron-left" aria-hidden="true"></i>
    </button>
    <button type="button" aria-label="次のスライドへ">
      <i class="fas fa-chevron-right" aria-hidden="true"></i>
    </button>
  </div>

  {{-- ドット --}}
  <div class="slider-indicators"></div>
</div>

{{-- ===== メインレイアウト ===== --}}
{{-- <div class="container">--}}
 {{-- <div class="row g-3"> --}}

{{-- ===== サイドバー ===== --}}
    {{-- <div class="col-auto d-flex justify-content-center ps-0 pe-0">--}}
        {{-- @include('components.sidebar', ['categories' => $categories])--}}
     {{-- </div> --}}


    {{-- メイン（残り全部） --}}
<div class="container"> 
  <div class="col-12 col-md-9 col-lg-10">
      {{-- 挨拶・検索など既存の内容 --}}
      @include('components.flash_message')
      <br>
      @if(Auth::check())
        <p>{{ Auth::user()->name }}さん、こんにちは！</p>
      @else
        <p>ゲストさん、ようこそ！</p>
      @endif

      {{-- 検索フォーム --}}
      <form action="{{ route('shops.index') }}" method="GET" class="mb-4">
        <div class="row g-2 align-items-end">
          <div class="col-md-3">
            <input type="text" name="keyword" class="form-control" placeholder="店舗名で検索" value="{{ request('keyword') }}">
          </div>
          <div class="col-md-2">
            <select name="category" class="form-select">
              <option value="">カテゴリを選択</option>
              @foreach ($categories as $category_option)
                <option value="{{ $category_option->id }}" {{ request('category') == $category_option->id ? 'selected' : '' }}>
                  {{ $category_option->name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <select name="budget" class="form-select">
              <option value="">予算を選択</option>
              <option value="0-999" {{ request('budget') == '0-999' ? 'selected' : '' }}>〜999円</option>
              <option value="1000-1999" {{ request('budget') == '1000-1999' ? 'selected' : '' }}>1000〜1999円</option>
              <option value="2000-2999" {{ request('budget') == '2000-2999' ? 'selected' : '' }}>2000〜2999円</option>
              <option value="3000-" {{ request('budget') == '3000-' ? 'selected' : '' }}>3000円以上</option>
            </select>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">
              <i class="fas fa-search me-1"></i>検索
            </button>
          </div>
        </div>
      </form>

      <h2 class="mb-3">
        @if (isset($category))
          {{ $category->name }}の店舗一覧（{{ $total_count }}件）
        @elseif (!empty($keyword))
          「{{ $keyword }}」の検索結果（{{ $total_count }}件）
        @else
          全店舗一覧（{{ $total_count }}件）
        @endif
      </h2>

      {{-- 並び替え --}}
      <div class="d-flex justify-content-end mb-3">
        <div>
          <strong>並び替え：</strong>
          @sortablelink('id', 'ID') |
          @sortablelink('price_min', '価格（安い順）')
        </div>
      </div>

      {{-- 一覧 --}}
      <div class="row">
        @foreach($shops as $shop)
          <div class="col-md-3 mb-4">
            <div class="card h-100">
              <a href="{{ route('shops.show', $shop) }}">
                <img src="{{ asset($shop->image ?: 'img/hitumabusi.jpg') }}" class="card-img-top" alt="shop image" style="height:160px;object-fit:cover;">
              </a>
              <div class="card-body">
                <h5 class="card-title">{{ $shop->name }}</h5>
                <p class="card-text">
                  <small class="text-muted">{{ $shop->category->name ?? '未分類' }}</small><br>
                  {{ Str::limit($shop->description, 50) }}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-4">
        {{ $shops->appends(request()->query())->links() }}
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/script.js') }}"></script>
@endpush
