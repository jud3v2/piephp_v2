<?php
// ici on a un bug de psr-12 si les tag sont open donc on ne peut pas mettre tous les fichiers php en psr-12
?>
<footer>
    <div class="w-full min-h-screen flex items-center justify-center bg-black">
        <div class="md:w-2/3 w-full px-4 text-white flex flex-col">
            <div class="w-full text-7xl font-bold">
                <h1 class="w-full md:w-2/3">Tous vos films et séries en un seul et même endroit !</h1>
            </div>
            <div class="flex mt-8 flex-col md:flex-row md:justify-between">
                <p class="w-full md:w-2/3 text-gray-400">Afin d'avoir une expérience optimal sur notre site internet,assurez-vous d'être connecté à votre compte ou de vous créer un nouveau compte.</p>
                <div class="w-48 pt-6 md:pt-0">
                    <a class="bg-red-500 justify-center text-center rounded-lg shadow px-10 py-3 flex items-center">Se connecter</a>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="flex mt-24 mb-12 flex-row justify-between">
                    <a href="/" class="hidden md:block cursor-pointer text-gray-600 hover:text-white uppercase">Accueil</a>
                    <a href="/profile" class="hidden md:block cursor-pointer text-gray-600 hover:text-white uppercase">Profile</a>
                    <a href="/film" class="hidden md:block cursor-pointer text-gray-600 hover:text-white uppercase">Film</a>
                    <a href="/genre" class="hidden md:block cursor-pointer text-gray-600 hover:text-white uppercase">Genre</a>
                    <a href="/history" class="hidden md:block cursor-pointer text-gray-600 hover:text-white uppercase">Historique</a>
                </div>
                <hr class="border-gray-600"/>
                <p class="w-full text-center my-12 text-gray-600">Copyright &copy; 2024 PiePHP Made By<a href="https://github.com/jud3v2" target="_blank">Jud3v</a> @Lille With Some ❤️</p>
            </div>
        </div>
    </div>
</footer>