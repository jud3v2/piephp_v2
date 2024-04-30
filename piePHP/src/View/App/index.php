@isset($message)
    <div class="container m-5">
        <div class="bg-blue-100 rounded w-full py-2 px-3">
            <p>{{ $message }}</p>
        </div>
    </div>
@endisset

<div class="container m-5">
    <a href="/movie/create">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Ajouter un film
        </button>
    </a>
</div>

@isset($movies)
<table class="table-auto w-full m-5 px-3">
    <thead>
    <tr>
        <th class="w-42 float-left">Titre</th>
        <th class="w-24">Durée</th>
        <th class="w-96">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($movies as $movie)
        <tr class="mt-2">
            <td class="mt-2">{{ $movie['title'] }}</td>
            <td class="mt-2">{{ $movie['duration'] }}</td>
            <td class="mt-2">
                <a href="/movie/{{ $movie['id'] }}" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Voir</a>
                <a href="/movie/delete/{{ $movie['id'] }}" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</a>
                <a href="/movie/update/{{ $movie['id'] }}" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifier</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endisset