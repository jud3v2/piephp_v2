<form action="/movie/create-with-distributor" method="POST">
        <div class="container w-full relative">
                <div>
                        <h1 class="text-4xl font-bold text-center my-5">Créer un film</h1>
                </div>

                <div>
                        <h2 class="text-4xl font-bold text-center my-5">Qui à distribué le film ?</h2>
                </div>

                <div class="container flex justify-center">
                        <div class="w-full max-w-lg">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="distributor_name">
                                                        Nom
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" type="text" name="name" placeholder="ex: Warner Bros">
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                                        N° de téléphone
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="director" name="phone" type="text" placeholder="ex: 07.68.52.41.59">
                                        </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                                                        Adresse
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="address" name="address" type="text" placeholder="17 rue de paris, 75005 Paris">
                                        </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2">
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zipcode">
                                                        Code postal
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="duration" name="zipcode" type="text" min="1" max="5" placeholder="120">
                                        </div>
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                                                        Ville
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="duration"  name="city" type="text" min="1" placeholder="120">
                                        </div>
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="country">
                                                        Pays
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="country" type="text" name="country" placeholder="19/01/2023">
                                        </div>
                                </div>
                        </div>
                </div>

                <div>
                        <h2 class="text-4xl font-bold text-center my-5">Description du film</h2>
                </div>


                <div class="container flex justify-center">
                        <div class="w-full max-w-lg">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                                                        Titre
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" type="text" name="title" placeholder="Titre de votre film">
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="director">
                                                        Directeur (Nom, Prénom)
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="director" name="director" type="text" placeholder="John, Doe">
                                        </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2">
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="duration">
                                                        Durée (ex: 120)
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="duration" value="1" name="duration" type="number" min="1" placeholder="120">
                                        </div>
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="rating">
                                                        Classement
                                                </label>
                                                <div class="relative">
                                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="rating" name="rating">
                                                                <option>G</option>
                                                                <option>PG</option>
                                                                <option>PG-13</option>
                                                                <option>R</option>
                                                                <option>NR</option>
                                                        </select>
                                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="release_date">
                                                        Date de sortie
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="release_date" type="date" name="release_date" placeholder="19/01/2023">
                                        </div>
                                </div>
                        </div>
                </div>

                <div>
                        <h2 class="text-4xl font-bold text-center my-5">Séléction du genre</h2>
                </div>


                <div class="container flex justify-center">
                        <div class="w-full max-w-lg">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="genre">
                                                        Genre
                                                </label>
                                                <div class="relative">
                                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="genre" name="genre">
                                                                @foreach($genres as $genre)
                                                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                                                @endforeach
                                                        </select>
                                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>

                <div class="container flex justify-center">
                        <div class="w-full max-w-lg">
                                <div>
                                        <button class="py-2 px-2 bg-blue-500 rounded text-white my-3">
                                                Submit
                                        </button>
                                </div>
                        </div>
                </div>
</form>