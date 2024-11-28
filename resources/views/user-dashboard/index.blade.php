@extends('layouts.app')

@section('title')
  <title>Dashboard - {{Auth::user() -> name}}</title>
@endsection

@section('content')

  @include('layouts.nav-bar')

   <!-- ======= Recent Blog Posts Section ======= -->
<section style="padding-top: 200px" id="recent-blog-posts" class="recent-blog-posts">

<div class="container">
  
    
  <h2 class="articles-heading" >Article</h2>
  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif

  @if(session()->has('success-delete'))
    <div class="alert alert-danger">
        {{ session()->get('success-delete') }}
    </div>
  @endif
  <div class="row pt-3">
    
    @foreach($articles as $article)

    @php
      $bg_color = App\Traits\categoriesSpacialeColor::specialeColor($article -> category -> id);
    @endphp
      <div style="height: 160px" class="col-lg-6 mb-4 articles">
          <div class="post-box d-flex justify-content-between">
            <div style="width: 20%;" class="post-img m-0 rounded"><img width="100%" height="100%" src="{{ asset('assets/img/blog') }}/{{$article -> image}}" alt=""></div>
               <div style="width: 65%" class="ms-4">
                  <h3 class="post-title mb-1 mt-2">{{ $article -> title }}</h3>
                  @php  
                    $created_date = \Carbon\Carbon::parse($article -> created_at)->format('d/m/Y');
                    $current_date = date('d/m/Y');
                    $newDate = \Carbon\Carbon::createFromFormat('d/m/Y', $current_date);
                  @endphp
                  <span class="post-date mb-2 mt-2">{{ \Carbon\Carbon::createFromFormat('d/m/Y', $created_date)->diffForHumans($newDate) }}</span>
                  <div class="d-flex" >
                     <span style="font-size: 13px;line-height: 1.8" class="me-3 bg-{{$bg_color}} text-light ps-2 pe-2 rounded">{{ $article -> category -> name }}</span>
                     <div class="d-flex align-items-center justify-content-between" >
                        <span><i style="color: #ff4200" class="bi bi-fire"></i></span>
                        <span>125</span>
                     </div>
                  </div>
               </div>
               <div class="articles-actions" style="width: 11%">
                  <a target="_blank" href="{{ route('articles.show', $article->id) }}"><span style="width: 65px" class="p-1 btn btn-outline-success mb-1 mt-2" >show</span></a>
                  <a target="_blank" href="{{ route('articles.edit', $article->id) }}"><span style="width: 65px" class="p-1 btn btn-outline-info mb-1" >Edit</span></a>
                  <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button style="width: 65px" class="p-1 btn btn-outline-danger mb-1" type="submit">Delete</button>
                  </form>
                </div>
         </div>
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