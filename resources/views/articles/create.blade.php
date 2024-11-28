@extends('layouts.app')

@section('title')

   <title>Knowledge Articles - Create</title>

@endsection

@section('content')

  @include('layouts.nav-bar')


<div style="padding-top: 200px" class="container">
  <h2 class="articles-heading pb-4" >Create An Article</h2>


  <div class="col-lg-12 mb-5">
      <form action="{{ route('articles.store') }}" method="POST" enctype='multipart/form-data'>
      @csrf
        <div class="row gy-4">

            <div class="col-md-12">
               <input  type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Title" required autofocus>
               @error('title')
                  <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                  </span>
               @enderror
            </div>


            <div class="col-md-12">
               <textarea class="form-control @error('text') is-invalid @enderror" name="text" rows="6" placeholder="Text">{{ old('text') }}</textarea>
               @error('text')
                  <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                  </span>
               @enderror
            </div>

            
            <div class="col-md-12">
               <select name="category_id" class="form-select  @error('category_id') is-invalid @enderror" aria-label="Default select example">
                  <option selected value="" > -- Chooose An Category -- </option>
                  @foreach($categories as $category)
                     @if($category -> id == old('category_id'))
                           <option selected value="{{ $category -> id }}">{{ $category -> name }}</option>
                        @else
                           <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                     @endif
                  @endforeach   
               </select>
            </div>

            <div class="col-md-12">
               <input type="file" name="img" class="form-control @error('image') is-invalid @enderror" >
               @error('image')
                  <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                  </span>
               @enderror
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















