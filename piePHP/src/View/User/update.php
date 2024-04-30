<?php
if (session_status() === PHP_SESSION_NONE) {
        header('Location: /login');
} elseif (session_status() === PHP_SESSION_DISABLED) {
        session_abort();
        header('Location: /login');
}
?>

<h1 class="mt-5 font-bold text-2xl text-center">Modification de votre profile</h1>
<div class="flex items-center justify-center p-12">
    <div class="mx-auto w-full max-w-[550px] bg-white">
        <form action="/user/update/{{ $_SESSION['user']['id'] }}" method="POST">
            <div class="mb-5">
                <label for="firstname" class="mb-3 block text-base font-medium text-[#07074D]">
                    Prénom
                </label>
                <input type="text" name="firstname" id="firstname" placeholder="Prénom" value="{{ $user['firstname'] }}"
                       class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium
                       text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div class="mb-5">
                <label for="lastname" class="mb-3 block text-base font-medium text-[#07074D]">
                    Nom
                </label>
                <input type="text" name="lastname" id="lastname" placeholder="Nom" value="{{ $user['lastname'] }}"
                       class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium
                        text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div class="mb-5">
                <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                    Email
                </label>
                <input type="email" name="email" id="email" placeholder="Votre email" value="{{ $user['email'] }}"
                       class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium
                       text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div class="-mx-3 flex flex-wrap">
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="birthdate" class="mb-3 block text-base font-medium text-[#07074D]">
                            Date de naissance
                        </label>
                            <?php
                            $date = new DateTime($user['birthdate']);
                            $date = $date->format('Y-m-d');
                            ?>
                        <input type="date" name="birthdate" id="birthdate" value="{{ $date }}"
                               class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium
                                text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                </div>
            </div>

            <div class="mb-5 pt-3">
                <label class="mb-5 block text-base font-semibold text-[#07074D] sm:text-xl">
                    Adresse
                </label>
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <input type="text" name="address" id="address" placeholder="Adresse"
                                   value="{{ isset($user['address']) ? $user['address'] : '' }}"
                                   class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base
                                   font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <input type="text" name="city" id="city" placeholder="Ville"
                                   value="{{ isset($user['city']) ? $user['city'] : '' }}"
                                   class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base
                                   font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <input type="text" name="country" id="country" placeholder="Pays"
                                   value="{{ isset($user['country']) ? $user['country'] : '' }}"
                                   class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base
                                    font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <input type="text" name="zipcode" id="zipcode" placeholder="Code Postal"
                                   value="{{ isset($user['zipcode']) ? $user['zipcode'] : '' }}"
                                   class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6
                                    text-base font-medium text-[#6B7280] outline-none
                                    focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $_SESSION['user']['id'] }}">
            <div>
                <button
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8
                         text-center text-base font-semibold text-white outline-none">
                    Mise à jour de mon profile
                </button>
            </div>
        </form>
    </div>
</div>