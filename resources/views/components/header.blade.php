<nav class="navbar navbar-expand-md navbar-light shadow-sm nagoyameshi-header-container">
   <div class="container">
       <a class="navbar-brand" href="{{ route('shops.index') }}">
       <img src="{{asset('img/logo.png')}}">
       </a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
           <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav ms-auto mr-5 mt-2">
               @guest
                   <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('register') }}">登録</a>
                   </li>
                   <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                   </li>
                   <hr>
                   <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('login') }}"><i class="far fa-heart"></i></a>
                   </li>
               @else
                <li class="nav-item mr-5">
                  <a class="nav-link" href="{{ route('mypage') }}">
                    <i class="fas fa-user mr-1"></i><label>マイページ</label>
                  </a>
                </li>
                <li class="nav-item mr-5">
          <a class="nav-link" href="{{ route('mypage.favorite') }}">
            <i class="far fa-heart"></i>
          </a>
        </li>
               @endguest
           </ul>
       </div>
   </div>
</nav>