@extends('layouts.app')

@section('content')
  <div class="flex justify-center w-full h-screen">
    <div class="bg-white p-8 mt-[100px] rounded-lg shadow-xl w-7/12 h-fit md:w-6/12 lg:w-5/12 xl:w-4/12 2xl:w-3/12">
      <form method="POST" action="{{ route('login') }}">
        <h2 class="font-medium leading-tight text-center text-4xl mt-0 mb-4">Login</h2>
        <div class="relative">
          <label for="email" class="sr-only">Email</label>
          <span class="pointer-events-none w-8 text-gray-500 absolute top-1/2 transform -translate-y-1/2 left-3"><i class="fas fa-envelope"></i></span>
          <input type="email" name="email" id="email" class="bg-gray-100 w-full py-4 pl-8 border-2 rounded-lg shadow-inner @error('email') border-red-500 @enderror" placeholder="Put your email" value="{{ old('email') }}" required>
        </div>
        @error('email')
          <div class="my-2 text-red-500 text-sm">
            {{ $message }}
          </div>
        @enderror
        <div class="my-4 relative">
          <label for="password" class="sr-only">Password</label>
          <span class="pointer-events-none w-8 text-gray-500 absolute top-1/2 transform -translate-y-1/2 left-3"><i class="fas fa-lock"></i></span>
          <input type="password" name="password" id="password" class="bg-gray-100 w-full py-4 pl-8 border-2 rounded-lg shadow-inner @error('email') border-red-500 @enderror" placeholder="Choose a password" value="">
        </div>
        @error('email')
          <div class="my-2 text-red-500 text-sm">
            {{ $message }}
          </div>
        @enderror
        <div class="mb-4 flex justify-between">
          <div class="flex items-center">
            <input type="checkbox" name="remember" id="remember" class="mr-2">
            <label for="remember">Remember me</label>
          </div>
          <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Forgot your password?</a>
        </div>
        <button type="submit" class="bg-green-500 font-bold text-white text-xl uppercase p-4 w-full rounded shadow-md mb-4">Login</button>
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