<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Welcome to PetStore!</title>
    <!-- <link rel='stylesheet' href='{{ asset('css/app.css') }}'> -->
    <link rel='stylesheet' href='http://localhost:5173/resources/css/app.css'>
</head>
<body>
    <div class='container text-center p-2 m-2'>
        <h1 class='text-2xl font-bold p-2'>Welcome in PetStore!</h1>
        <h3 class='text-xl font-bold mb-2 p-2'>Select your action:</h3>
        <ol class='p-2'>
        	<li><a href="{{ route('pet.show.all') }}" class='inline-block px-4 py-2 bg-blue-500 text-white font-semibold text-sm rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2'>1. Get pets by status</a></li> 
        	<li><a href="{{ route('pet.create') }}" class='inline-block mt-2 px-4 py-2 bg-blue-500 text-white font-semibold text-sm rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2'>2. Add new pet</a></li> 
        </ol>
        <div class='container text-center mt-4 p-2'>
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
    </div>
</body>
</html>
