@extends('layouts.app')


@section('title')
   <title>Edit - password</title>
@endsection

@section('content')

   @include('layouts.nav-bar')

   <div style="padding-top: 200px" class="container">

      @if(session()->has('success'))
         <div class="alert alert-success">
            {{ session()->get('success') }}
         </div>
      @endif

      @if($errors->any())
         @foreach($errors->all() as $error)
            <div class="alert alert-danger" >{{ $error }}</div>
         @endforeach
      @endif



      <form class="mb-3" action="{{ route('profile.update.password') }}" method="POST" enctype='multipart/form-data' >
      @csrf
         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Old Password</label>
            <input placeholder=". . ." value="" type="password" name="old_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>

         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">New Password</label>
            <input placeholder=". . ." type="password" value="" name="new_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>

         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Confirmation Password</label>
            <input placeholder=". . ." type="password" value="" name="confirmation_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>

         <button type="submit" class="getstarted m-0 border-0">Save</button>

      </form>


   </div>
   @include('layouts.footer')
@endsection