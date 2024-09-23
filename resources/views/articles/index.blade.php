@extends('layouts.app')

@section('title')

   <title>Knowledge Articles - Articles</title>

@endsection

@section('content')

  @include('layouts.nav-bar')

   <!-- ======= Recent Blog Posts Section ======= -->
<section style="padding-top: 200px" id="recent-blog-posts" class="recent-blog-posts">

<div class="container">
  <h2 class="articles-heading" >Knowledge Articles Currently Has [ {{ App\Models\Article::count() }} ] Articles</h2>
  <div class="row pt-5"  data-aos="fade-up" >
    
    @foreach($articles as $article)

    @php
      $bg_color = App\Traits\categoriesSpacialeColor::specialeColor($article -> category -> id);
    @endphp
      <div class="col-lg-3 mb-4">
        <a href="{{ route('articles.show', $article -> id) }}">
          <div class="post-box">
            <div class="post-img rounded"><img width="100%" height="245" src="{{ asset('assets/img/blog') }}/{{$article -> image}}" alt=""></div>
            <div class="d-flex justify-content-between align-items-center pb-2" >
              @php  
                $created_date = \Carbon\Carbon::parse($article -> created_at)->format('d/m/Y');
                $current_date = date('d/m/Y');
                $newDate = \Carbon\Carbon::createFromFormat('d/m/Y', $current_date);
              @endphp
              <span class="post-date">{{ \Carbon\Carbon::createFromFormat('d/m/Y', $created_date)->diffForHumans($newDate) }}</span>
              <span class="post-category bg-{{$bg_color}} text-light p-1 ps-2 pe-2 rounded">{{ $article -> category -> name }}</span>
            </div>
            <h3 class="post-title">{{ $article -> title }}</h3>
            <div class="d-flex align-items-end justify-content-between" >
              <div class="author d-flex align-items-center" >
                <span class="author-image d-block me-2" >
                  @php
                    $profile = App\Models\Profile::find($article -> user -> id);
                    $image = $profile -> image == null ?
                      'default-user-image.jpg' : 
                    $profile -> image
                  @endphp

                  <img width="100%" height="100%" class="rounded-circle" src="{{ asset('assets/img/users') }}/{{ $image }}" alt="">
                </span>
                <span class="author-name" >{{ $article -> user -> name }}</span>
              </div>
              <div class="d-flex align-items-center justify-content-between" >
                <span><i style="color: #ff4200" class="bi bi-fire"></i></span>
                <span>125</span>
              </div>
            </div>
          </div>
        </a>
      </div>

    @endforeach

  </div>

  <div class="pagination-box mt-2">
      {{ $articles -> links() }}
   </div>

</div>

</section><!-- End Recent Blog Posts Section -->


@include('layouts.footer')


@endsection