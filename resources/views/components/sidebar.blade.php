<div class="container">
    @foreach ($categories as $category)
        <label class="nagoyameshi-sidebar-category-label">
            <a href="{{ route('shops.index', ['category' => $category->id]) }}">
                {{ $category->name }}
            </a>
        </label>
    @endforeach
</div>
