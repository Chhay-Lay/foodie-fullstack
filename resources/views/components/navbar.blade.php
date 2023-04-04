<nav class="top-0 sticky z-40 flex justify-between items-center bg-green-100 px-8 py-6 bg-opacity-80 backdrop-filter backdrop-blur shadow-md">
  <div class="flex items-center space-x-4">
      <a href="/" class="uppercase text-2xl font-bold">Foodie</a>
      <a href="{{ route('listing') }}">List</a>
      <a href="{{ route('post') }}">Post</a>
  </div>
  <div>
      <form action="/listing">
          <div class="relative">
              <label for="search" class="sr-only">search</label>
              <span class="pointer-events-none w-8 text-gray-500 absolute top-1/2 transform -translate-y-1/2 left-3"><i class="fas fa-search"></i></span>
              <input type="text" name="search" id="search" class="border-2 text-lg py-1 pl-8 rounded-lg shadow-inner" placeholder="Find food recipe">
          </div>
      </form>
  </div>
  <div class="flex items-center space-x-4">
      @auth

      @can('access-dashboard')
          <a href="{{ route('dashboard') }}">Dashboard</a>
      @endcan

        {{-- <button id="notify-bell" data-dropdown-toggle="notify-dropdown" type="button"><i class="far fa-bell"></i></button> --}}
        <!-- Dropdown menu -->
        {{-- <div id="notify-dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow">
            <p class="p-2 text-sm">Notification list: </p>
            <ul class="p-3 text-sm text-gray-700 space-y-4" id="notify-body" aria-labelledby="notify-bell">
            </ul>
        </div> --}}

      <a href="{{ route('profile') }}"> {{ auth()->user()->name }} <span id="notification_counter"></span></a>
      <div>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
          </form>
      </div>
      @endauth
      
      @guest
      <a href="{{ route('login') }}">Login</a>
      <a href="{{ route('register') }}">Register</a>
      @endguest
  </div>
</nav>