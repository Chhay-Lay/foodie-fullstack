@props(['id', 'toggle_id', 'post'])

<div>
  <button id="{{ $id }}" data-dropdown-toggle="{{ $toggle_id }}" type="button"><i class="fas fa-ellipsis-h"></i></button>
  <!-- Dropdown menu -->
  <div id="{{ $toggle_id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded drop-shadow-md w-44">
      <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{ $id }}">
        @php
          // dd(auth()->user()->isAdmin);
        @endphp
        @if ($post->ownedBy(auth()->user()) || auth()->user()->isAdmin)
          <li>
            <form action="{{ route('post.delete', $post->id) }}" method="POST"  class="block px-4 py-2 hover:bg-gray-100">
              @csrf
              @method('DELETE')
              <button onclick="return confirm('Are you sure?')" type="submit" class="flex space-x-2 items-center w-full"><i class="fas fa-trash-alt mr-1"></i><span>Delete Post</span></button>
            </form>
          </li>
          <li>
            <a href="{{ route('post.edit', $post->id) }}" class="block px-4 py-2 hover:bg-gray-100 flex space-x-2 items-center"><i class="fas fa-edit"></i><span>Edit post</span></a>
          </li>
        @else
          <li>
            <a href="{{route('post.report', $post->id)}}" class="block px-4 py-2 hover:bg-gray-100 flex space-x-2 items-center"><i class="far fa-flag"></i><span>Report Post</span></a>
          </li>
          <li>
            <form action="{{ route('add.favourite', $post->id) }}" method="POST"  class="block px-4 py-2 hover:bg-gray-100">
              @csrf
              <button type="submit" class="flex space-x-2 items-center w-full"><i class="far fa-bookmark mr-1"></i><span>Save Post</span></button>
            </form>
          </li>
        @endif
      </ul>
  </div>
</div>