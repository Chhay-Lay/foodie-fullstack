@extends('layouts.profile')

@section('content')
<div class="w-full p-4">
  <div class="text-2xl bg-white w-full p-4 rounded">
    <i class="fas fa-pager"></i>
    <span class="ml-1">Reported Post</span>
  </div>
    <div class="bg-white p-4 mt-4 rounded">
      <ul>
      @foreach ($reportedPosts as $reportedPost)
        <li class="bg-gray-300 mb-3 p-4 rounded flex justify-between">
          <div class="flex space-x-4 items-center">
            <i class="fas fa-exclamation-circle text-2xl"></i>
            <div>
              <a href="{{ route('post.detail', $reportedPost->post_id) }}" target="_blank" class="font-semibold text-lg hover:text-blue-500">{{ App\Models\Post::find($reportedPost->post_id)->title }} <span class="text-sm text-gray-600">reported by {{ App\Models\User::find($reportedPost->user_id)->name}}</span></a>
              <p>{{ $reportedPost->body}}</p>
            </div>
          </div>
          @if($reportedPost->is_accepted)
            <button button type="button" disabled class="{{ ($reportedPost->is_accepted ? "bg-green-400" : "bg-red-400") }} p-3 rounded-lg">{{ $reportedPost->is_accepted === 1 ? "Accepted" : "Rejected" }}</button>
          @else
            @if(auth()->user()->is_admin === 1)
              <form action="{{ route('report.updateReportStatus', $reportedPost->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" name="is_accepted" value="0" onclick="return confirm('Are you sure to reject?')" class="bg-red-400 p-3 rounded-lg">Reject</button>
                <button type="submit" name="is_accepted" value="1" onclick="return confirm('Are you sure to accept?')" class="bg-green-400 p-3 rounded-lg">Accept</button>
              </form>
            @else
              <button type="button" disabled class="p-3 rounded-lg" style="background-color: orange">Pending</button>
            @endif
          @endif
        </li>
      @endforeach
      </ul>
    </div>
  </div>
@endsection