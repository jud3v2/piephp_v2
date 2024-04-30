<?php

/*JUST FOR PSR 12 STANDARD*/ ?>
<div class="m-3">
    @if(isset($message))
        <p class="text-xl font-bold">{{ $message }}</p>
    @endif

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Inscription de votre compte</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/store" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1
                               ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                               focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                            Mots de passe</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password"
                               required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>
                    <div class="mt-2">
                        <input id="firstname" name="firstname" type="text" autocomplete="firstname" required
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1
                                ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
                    <div class="mt-2">
                        <input id="lastname" name="lastname" type="text" autocomplete="lastname" required
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1
                                ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="birthdate" class="block text-sm font-medium leading-6 text-gray-900">
                        Date de naissance</label>
                    <div class="mt-2">
                        <input id="birthdate" name="birthdate" type="date" autocomplete="birthdate" required
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1
                                ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3
                     py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500
                      focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                      focus-visible:outline-indigo-600">S'enregistrer</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Vous êtes déjà membre ?
                <a href="/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Se connecter</a>
            </p>
        </div>
    </div>
