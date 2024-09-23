  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <img class="mb-2" src="{{ asset('assets/img/logo.png') }}" alt="">
        <span>Knowledge Articles</span>
      </a>

      <nav id="navbar" class="navbar">

        <ul>
          <li><a class="nav-link scrollto" href="{{ url('/') }}">Home</a></li>
          <li class="dropdown"><a href="#"><span>Categories</span> <i class="bi bi-chevron-down"></i></a>
          @php
            $categories = App\Models\Category::get()
          @endphp
          <ul>
              @foreach($categories as $category)
                <li><a href="{{ route('articles.by_category', $category -> name) }}">{{ $category -> name }}</a></li>
              @endforeach
            </ul>
            </li>
            <li><a class="nav-link scrollto" href="{{ route('contact') }}">Contact</a></li>
            <li>
              @guest
              <a href="{{ route('login') }}" class="getstarted scrollto ps-2 pe-3 text-light"><span class="d-none d-md-inline"></span>
              <i class="fa-solid fa-right-to-bracket me-1"></i>Login
            </a>
            @else
            <div class="dropdown ms-5">
              <button class="getstarted scrollto ps-2 pe-3 dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user() -> name }}
              </button>
              <ul  class="dropdown-menu">
                <li><a class="dropdown-item justify-content-start" href="{{ route('articles.create') }}"><i class="fa fa-newspaper me-2"></i>Write An Article</a></li>
                <li><a class="dropdown-item justify-content-start" href="{{ route('user-dashboard.index') }}"><i class="fa fa-tachometer me-2"></i>Dashboard</a></li>
                <li><a class="dropdown-item justify-content-start" href="{{ route('profile.index', Auth::user() -> name) }}"><i class="fa-regular fa-user me-2"></i>Profile</a></li>
                <li>
                  <a class="dropdown-item justify-content-start" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i class="fa-regular fa-circle-xmark me-2"></i>Log out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
                </li>
              </ul>
            </div>
          @endguest
            </li>
      
      
      
    </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
