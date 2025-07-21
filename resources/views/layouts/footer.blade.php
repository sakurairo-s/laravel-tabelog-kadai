<footer class="bg-light">
    <div class="d-flex justify-content-center nagoyameshi-footer-logo">
        <a class="navbar-brand nagoyameshi-app-name" href="{{ url('/') }}">
            <div class="d-flex align-items-center">
                <img class="nagoyameshi-logo me-1" src ="{{ asset('img/logo.png') }}" alt="nagoyameshi">
            </div>
        </a>
    </div>
    <div class="d-flex justify-content-center nagoyameshi-footer-link">
            <a href="{{ url('/company') }}" class="link-secondary me-3">会社概要</a>
    </div>
    <p class="text-center text-muted small mb-0">&copy; NAGOYAMESHI All rights reserved.</p>
</footer>