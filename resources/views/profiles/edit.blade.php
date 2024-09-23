@extends('layouts.app')


@section('title')
   <title>Edit - {{ $user -> name }}</title>
@endsection

@section('content')

   @include('layouts.nav-bar')

   <div style="padding-top: 200px" class="container">


      @if(session()->has('success'))
         <div class="alert alert-success">
            {{ session()->get('success') }}
         </div>
      @endif

      <form class="mb-3" action="{{ route('profile.update') }}" method="POST" enctype='multipart/form-data' >
      @csrf
         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input placeholder=". . ." value="{{ $user -> name }}" type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>

         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Address Email</label>
            <input placeholder=". . ." type="text" value="{{ $user -> email }}" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>

         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Image</label>
            <div class="d-flex align-items-center" >
               @php
                  $image = $user -> profile -> image == null ?
                  'default-user-image.jpg' : 
                  $user -> profile -> image;
               @endphp
               <img class="rounded" width="100" height="100" src="{{ asset('assets/img/users')}}/{{ $image }}" alt="user image">  
               <input type="file" name="image" class="form-control ms-2" >
            </div>
         </div>

         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Phone Number</label>
            <input placeholder=". . ." type="text" value="{{ $user -> profile -> phone_number }}" name="phone_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>

         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Job</label>
            <input placeholder=". . ." type="text" value="{{ $user -> profile -> job }}" name="job" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>

         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Country</label>
            <input placeholder=". . ." type="text" value="{{ $user -> profile -> country }}" name="country" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>


         <div class="d-flex justify-content-between" >
            <button type="submit" class="getstarted m-0 border-0">Save</button>
            <a class="getstarted" href="{{ route('profile.edit.password') }}">Edit Password</a>
         </div>
      </form>


   </div>
   @include('layouts.footer')
@endsection