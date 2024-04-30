<div class="mt-3 mb-2">
        <h1 class="text-center text-4xl font-bold">Gestion des genres</h1>
</div>

@isset($message)
<div class="container mx-auto my-4">
        <div class="bg-green-100 border border-green-400 text-green-700
         px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Succès!</strong>
                <span class="block sm:inline">{{ $message }}</span>
        </div>
</div>
@endisset
@isset($error)
<div class="container mx-auto my-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3
         rounded relative" role="alert">
                <strong class="font-bold">Erreur!</strong>
                <span class="block sm:inline">{{ $error }}</span>
        </div>
</div>
@endisset
@isset($success)
<div class="container mx-auto my-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4
         py-3 rounded relative" role="alert">
                <strong class="font-bold">Succès!</strong>
                <span class="block sm:inline">{{ $success }}</span>
        </div>
</div>
@endisset

<div class="container my-4 mx-auto">
        <a href="/genre/create">
                <button class="py-3 px-2 bg-blue-500 rounded text-white
                hover:bg-blue-700">Créé un nouveau genre</button>
        </a>
</div>

<div class="container grid grid-cols-4 gap-4 mx-auto my-4">
    @foreach($genres as $genre)
    <a href="/genre/{{ $genre->id }}"
       class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow
        hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $genre->name }}</h5>
            <div>
                    <p>
                            <span class="font-semibold">Nombre de films:</span> {{ count($genre->movies ?? []) }}
                    </p>
            </div>
    </a>
    @endforeach
</div>
