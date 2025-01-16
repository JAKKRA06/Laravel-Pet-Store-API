<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Edit Pet</title>
    <link rel='stylesheet' href='http://localhost:5173/resources/css/app.css'>
</head>
<body>
    <nav>
        <a href="{{ route('pet.show.all') }}" class='bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600'>
            Back
        </a>
    </nav>

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
    <div class='container mx-auto'>
        <h2 class='text-2xl font-bold mb-4 mt-2'>
            @if (!empty($pet['id']))
                Edit Pet ID: {{ $pet['id'] }}
            @endif
        </h2>
        <form action="{{ route('pet.update', $pet['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div id='compact-table'>
                <table class='min-w-full table-auto text-sm border-collapse border border-gray-300'>
                    <thead class='bg-gray-200'>
                        <tr>
                            <th class='px-2 py-1 text-left border border-gray-300'>Field</th>
                            <th class='px-2 py-1 text-left border border-gray-300'>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='px-2 py-1 border border-gray-300'>ID</td>
                            <td class='px-2 py-1 border border-gray-300'>{{ $pet['id'] }}</td>
                        </tr>
                        <tr>
                            <td class='px-2 py-1 border border-gray-300'>Name</td>
                            <td class='px-2 py-1 border border-gray-300'>
                                <input type="text" name="name" value="{{ $pet['name'] ?? '' }}" class="border rounded-md px-2 py-1 w-full">
                            </td>
                        </tr>
                        <tr>
                            <td class='px-2 py-1 border border-gray-300'>Category Name</td>
                            <td class='px-2 py-1 border border-gray-300'>
                                <input type="text" name="category[name]" value="{{ $pet['category']['name'] ?? '' }}" class="border rounded-md px-2 py-1 w-full">
                            </td>
                        </tr>
                        <tr>
                            <td class='px-2 py-1 border border-gray-300'>Status</td>
                            <td class='px-2 py-1 border border-gray-300'>
                                <select name="status" class="border rounded-md px-2 py-1 w-full">
                                    <option value="available" {{ $pet['status'] === 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="pending" {{ $pet['status'] === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="sold" {{ $pet['status'] === 'sold' ? 'selected' : '' }}>Sold</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class='px-2 py-1 border border-gray-300'>Tags</td>
                            <td class='px-2 py-1 border border-gray-300'>
                                <textarea name="tags" class="border rounded-md px-2 py-1 w-full">{{ implode(', ', array_column($pet['tags'] ?? [], 'name')) }}</textarea>
                                <p class="text-xs text-gray-500">Separate tags with commas.</p>
                            </td>
                        </tr>
                        <tr>
                            <td class='px-2 py-1 border border-gray-300'>Photo URLs</td>
                            <td class='px-2 py-1 border border-gray-300'>
                                <textarea name="photoUrls" class="border rounded-md px-2 py-1 w-full">{{ implode(', ', $pet['photoUrls'] ?? []) }}</textarea>
                                <p class="text-xs text-gray-500">Separate URLs with commas.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
