<?php
if (session_status() === PHP_SESSION_NONE) {
        header('Location: /login');
} elseif (session_status() === PHP_SESSION_DISABLED) {
        session_destroy();
        session_abort();
        header('Location: /login');
}

if (is_null($_SESSION['user'])) {
        session_destroy();
        session_abort();
    header('Location: /login');
}
?>

<h1 class="mt-5 font-bold text-2xl text-center">Information de votre profile</h1>

@isset($message)
    <p class="text-center font-bold text-xl">{{ $message }}</p>
@endisset
<div class="p-16">
    <div class="p-8 bg-white shadow mt-24">
        <div class="grid grid-cols-1 md:grid-cols-3">
            <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                <div><p class="font-bold text-gray-700 text-xl">22</p>
                    <p class="text-gray-400">Film vu(s)</p></div>
                <div><p class="font-bold text-gray-700 text-xl">10</p>
                    <p class="text-gray-400">J'aime</p></div>
                <div><p class="font-bold text-gray-700 text-xl">89</p>
                    <p class="text-gray-400">Dernier film vu</p></div>
            </div>
            <div class="relative">
                <div class="w-32 h-32 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute
                inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center">
                <a href="/profile/update"  class="text-white py-2 px-4 uppercase rounded bg-blue-400
                 hover:bg-blue-500 shadow hover:shadow-lg font-medium transition transform
                  hover:-translate-y-0.5">
                    Modifier mon compte</a>
                <a href="/profile/delete" class="text-white py-2 px-4 uppercase rounded
                bg-gray-700 hover:bg-gray-800 shadow hover:shadow-lg font-medium
                 transition transform hover:-translate-y-0.5">Supprimer mon compte
                </a>
            </div>
        </div>
        <div class="mt-20 text-center border-b pb-12"><h1 class="text-4xl font-medium text-gray-700">
                {{ $user['firstname'] }} {{ $user['lastname'] }},
                <span class="font-light text-gray-500"><?php
                        $date = new DateTime($user['birthdate']);
                        $now = new DateTime();
                        $interval = $now->diff($date);
                        echo $interval->y . ' ans';
                ?></span></h1>
            <p class="font-light text-gray-600 mt-3">{{ isset($user['city']) ? $user['city'] : '' }}
                {{ isset($user['zipcode']) ? $user['zipcode'] : '' }}
                {{ isset($user['country']) ? $user['country'] : '' }}</p>
            <p class="mt-8 text-gray-500">{{ isset($user['address']) ? $user['address'] : '' }}</p>
        </div>
    </div>
</div>
