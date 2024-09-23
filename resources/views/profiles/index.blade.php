@extends('layouts.app')


@section('title')
   <title>{{ $user -> name }}</title>
@endsection

@section('content')

   @include('layouts.nav-bar')

   <div class="container" style="padding-top: 150px" >

<div class="w-50 mx-auto" >
</div>
<div class="row justify-content-center pt-3">
   @if($user -> name == Auth::user() -> name)
      <div class="mb-4 text-center" >
         <a class="m-0 getstarted scrollto d-inline-flex align-items-center justify-content-center align-self-center" href="{{ route('profile.edit') }}">Edit Profile<i class="fa-regular fa-pen-to-square ms-2"></i></a>
      </div>
   @endif
   <div class="mb-4 text-center " >
      @php
         $image = $user -> profile -> image == null ?
          'default-user-image.jpg' : 
         $user -> profile -> image
      @endphp
      <img class="rounded" width="100" height="100" src="{{ asset('assets/img/users')}}/{{ $image }}" alt="user image">  
   </div>
   <div class="col-md-8">

         @if(session()->has('success'))
               <div class="alert alert-success">
                  {{ session()->get('success') }}
               </div>
         @endif

         <div class="card mb-4">
            <div class="card-header">Name</div>

            <div class="card-body">
               {{ $user -> name }}
            </div>
         </div>
         <div class="card mb-4">
            <div class="card-header">Email Address</div>

            <div class="card-body">
               {{ $user -> email }}
            </div>
         </div>
         <div class="card mb-4">
            <div class="card-header">Phone Number</div>

            <div class="card-body">
               {{ $user -> profile -> phone_number }}
            </div>
         </div>


         <div class="card mb-4">
            <div class="card-header">Join Date</div>

            <div class="card-body">
               {{ $user -> created_at }}
            </div>
         </div>



   </div>
</div>
</div>


   @include('layouts.footer')


@endsection
