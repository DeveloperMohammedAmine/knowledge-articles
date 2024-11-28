@extends('layouts.app')

@section('title')

   <title>Edit - {{ $article -> title }}</title>

@endsection

@section('content')

  @include('layouts.nav-bar')


<div style="padding-top: 200px" class="container">
  <h2 class="articles-heading pb-4" >Create An Article</h2>

   @if ($errors->any())
      @foreach ($errors->all() as $error)
         <div class="alert alert-danger" >{{ $error }}</div>
      @endforeach
   @endif

  <div class="col-lg-12 mb-5">
      <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype='multipart/form-data'>
      @csrf
      @method('PUT')
        <div class="row gy-4">
            <input type="hidden" name="id" value="{{ $article -> id }}">
            <div class="col-md-12">
               <input type="text" name="title" value="{{ $article -> title }}" class="form-control" placeholder="Title">
            </div>

            
            <div class="col-md-12">
               <textarea class="form-control"  name="text" rows="6" placeholder="Text">{{ $article -> text }}</textarea>
            </div>
            
            <div class="col-md-12">
               <select name="category_id" class="form-select" aria-label="Default select example">
                  <option selected value="" > -- Chooose An Category -- </option>
                  @foreach($categories as $category)
                     @if($category -> id == $article -> category -> id)
                        <option selected value="{{ $category -> id }}">{{ $category -> name }}</option>
                     @else
                        <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                     @endif

                  @endforeach   
               </select>
            </div>

            <div class="col-md-12 d-flex justify-content-between align-items-center">
               <img class="me-4 rounded" width="100" src="{{ asset('assets/img/blog') }}/{{ $article -> image }}" alt="">
               <input type="file" name="img" class="form-control" >
            </div>

            
            <div class="col-md-3">
               <input class="getstarted border-0 m-0" type="submit" value="Publish">
            </div>
         </div>

        </div>
      </form>

    </div>

  </div>


</div>


@include('layouts.footer')


@endsection















