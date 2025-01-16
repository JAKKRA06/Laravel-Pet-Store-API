<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Welcome in PetStore!</title>
      <link rel="stylesheet" href="http://localhost:5173/resources/css/app.css">
   </head>
   <body>
      <nav class="mb-4">
         <a href="{{ route('pet.index') }}" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 text-sm">
         Back
         </a>
      </nav>
      <div class="container max-w-md mx-auto">
         <h1 class="text-lg font-semibold mb-4">Add new pet</h1>
         <form action="{{ route('pet.store') }}" method="POST" class="space-y-3">
            @csrf
            @if ($errors->any())
            <div class="alert text-red-400">
               <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
            @endif
            <div class="text-sm">
               <label for="name" class="block font-medium mb-1">Name</label>
               <input type="text" name="name" id="name" class="block w-full px-2 py-1 border border-gray-300 rounded text-sm" required value="{{ old('name') }}">
            </div>
            <div class="text-sm">
               <label for="photoUrls" class="block font-medium mb-1">Photo urls (separate by comma)</label>
               <input type="text" name="photoUrls" id="photoUrls" class="block w-full px-2 py-1 border border-gray-300 rounded text-sm" required value="{{ old('photoUrls') }}">
            </div>
            <div class="text-sm">
               <label for="tags" class="block font-medium mb-1">Tags (separate by comma)</label>
               <input type="text" name="tags" id="tags" class="block w-full px-2 py-1 border border-gray-300 rounded text-sm" value="{{ old('tags') }}">
            </div>
            <div class="text-sm">
               <label for="cat-name" class="block font-medium mb-1">Category name</label>
               <input type="text" name="category[name]" id="cat-name" class="block w-full px-2 py-1 border border-gray-300 rounded text-sm">
            </div>
            <div class="text-sm">
               <label for="status" class="block font-medium mb-1">Status</label>
               <select name="status" id="status" class="block w-full px-2 py-1 border border-gray-300 rounded text-sm">
                  <option value="available">available</option>
                  <option value="pending">pending</option>
                  <option value="sold">sold</option>
               </select>
            </div>
            <div>
               <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">Submit</button>
            </div>
         </form>
      </div>
   </body>
</html>