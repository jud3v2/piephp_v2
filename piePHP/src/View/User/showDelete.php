<?php

if (session_status() === PHP_SESSION_NONE) {
        header('Location: /login');
} elseif (session_status() === PHP_SESSION_DISABLED) {
        session_abort();
        header('Location: /login');
}
?>

<h1 class="mt-5 font-bold text-2xl text-center">Procédure de suppresion de votre compte</h1>
<div class="flex items-center justify-center p-12">
    <div class="mx-auto w-full max-w-[550px] bg-white">
        <form action="/user/delete/<?= $_SESSION['user']['id'] ?>" method="POST">
            <div class="mb-5">
                <label for="password" class="mb-3 block text-base font-medium text-[#07074D]">
                    Mot de passe de votre compte
                </label>
                <input type="password" required name="password" id="password"
                       placeholder="Le mots de passe de votre compte" value=""
                       class="w-full rounded-md border border-[#e0e0e0] bg-white
                        py-3 px-6 text-base font-medium text-[#6B7280] outline-none
                        focus:border-[#6A64F1] focus:shadow-md" />
            </div>

            <div>
                <button
                        type="submit"
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center
                         text-base font-semibold text-white outline-none">
                    Supprimer mon profile
                </button>
            </div>
        </form>
    </div>
</div>