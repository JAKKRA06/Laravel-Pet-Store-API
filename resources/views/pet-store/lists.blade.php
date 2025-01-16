<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witaj w PetStore!</title>
	<link rel="stylesheet" href="http://localhost:5173/resources/css/app.css">
</head>
<body>
    <nav>
        <a href="{{ route('pet.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
            Powrót do listy
        </a>
    </nav>
    <div class="container">
        <h1 class="text-2xl font-bold">Pet list:</h1>
            <form action="{{ route('pet.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nazwa</label>
                    <input type="text" name="name" id="name" class="mt-1 block p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="photoUrls" class="block text-sm font-medium text-gray-700">Linki do zdjęć</label>
                    <input type="text" name="photoUrls" id="photoUrls" class="mt-1 block p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tagi</label>
                    <input type="text" name="tags" id="tags" class="mt-1 block p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block p-2 border border-gray-300 rounded-md" required>
                        <option value="active">available</option>
                        <option value="inactive">pending</option>
                        <option value="inactive">sold</option>
                    </select>
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Zapisz</button>
                </div>
            </form>
    </div>
</body>
</html>
