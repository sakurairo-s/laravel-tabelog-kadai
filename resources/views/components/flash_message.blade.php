@if (session('flash_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('flash_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
