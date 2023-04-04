@props(['ingredients'])

<div class="mt-8">
  <h3 class="underline space-x-2 text-center font-semibold text-xl mb-3"><i class="fas fa-flask"></i><span>Ingredients:</span></h3>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-center">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
          {{-- <th scope="col" class="px-6 py-3"></th> --}}
          <th scope="col" class="px-6 py-3">Ingredient</th>
          <th scope="col" class="px-6 py-3">Amount</th>
          <th scope="col" class="px-6 py-3">Unit</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($ingredients as $ingredient)
        <tr>
          {{-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"><i class="fas fa-flask"></i></th> --}}
          <td class="px-6 py-4"><span>{{json_decode($ingredient)->name}}</span></td>
          <td class="px-6 py-4"><span>{{json_decode($ingredient)->amount}}</span></td>
          <td class="px-6 py-4"><span>{{@json_decode($ingredient)->unit}}</span></td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>