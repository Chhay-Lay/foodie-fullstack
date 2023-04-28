@extends('layouts.app')

@section('content')
    <div class="p-6 h-screen flex flex-col items-center w-full py-8 px-20">
      <div class=" w-8/12 p-4 mb-4 bg-white text-lg rounded">
        Report Post ({{$post->title}})
      </div>
      <form action="{{ route('report.create', $post) }}" method="POST" class="w-8/12">
        @csrf
        <p class="mb-2"><i class="fas fa-exclamation-circle"></i> Please tell us the reasons</p>
        <textarea name="body" id="report" cols="30" rows="10" class="border-2 p-2 w-full border-gray-500 rounded"></textarea>
        <button type="submit" class="bg-yellow-500 text-black p-2 rounded">Submit Report</button>
      </form>
    </div>
@endsection