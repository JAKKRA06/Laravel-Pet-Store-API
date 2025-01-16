<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witaj w PetStore!</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Witaj w PetStore!</h1>

        <!-- Formularz dodawania nowego zwierzaka -->
        <section>
            <h2>Dodaj nowego zwierzaka</h2>
            <form action="{{ route('pets.store') }}" method="POST">
                @csrf
                <div>
                    <label for="name">Imię zwierzaka:</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div>
                    <label for="type">Typ zwierzaka:</label>
                    <input type="text" name="type" id="type" required>
                </div>
                <button type="submit">Dodaj</button>
            </form>
        </section>

        <!-- Formularz wyświetlania listy wszystkich zwierzaków -->
        <section>
            <h2>Wyświetl listę wszystkich zwierzaków</h2>
            <form action="{{ route('pets.index') }}" method="GET">
                <button type="submit">Pokaż zwierzaki</button>
            </form>
        </section>

        <!-- Formularz usuwania konkretnego zwierzaka -->
        <section>
            <h2>Usuń konkretnego zwierzaka</h2>
            <form action="{{ route('pets.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <div>
                    <label for="pet_id">ID zwierzaka:</label>
                    <input type="number" name="pet_id" id="pet_id" required>
                </div>
                <button type="submit">Usuń</button>
            </form>
        </section>

        <!-- Formularz edycji konkretnego zwierzaka -->
        <section>
            <h2>Edytuj konkretnego zwierzaka</h2>
            <form action="{{ route('pets.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_pet_id">ID zwierzaka:</label>
                    <input type="number" name="pet_id" id="edit_pet_id" required>
                </div>
                <div>
                    <label for="new_name">Nowe imię:</label>
                    <input type="text" name="name" id="new_name">
                </div>
                <div>
                    <label for="new_type">Nowy typ:</label>
                    <input type="text" name="type" id="new_type">
                </div>
                <button type="submit">Edytuj</button>
            </form>
        </section>
    </div>
</body>
</html>
