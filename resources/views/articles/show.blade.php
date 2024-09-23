@extends('layouts.app')

@section('title')

   <title>{{ $article -> title }}</title>

@endsection

@section('content')

@include('layouts.nav-bar')

<main id="main">

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol class="p-0" >
      <li><a href="{{ url('/') }}">Home</a></li>
      <li><a href="{{ route('articles.index') }}">Articles</a></li>
      <li><a href="{{ url('articles/categories') }}/{{ $article -> category -> name }}">{{ $article -> category -> name }}</a></li>
      <li>{{ $article -> title }}</li>
    </ol>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">

    <div class="row">

      <div class="col-lg-8 entries">

        <article class="entry entry-single">

          <div class="entry-img">
            <img width="100%" height="100%" src="{{ asset('assets/img/blog') }}/{{$article -> image}}" alt="" >
          </div>

          <h2 class="entry-title">
            <a href="">{{ $article -> title }}</a>
          </h2>

          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">{{ $article -> user -> name }}</a></li>
              @php  
                $created_date = \Carbon\Carbon::parse($article -> created_at)->format('d/m/Y');
                $current_date = date('d/m/Y');
                $newDate = \Carbon\Carbon::createFromFormat('d/m/Y', $current_date);
              @endphp
              <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">{{ \Carbon\Carbon::createFromFormat('d/m/Y', $created_date)->diffForHumans($newDate) }}</time></a></li>
              <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">Coming soon</a></li>
            </ul>
          </div>

          <div class="entry-content">
            {{ $article ->text }}
          </div>

          <div class="entry-footer">
            <i class="bi bi-folder"></i>
            <ul class="cats">
              <li><a href="#">{{ $article -> category -> name }}</a></li>
            </ul>

            <i class="bi bi-tags"></i>
            <ul class="tags">
              coming soon
            </ul>
          </div>

        </article><!-- End blog entry -->

        <div class="blog-author d-flex align-items-center">
            @php  $profile = App\Models\Profile::find($article -> user -> id)  @endphp

            @php
              $image = $profile -> image == null ?
                'default-user-image.jpg' : 
              $profile -> image
            @endphp

            <img src="{{ asset('assets/img/users')}}/{{ $image }}" class="rounded-circle float-left" alt="">
            <div>
              <div class="d-flex align-items-center justify-content-between" >
                  <h4>{{ $article -> user -> name }}</h4>
                  <div class="social-links">
                  <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                  <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                  <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                  </div>
              </div>
              <p class="pt-2" >
              Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
              </p>
            </div>
        </div><!-- End blog author bio -->

        <div class="blog-comments">

          <h4 class="comments-count">8 Comments</h4>

          <div id="comment-1" class="comment">
            <div class="d-flex">
              <div class="comment-img"><img src="{{ asset('assets/img/blog/blog-1.jpg')}}" alt=""></div>
              <div>
                <h5><a href="">Georgia Reader</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                <time datetime="2020-01-01">01 Jan, 2020</time>
                <p>
                  Et rerum totam nisi. Molestiae vel quam dolorum vel voluptatem et et. Est ad aut sapiente quis molestiae est qui cum soluta.
                  Vero aut rerum vel. Rerum quos laboriosam placeat ex qui. Sint qui facilis et.
                </p>
              </div>
            </div>
          </div><!-- End comment #1 -->

          <div id="comment-2" class="comment">
            <div class="d-flex">
              <div class="comment-img"><img src="{{ asset('assets/img/blog/blog-1.jpg')}}" alt=""></div>
              <div>
                <h5><a href="">Aron Alvarado</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                <time datetime="2020-01-01">01 Jan, 2020</time>
                <p>
                  Ipsam tempora sequi voluptatem quis sapiente non. Autem itaque eveniet saepe. Officiis illo ut beatae.
                </p>
              </div>
            </div>

            <div id="comment-reply-1" class="comment comment-reply">
              <div class="d-flex">
                <div class="comment-img"><img src="{{ asset('assets/img/blog/blog-1.jpg')}}" alt=""></div>
                <div>
                  <h5><a href="">Lynda Small</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                  <time datetime="2020-01-01">01 Jan, 2020</time>
                  <p>
                    Enim ipsa eum fugiat fuga repellat. Commodi quo quo dicta. Est ullam aspernatur ut vitae quia mollitia id non. Qui ad quas nostrum rerum sed necessitatibus aut est. Eum officiis sed repellat maxime vero nisi natus. Amet nesciunt nesciunt qui illum omnis est et dolor recusandae.

                    Recusandae sit ad aut impedit et. Ipsa labore dolor impedit et natus in porro aut. Magnam qui cum. Illo similique occaecati nihil modi eligendi. Pariatur distinctio labore omnis incidunt et illum. Expedita et dignissimos distinctio laborum minima fugiat.

                    Libero corporis qui. Nam illo odio beatae enim ducimus. Harum reiciendis error dolorum non autem quisquam vero rerum neque.
                  </p>
                </div>
              </div>

              <div id="comment-reply-2" class="comment comment-reply">
                <div class="d-flex">
                  <div class="comment-img"><img src="{{ asset('assets/img/blog/blog-1.jpg')}}" alt=""></div>
                  <div>
                    <h5><a href="">Sianna Ramsay</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                    <time datetime="2020-01-01">01 Jan, 2020</time>
                    <p>
                      Et dignissimos impedit nulla et quo distinctio ex nemo. Omnis quia dolores cupiditate et. Ut unde qui eligendi sapiente omnis ullam. Placeat porro est commodi est officiis voluptas repellat quisquam possimus. Perferendis id consectetur necessitatibus.
                    </p>
                  </div>
                </div>

              </div><!-- End comment reply #2-->

            </div><!-- End comment reply #1-->

          </div><!-- End comment #2-->

          <div id="comment-3" class="comment">
            <div class="d-flex">
              <div class="comment-img"><img src="{{ asset('assets/img/blog/blog-1.jpg')}}" alt=""></div>
              <div>
                <h5><a href="">Nolan Davidson</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                <time datetime="2020-01-01">01 Jan, 2020</time>
                <p>
                  Distinctio nesciunt rerum reprehenderit sed. Iste omnis eius repellendus quia nihil ut accusantium tempore. Nesciunt expedita id dolor exercitationem aspernatur aut quam ut. Voluptatem est accusamus iste at.
                  Non aut et et esse qui sit modi neque. Exercitationem et eos aspernatur. Ea est consequuntur officia beatae ea aut eos soluta. Non qui dolorum voluptatibus et optio veniam. Quam officia sit nostrum dolorem.
                </p>
              </div>
            </div>

          </div><!-- End comment #3 -->

          <div id="comment-4" class="comment">
            <div class="d-flex">
              <div class="comment-img"><img src="{{ asset('assets/img/blog/blog-1.jpg')}}" alt=""></div>
              <div>
                <h5><a href="">Kay Duggan</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                <time datetime="2020-01-01">01 Jan, 2020</time>
                <p>
                  Dolorem atque aut. Omnis doloremque blanditiis quia eum porro quis ut velit tempore. Cumque sed quia ut maxime. Est ad aut cum. Ut exercitationem non in fugiat.
                </p>
              </div>
            </div>

          </div><!-- End comment #4 -->

          <div class="reply-form">
            <h4 class="pb-2" >Write A Comment</h4>
            <form action="">
               <div class="row">
                  <div class="col form-group">
                     <textarea name="comment" class="form-control" placeholder=". . ."></textarea>
                  </div>
               </div>

              <button type="submit" class="btn btn-primary">Publish</button>

            </form>

          </div>

        </div><!-- End blog comments -->

      </div><!-- End blog entries list -->

      <div class="col-lg-4">

        <div class="sidebar">

          <h3 class="sidebar-title">Search</h3>
          <div class="sidebar-item search-form">
            <form action="">
              <input type="text">
              <button type="submit"><i class="bi bi-search"></i></button>
            </form>
          </div><!-- End sidebar search formn-->

          <h3 class="sidebar-title">Categories</h3>
          <div class="sidebar-item categories">
            <ul>
              @foreach($categories as $category)
                <li><a href="{{ route('articles.by_category', $category -> name) }}">{{ $category -> name }} <span>({{$category -> articles -> count()}})</span></a></li>
              @endforeach
              
            </ul>
          </div><!-- End sidebar categories-->

          <h3 class="sidebar-title">Recent Posts</h3>
          <div class="sidebar-item recent-posts">
            

            @foreach($articles as $article)
            
              @php
                $bg_color = App\Traits\categoriesSpacialeColor::specialeColor($article -> category -> id);
              @endphp
              <div class="post-item clearfix">
                <img src="{{ asset('assets/img/blog') }}/{{ $article -> image }}" alt="">
                <h4><a href="{{ route('articles.show', $article -> id) }}">{{ $article -> title }}</a></h4>
                <div class="d-flex justify-content-between align-items-center" >
                @php  
                  $created_date = \Carbon\Carbon::parse($article -> created_at)->format('d/m/Y');
                  $current_date = date('d/m/Y');
                  $newDate = \Carbon\Carbon::createFromFormat('d/m/Y', $current_date);
                @endphp  
                <time datetime="2020-01-01">{{ \Carbon\Carbon::createFromFormat('d/m/Y', $created_date)->diffForHumans($newDate) }}</time>
                  <span class="bg-{{ $bg_color }} text-light p-1 ps-2 pe-2 rounded" style="font-size: 11px" >{{ $article -> category -> name }}</span>
                </div>
              </div>

            @endforeach

            

          </div><!-- End sidebar recent posts-->

          <h3 class="sidebar-title">Tags</h3>
          <div class="sidebar-item tags">
            <ul>
              <li><a href="#">App</a></li>
              <li><a href="#">IT</a></li>
              <li><a href="#">Business</a></li>
              <li><a href="#">Mac</a></li>
              <li><a href="#">Design</a></li>
              <li><a href="#">Office</a></li>
              <li><a href="#">Creative</a></li>
              <li><a href="#">Studio</a></li>
              <li><a href="#">Smart</a></li>
              <li><a href="#">Tips</a></li>
              <li><a href="#">Marketing</a></li>
            </ul>
          </div><!-- End sidebar tags-->

        </div><!-- End sidebar -->

      </div><!-- End blog sidebar -->

    </div>

  </div>
</section><!-- End Blog Single Section -->

</main><!-- End #main -->


@include('layouts.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



@endsection