<section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Création d'un nouveau genre</h2>
                <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Cette section vous permet d'ajouter un nouveau genre.</p>
                <form action="/genre/store" method="POST" class="space-y-8">
                        <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Le nouveau genre à insérer en BDD</label>
                                <input type="text" id="name" name="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700
                                 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Action" required>
                        </div>
                        <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-primary-800
                         focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600
                         dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sauvegarder le genre</button>
                </form>
        </div>
</section>