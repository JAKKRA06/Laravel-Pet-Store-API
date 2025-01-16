<!DOCTYPE html>
<html lang='en'>
   <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>Welcome to PetStore!</title>
      <link rel='stylesheet' href='http://localhost:5173/resources/css/app.css'>
   </head>
   <body>
      <nav>
         <a href="{{ route('pet.index') }}" class='bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600'>
         Back
         </a>
      </nav>
      <div class='container mx-auto'>
         <h2 class='text-2xl font-bold mb-4 mt-2'>Sold pet list</h2>
         <div class='container text-center mt-4 p-2'>
            @if ($errors->any())
            <div class="text-red-400 font-bold">
               <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
            @endif
            @if (session('error'))
            <div class='text-red-400 font-bold'>
               {{ session('error') }}
            </div>
            @elseif(session('success'))
            <div class='text-green-400 font-bold'>
               {{ session('success') }}
            </div>
            @endif
         </div>
         <div id='compact-table'>
            <table class='min-w-full table-auto text-sm border-collapse border border-gray-300'>
               <thead class='bg-gray-200'>
                  <tr>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>ID</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Name</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Category Name</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Status</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Tags</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Photo URLs</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($sold as $pet)
                  <tr>
                     <td class='px-2 py-1 border border-gray-300'>{{ $pet['id'] }}</td>
                     <td class='px-2 py-1 border border-gray-300'>{{ $pet['name'] ?? 'No name' }}</td>
                     <td class='px-2 py-1 border border-gray-300'>{{ $pet['category']['name'] ?? 'No category name' }}</td>
                     <td class='px-2 py-1 border border-gray-300'>{{ $pet['status'] }}</td>
                     <td class='px-2 py-1 border border-gray-300'>
                        @foreach($pet['tags'] as $tag)
                        <span class='inline-block bg-blue-200 px-1 py-0.5 text-blue-800 rounded-full text-xs mr-1'>{{ $tag['name'] ?? 'No tag name' }}</span>
                        @endforeach
                     </td>
                     <td class='px-2 py-1 border border-gray-300'>
                        @if (!empty($pet['photoUrls']))
                        @foreach($pet['photoUrls'] as $url)
                        <span class='inline-block bg-blue-200 px-1 py-0.5 text-blue-800 rounded-full text-xs mr-1'>{{ $url }}</span>
                        @endforeach
                        @else
                        <p>No url</p>
                        @endif
                     </td>
                     <td class="px-2 py-1">
                        <a class='inline-block px-3 py-1 bg-blue-500 text-white text-xs rounded-xs shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2' href="{{ route('pet.edit', $pet['id']) }}">Edit</a>
                        <form class="inline px-2 p-1" method="POST" action="{{ route ('pet.destroy', $pet['id'])}}" onsubmit="return confirm('Are you sure you want to delete this item?');">
                           @csrf
                           @method('DELETE')  
                           <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-xs text-xs hover:bg-blue-600">Delete</button>
                        </form>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         <h2 class='text-2xl font-bold mb-4 mt-2'>Pending pet list</h2>
         <div id='compact-table'>
            <table class='min-w-full table-auto text-sm border-collapse border border-gray-300'>
               <thead class='bg-gray-200'>
                  <tr>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>ID</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Name</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Category Name</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Status</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Tags</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Photo URLs</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($pending as $pet)
                  <tr>
                     <td class='px-2 py-1 border border-gray-300'>{{ $pet['id'] }}</td>
                     <td class='px-2 py-1 border border-gray-300'>{{ $pet['name'] ?? 'No name' }}</td>
                     <td class='px-2 py-1 border border-gray-300'>{{ $pet['category']['name'] ?? 'No category name' }}</td>
                     <td class='px-2 py-1 border border-gray-300'>{{ $pet['status'] }}</td>
                     <td class='px-2 py-1 border border-gray-300'>
                        @foreach($pet['tags'] as $tag)
                        <span class='inline-block bg-blue-200 px-1 py-0.5 text-blue-800 rounded-full text-xs mr-1'>{{ $tag['name'] ?? 'No tag name' }}</span>
                        @endforeach
                     </td>
                     <td class='px-2 py-1 border border-gray-300'>
                        @if (!empty($pet['photoUrls']))
                        @foreach($pet['photoUrls'] as $url)
                        <span class='inline-block bg-blue-200 px-1 py-0.5 text-blue-800 rounded-full text-xs mr-1'>{{ $url }}</span>
                        @endforeach
                        @else
                        <p>No url</p>
                        @endif
                     </td>
                     <td class="px-2 py-1">
                        <a class='inline-block px-3 py-1 bg-blue-500 text-white text-xs rounded-xs shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2' href="{{ route('pet.edit', $pet['id']) }}">Edit</a>
                        <form class="inline px-2 p-1" method="POST" action="{{ route ('pet.destroy', $pet['id'])}}" onsubmit="return confirm('Are you sure you want to delete this item?');">
                           @csrf
                           @method('DELETE')  
                           <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-xs text-xs hover:bg-blue-600">Delete</button>
                        </form>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         <h2 class='text-2xl font-bold mb-4 mt-2'>Available pet list</h2>
         <div id='compact-table'>
            <table class='min-w-full table-auto text-sm border-collapse border border-gray-300'>
               <thead class='bg-gray-200'>
                  <tr>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>ID</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Name</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Category Name</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Status</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Tags</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Photo URLs</th>
                     <th class='px-2 py-1 text-left border border-gray-300 max-w-xs'>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($available as $pet)
                  <tr>
                     <td class='px-2 py-1 border border-gray-300'>{{ $pet['id'] }}</td>
                     <td class='px-2 py-1 border border-gray-300 break-all'>{{ $pet['name'] ?? 'No name' }}</td>
                     <td class='px-2 py-1 border border-gray-300 break-all'>{{ $pet['category']['name'] ?? 'No category name' }}</td>
                     <td class='px-2 py-1 border border-gray-300 break-all'>{{ $pet['status'] }}</td>
                     <td class='px-2 py-1 border border-gray-300 break-all'>
                        @foreach($pet['tags'] as $tag)
                        <span class='inline-block bg-blue-200 px-1 py-0.5 text-blue-800 rounded-full text-xs mr-1'>{{ $tag['name'] ?? 'No tag name' }}</span>
                        @endforeach
                     </td>
                     <td class='px-2 py-1 border border-gray-300 break-all'>
                        @if (!empty($pet['photoUrls']))
                        @foreach($pet['photoUrls'] as $url)
                        <span class='inline-block bg-blue-200 px-1 py-0.5 text-blue-800 rounded-full text-xs mr-1'>{{ $url }}</span>
                        @endforeach
                        @else
                        <p>No url</p>
                        @endif
                     </td>
                     <td class="px-2 py-1">
                        <a class='inline-block px-3 py-1 bg-blue-500 text-white text-xs rounded-xs shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2' href="{{ route('pet.edit', $pet['id']) }}">Edit</a>
                        <form class="inline px-2 p-1" method="POST" action="{{ route ('pet.destroy', $pet['id'])}}" onsubmit="return confirm('Are you sure you want to delete this item?');">
                           @csrf
                           @method('DELETE')  
                           <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-xs text-xs hover:bg-blue-600">Delete</button>
                        </form>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </body>
</html>