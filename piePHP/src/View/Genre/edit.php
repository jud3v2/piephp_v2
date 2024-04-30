<section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Editer votre genre</h2>
                <p class="mb-8 lg:mb-2 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Cette section vous permet de modifier votre genre [{{ $genre->name }}].</p>
                <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Attention ce genre est concerné par <span class="font-bold">{{ count($genre->movies) }}</span> film(s).</p>
                <form action="/genre/update/{{ $genre->id }}" method="POST" class="space-y-8">
                        <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Modification du genre</label>
                                <input type="text" id="name" name='name' value="{{ $genre->name }}"
                                       class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 focus:ring-primary-500
                                 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500
                                  dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Action" required>
                        </div>
                        <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg
                         bg-blue-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none
                         focus:ring-primary-300
                          dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Modifier le genre</button>
                    <a href="/genre/delete/{{ $genre->id }}">
                        <button type="button" class="py-3 px-5 text-sm font-medium text-center text-white
                        rounded-lg bg-red-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none
                        focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700
                        dark:focus:ring-primary-800">Supprimer [{{ $genre->name }}]</button>
                    </a>
                </form>
        </div>
</section>