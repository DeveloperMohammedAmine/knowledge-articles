@extends('layouts.app')

@section('title')
  <title>Knowledge Articles</title>
@endsection

@section('content')

@include('layouts.nav-bar')

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

<div class="container">
  <div class="row">
    <div class="col-lg-6 d-flex flex-column justify-content-center">
      <h1 class="mb-3" data-aos="fade-up">A knowledge sharing platform rich in information in several fields</h1>
      <div data-aos="fade-up" data-aos-delay="600">
        <div class="text-center text-lg-start">

          @if(auth() -> check())
            <a href="{{ route('articles.create') }}" class="getstarted m-0 me-2 mt-2 scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Write An Article</span>
              <i class="fa fa-newspaper ms-2"></i>
            </a>
          @endif

          <a href="{{ route('articles.index') }}" class="getstarted m-0 scrollto d-inline-flex align-items-center justify-content-center align-self-center">
            <span>Browse articles</span>
            <i class="bi bi-arrow-right ms-2"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
      <img src="assets/img/hero-img.png" class="img-fluid" alt="">
    </div>
  </div>
</div>

</section><!-- End Hero -->

<main id="main">
<!-- ======= Values Section ======= -->
<section id="values" class="values">

  <div class="container" data-aos="fade-up">

    <header class="section-header">
      <h2>our credibility</h2>
      <p>How credible is Knowledge Articles ?</p>
    </header>

    <div class="row">

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="box">
          <img src="{{ asset('assets/img/values-1.jpg') }}" class="img-fluid" alt="">
          <h3>The validity of the information</h3>
          <p>We use verification when searching for knowledge before sharing it</p>
        </div>
      </div>

      <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
        <div class="box">
          <img width="100%" src="{{ asset('assets/img/values-2.jpg') }}" class="" alt="">
          <h3>Mention approved references</h3>
          <p>We oblige writers to share practical references when sharing articles and make it easier for the reader to view them</p>
        </div>
      </div>

      <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
        <div class="box">
          <img src="{{ asset('assets/img/values-3.jpg') }}" class="img-fluid" alt="">
          <h3>Continuous review of articles</h3>
          <p>We continually check the accuracy of the information in the content shared by our writers</p>
        </div>
      </div>

    </div>

  </div>

</section><!-- End Values Section -->

<!-- ======= Counts Section ======= -->
<section id="counts" class="counts">
  <div class="container" data-aos="fade-up">

    <div class="row gy-4">

      <div class="col-lg-3 col-md-6">
        <div class="count-box">
          <i class="bi bi-emoji-smile"></i>
          <div>
            <span data-purecounter-start="0" data-purecounter-end="{{ App\Models\User::count() }}" data-purecounter-duration="1" class="purecounter"></span>
            <p>Writers</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="count-box">
          <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
          <div>
            <span data-purecounter-start="0" data-purecounter-end="{{ App\Models\Article::count() }}" data-purecounter-duration="1" class="purecounter"></span>
            <p>Articles</p>
          </div>
        </div>
      </div>

      <div style="border-radius: 8px" class="col-lg-3 col-md-6">
        <div class="count-box">
        <i class="bi bi-chat-right-text" style="color: #15be56" ></i>
          <div>
            <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
            <p>Comments</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="count-box">
          <i class="bi bi-hand-thumbs-up" style="color: #bb0852;"></i>
          <div>
            <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
            <p>Likes</p>
          </div>
        </div>
      </div>

    </div>

  </div>
</section><!-- End Counts Section -->


<!-- ======= Team Section ======= -->
<section id="team" class="team">

  <div class="container" data-aos="fade-up">

    <header class="section-header">
      <h2>writers</h2>
      <p>Our most important writers</p>
    </header>

    <div class="row gy-4">

    @foreach(App\Http\Controllers\HomeController::getMostWriters() as $writer)

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
        <div class="member">
          <div class="member-img">
            @php
              $image = $writer -> profile -> image == null ?
                'default-user-image.jpg' : 
              $writer -> profile -> image
            @endphp
            <img src="{{ asset('assets/img/users')}}/{{ $image }}" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>{{ $writer -> name }}</h4>
            <span>{{ $writer -> profile -> job }}</span>
            <span>{{ $writer -> profile -> country }}</span>
          </div>
        </div>
      </div>

    @endforeach



    </div>

  </div>

</section><!-- End Team Section -->

</main><!-- End #main -->

@include('layouts.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


@endsection
