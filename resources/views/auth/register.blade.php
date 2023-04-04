@extends('layouts.app')

@section('content')
  <div class="flex justify-center w-full h-screen">
    <div class="bg-white p-8 mt-[100px] rounded-lg shadow-xl h-fit w-7/12 md:w-6/12 lg:w-5/12 xl:w-4/12 2xl:w-3/12">
      <h2 class="font-medium leading-tight text-center text-4xl mt-0 mb-4">Register</h2>
      <form method="POST" action="{{ route('register') }}">
        <div class="relative">
          <label for="name" class="sr-only">Your name</label>
          <span class="pointer-events-none w-8 text-gray-500 absolute top-1/2 transform -translate-y-1/2 left-3"><i class="fas fa-user"></i></span>
          <input type="text" name="name" id="name" class="bg-gray-100 w-full py-4 pl-8 border-2 rounded-lg shadow-inner @error('name') border-red-500 @enderror" placeholder="Choose a name" value="" >
        </div>
        @error('name')
          <div class="my-2 text-red-500 text-sm">
            {{ $message }}
          </div>
        @enderror
        <div class="mt-4 relative">
          <label for="email" class="sr-only">Email</label>
          <span class="pointer-events-none w-8 text-gray-500 absolute top-1/2 transform -translate-y-1/2 left-3"><i class="fas fa-envelope"></i></span>
          <input type="email" name="email" id="email" class="bg-gray-100 w-full py-4 pl-8 border-2 rounded-lg shadow-inner @error('email') border-red-500 @enderror" placeholder="Put your email" value="">
        </div>
        @error('email')
          <div class="my-2 text-red-500 text-sm">
            {{ $message }}
          </div>
        @enderror
        <div class="mt-4 relative">
          <label for="password" class="sr-only">Password</label>
          <span class="pointer-events-none w-8 text-gray-500 absolute top-1/2 transform -translate-y-1/2 left-3"><i class="fas fa-lock"></i></span>
          <input type="password" name="password" id="password" class="bg-gray-100 w-full py-4 pl-8 border-2 rounded-lg shadow-inner @error('password') border-red-500 @enderror" placeholder="Choose a password" value="">        
        </div>
        @error('password')
          <div class="my-2 text-red-500 text-sm">
            {{ $message }}
          </div>
        @enderror
        <div class="my-4 relative">
          <label for="password_confirmation" class="sr-only">Password confirmation</label>
          <span class="pointer-events-none w-8 text-gray-500 absolute top-1/2 transform -translate-y-1/2 left-3"><i class="fas fa-lock"></i></span>
          <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-100 w-full py-4 pl-8 border-2 rounded-lg shadow-inner @error('email') border-red-500 @enderror" placeholder="Enter the password again" value="">
        </div>
        <button type="submit" class="bg-green-500 font-bold text-white text-xl uppercase p-4 mt-4 w-full rounded shadow-md mb-4">Register</button>
        {{-- <div class="flex justify-center text-gray-600 mb-4">
          or connect with
        </div>
        <button type="button" class="bg-blue-500 font-bold text-white text-xl uppercase p-4 w-full rounded shadow-md">
          <a href="/sign-in/facebook">
            <i class="fab fa-facebook-square"></i>
            <span class="ml-2">Facebook</span>
          </a>
        </button> --}}
      </form>
    </div>
  </div>
@endsection