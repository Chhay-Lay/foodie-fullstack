@props(['post'])

<div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
  <a href="{{ route('post.detail', $post->id) }}">
      <img class="h-48 w-full rounded-t-lg" src="{{ ($post->image_url) ? Storage::disk('local')->url($post->image_url, '+2 minutes') : "#" }}" alt="" />
  </a>
  <div class="p-5">
      <div class="flex space-x-2 items-center mb-4 md:text-sm md:space-x-1">
          <img class="w-8 h-8 rounded-full" src="https://cdn-icons-png.flaticon.com/512/147/147142.png" alt="">
          <h3>{{$post->user->name}}</h3>  
          <div class="text-sm text-slate-400">posted {{ $post->created_at->diffForHumans() }}</div>
      </div>
      <a href="{{ route('post.detail', $post->id) }}">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $post->title }}</h5>
      </a>
      <p class="h-28 border-b overflow-hidden text-left mb-3 font-normal text-gray-700">{{ $post->description }}</p>
      <div class="mb-4">
          @if ($post->category_id)
            @foreach ($post->category_id as $id)
            <span class="px-2 py-1 bg-gradient-to-r from-cyan-500 to-green-500 text-sm text-white rounded-md">{{ App\Models\Category::getNameById($id) }}</span>
            @endforeach
          @endif
      </div>
      <div class="flex justify-between">
          <div class="space-x-1">
              <i class="far fa-clock"></i>
              <span>{{ $post->preparation_time + $post->cooking_time}} {{ Str::plural('min', $post->cooking_time+$post->preparation_time) }}</span>
          </div>
          {{-- @php
              dd($post);
          @endphp --}}
          <div class="text-yellow-400">
              <i class="fas fa-star"></i>
              {{ $post->review }}
          </div>
      </div>
  </div>
</div>