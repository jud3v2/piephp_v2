<div class="flex items-center justify-center min-h-screen bg-white py-48">
        <div class="flex flex-col">
                <div class="flex flex-col items-center">
                        <div class="text-indigo-500 font-bold text-7xl">
                                {{ $status }}
                        </div>

                        <div class="font-bold text-3xl xl:text-7xl lg:text-6xl md:text-5xl mt-10">
                                {{ $title }}
                        </div>

                        <div class="text-gray-400 font-medium text-sm md:text-xl lg:text-2xl mt-8">
                                {{ $message }}
                        </div>
                </div>

                <div class="flex flex-col mt-48">
                        <div class="text-gray-400 font-bold uppercase">
                                Continuer ici
                        </div>
                        <div class="flex flex-col items-stretch mt-5">
                                <div class="flex flex-row group px-4 py-8
                    border-t hover:cursor-pointer
                    transition-all duration-200 delay-100">
                                        <div class="rounded-xl bg-blue-100 px-3 py-2 md:py-4">
                                                <i class="mdi mdi-home-outline mx-auto
                            text-indigo-900 text-2xl md:text-3xl"></i>
                                        </div>
                                        <div class="grow flex flex-col pl-5 pt-2">
                                                <a href="/" class="font-bold text-sm md:text-lg
                                                lg:text-xl group-hover:underline">
                                                        Page d'acceuil
                                                </a>
                                                <div class="font-semibold text-sm md:text-md lg:text-lg
                            text-gray-400 group-hover:text-gray-500
                            transition-all duration-200 delay-100">
                                                        Tout commence ici
                                                </div>
                                        </div>
                                        <i class="mdi mdi-chevron-right text-gray-400 mdi-24px my-auto pr-2
                        group-hover:text-gray-700 transition-all duration-200 delay-100"></i>
                                </div>
                        </div>
                </div>
        </div>
</div>