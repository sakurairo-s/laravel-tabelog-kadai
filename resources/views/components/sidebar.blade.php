  <div class="row g-3">
    <div class="col-12 col-md-3 col-lg-2 d-flex justify-content-center px-0">
      <aside class="sidebar">
        <div class="sidebar-title small mb-2 text-center">カテゴリから探す</div>

        <div class="d-grid gap-2 sidebar-inner">
          <a href="{{ route('shops.index') }}"
             class="btn btn-sm {{ request('category') ? 'btn-outline-secondary' : 'btn-success' }}">すべて</a>
          @foreach ($categories as $category)
            <a href="{{ route('shops.index', ['category' => $category->id]) }}"
               class="btn btn-sm {{ request('category') == $category->id ? 'btn-success' : 'btn-outline-secondary' }}">
              {{ $category->name }}
            </a>
          @endforeach
        </div>
      </aside>
    </div>