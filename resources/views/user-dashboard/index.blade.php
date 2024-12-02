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
        $bg_color = App\Traits\categoriesSpacialeColor::specialeColor($article->category->id);
      @endphp
      <div style="height: 120px" class="col-lg-6 mb-4 articles">
        <div class="post-box d-flex justify-content-start">
          <div class="post-img m-0 rounded"><img height="100%" src="{{ asset('assets/img/blog') }}/{{$article -> image}}" alt=""></div>
            <div style="width: 72%;" class="ms-3 d-flex flex-column justify-content-between">
              <h3 class="post-title mb-1">{{ substr($article->title, 0, 60) }}</h3>
              @php
                $created_date = \Carbon\Carbon::parse($article->created_at)->format('d/m/Y');
                $current_date = date('d/m/Y');
                $newDate = \Carbon\Carbon::createFromFormat('d/m/Y', $current_date);
              @endphp
              <span class="post-date my-1">{{ \Carbon\Carbon::createFromFormat('d/m/Y', $created_date)->diffForHumans($newDate) }}</span>
              <div style="font-size: 13px;" class="d-flex align-items-center justify-content-between" >
                <div class="d-flex" >
                  <span style="font-size: 12px;line-height: 1.9;border-radius: 3px;" class="me-3 bg-{{$bg_color}} text-light p-0 px-1">{{ $article->category->name }}</span>
                  <div class="d-flex align-items-center justify-content-between" >
                    <span><i style="color: #ff4200" class="bi bi-fire"></i></span>
                    <span>125</span>
                  </div>
                </div>
                <div class="articles-actions">
                  <a target="_blank" href="{{ route('articles.show', $article->id) }}"><span class="p-1 px-2 btn btn-outline-success btn-sm mb-1" ><i class="fas fa-eye"></i></span></a>
                  <a target="_blank" href="{{ route('articles.edit', $article->id) }}"><span class="p-1 px-2 btn btn-outline-info btn-sm mb-1" ><i class="fas fa-edit"></i>
                  </span></a>
                  <form class="d-inline" action="{{ route('articles.destroy', $article->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="p-1 px-2 btn btn-outline-danger btn-sm mb-1" type="submit"><i class="fas fa-trash"></i>
                      </button>
                  </form>
                </div>
              </div>
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