@extends('layouts.dashboard')

@section('content')
<div class="w-full p-4">
  <div class="text-2xl bg-white w-full p-4 rounded">
    <i class="fas fa-boxes"></i>
    <span class="ml-1">Category</span>
  </div>

  @if (Session::has('message'))
      
  <div class="p-4 mt-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
    <span class="font-medium">Success alert!</span> {{Session::get('message')}}
  </div>
  @endif

  <div class="w-full mt-4 shadow-md rounded-lg">
    <div class="flex justify-between items-center p-4 bg-gray-100 rounded-t-lg">
      <h2>All categories</h2>
      <a
        href="{{ route('dashboard.category.add') }}"
        data-mdb-ripple="true"
        data-mdb-ripple-color="light"
        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
        >Add category</a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-b-lg">
      <table class="table-auto bg-white w-full">
        <thead class="border-b bg-gray-50">
          <tr>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-center">#</th>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-center">Section</th>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-center">Created at</th>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-center">Updated at</th>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-center">Action</th>
          </tr>
        </thead>
        <tbody>        
          @foreach ($categories as $category)
          <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-600">
            <th class="text-sm font-normal text-gray-900 px-6 py-4 text-center">
              {{ $loop->index+1 }}
            </th>
            <td class="text-sm font-normal text-gray-900 px-6 py-4 text-center">
              {{ $category->section }}
            </td>
            <td class="text-sm font-normal text-gray-900 px-6 py-4 text-center">
              {{ $category->created_at->diffForHumans() }}
            </td>
            <td class="text-sm font-normal text-gray-900 px-6 py-4 text-center">
              {{ $category->updated_at->diffForHumans() }}
            </td>
            <td class="py-2">
              @if($errors->any())
              <script>
                alert('{{ $errors->all()[0] }}');
              </script>
              @endif
              <div class="flex justify-center space-x-4">
                <a href="{{ route('dashboard.category.edit', $category->id) }}" class="focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Edit</a>
                <form action="{{ route('dashboard.category.remove', $category->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  <div class="mt-2">
    {{-- {{ $categories->links() }} --}}
  </div>
</div>
@endsection