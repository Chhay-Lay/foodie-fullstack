@props(['post', 'ingredients'])

<div class="shadow-md p-2 rounded">
  <img class="object-cover w-full h-96" src="{{ ($post->image_url) ? Storage::disk('local')->url($post->image_url, '+2 minutes') : '#' }}" alt="">
  <div class="flex flex-col items-center bg-green-50 p-4">
    <div class="text-xl font-bold mb-2">{{ $post->title}}</div>
    <div class="text-center">{{ $post->description }}</div>
  </div>
</div>
<div class="relative overflow-x-auto mt-3 shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-600">
    <tbody>
      <tr class="bg-white border-b">
        <td class="px-6 py-4 space-y-2 border-r">
          <div>Skill level: <span class="text-black">{{ucfirst($post->skill_level)}}</span></div>
          <div>No. of Ingredients: <span class="text-black">{{count($ingredients)}}</span></div>
        </td>
        <td class="px-6 py-4 space-y-2 border-r">
          <div>Preparation: <span class="text-black">{{ucfirst($post->preparation_time)}} min</span></div>
          <div>Cooking: <span class="text-black">{{ucfirst($post->cooking_time)}} min</span></div>
        </td>
        <td class="px-6 py-4 space-y-2">
          <div>Total time: </div>
          <div>Riew: </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>