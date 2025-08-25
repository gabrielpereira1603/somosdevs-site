<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">

        <header class="bg-white dark:bg-[#010101] shadow-md w-full fixed top-0 left-0 z-50">
            <div class="sm:flex hidden justify-between px-14 w-full bg-primary font-inter p-4">
                <div class="flex gap-2 justify-center items-center">
                    <small class="font-bold">contato@somosdevteam.com</small>
                    <div class="h-6 w-[1px] bg-secondary-black dark:bg-white"></div>
                    <small class="flex items-center gap-1 font-bold">
                    <span>
                        <i class="fa-solid fa-square-phone"></i>
                    </span>
                        (67) 9 8195-7833
                    </small>
                </div>
                <div class="flex items-center justify-center gap-5">
                    <div class="flex items-center justify-center gap-3 text-xl">
                        <a x-data x-on:click="$flux.dark = ! $flux.dark" class="px-2 py-1 rounded-sm hover:bg-white/20 hover:text-white transition-colors duration-300 ease-in-out">
                            <i class="fa-solid fa-moon"></i>
                        </a>
                        <a class="px-2 py-1 rounded-sm hover:bg-white/20 hover:text-white transition-colors duration-300 ease-in-out">
                            <i class="fa-brands fa-square-facebook"></i>
                        </a>
                        <a class="px-2 py-1 rounded-sm hover:bg-pink-500 hover:text-white transition-colors duration-300 ease-in-out">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a class="px-2 py-1 rounded-sm hover:bg-blue-800 hover:text-white transition-colors duration-300 ease-in-out">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    </div>


                    <div class="flex justify-center items-center gap-5">
                    <span>
                        <img src="{{ asset('flag-brasil.png') }}" alt="Bandeira do Brasil" class="w-7">
                    </span>
                        <span>
                        <img src="{{ asset('flag-usa.png') }}" alt="Bandeira do Estados Unidos" class="w-7">
                    </span>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto flex items-center justify-between sm:px-20 h-26">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('somosdevs/LOGO/Logo-Horizontal-Azul.png') }}"
                         alt="Logo Somos Devs"
                         class="h-24 w-auto scale-200 sm:ml-0 ml-10 sm:scale-350 dark:hidden">
                    <img src="{{ asset('somosdevs/LOGO/Logo-Horizontal-Branco.png') }}"
                         alt="Logo Somos Devs"
                         class="h-24 w-auto scale-200 sm:ml-0 ml-10 sm:scale-350 hidden dark:flex">
                </a>

                <!-- Menu -->
                <nav class="hidden lg:flex items-center gap-8">
                    <a href="#" class="text-secondary-black dark:text-white p-2 rounded-xl font-poppins hover:text-primary dark:hover:text-[#00e2e2] transition-colors">Home</a>
                    <a href="#" class="text-secondary-black dark:text-white p-2 rounded-xl font-poppins hover:text-primary dark:hover:text-[#00e2e2] transition-colors">Sobre</a>
                    <a href="#" class="text-secondary-black dark:text-white p-2 rounded-xl font-poppins hover:text-primary dark:hover:text-[#00e2e2] transition-colors">Serviços</a>
                    <a href="#" class="text-secondary-black dark:text-white p-2 rounded-xl font-poppins hover:text-primary dark:hover:text-[#00e2e2] transition-colors">Trabalhe Conosco</a>
                    <a href="#" class="text-secondary-white font-bold py-2 px-4 font-poppins hover:text-secondary-white hover:bg-primary/90 transition-colors
                               rounded-sm bg-primary dark:bg-border-primary dark:hover:bg-primary/90">
                        Entre em Contato
                    </a>
                </nav>

                <!-- Botão Mobile -->
                <div class="lg:hidden flex mr-2"
                     x-data
                     x-on:click="document.body.hasAttribute('data-show-stashed-sidebar') ? document.body.removeAttribute('data-show-stashed-sidebar') : document.body.setAttribute('data-show-stashed-sidebar', '')"
                     data-flux-sidebar-toggle>
            <span
                class="border border-primary dark:border-border-primary py-2 px-3 rounded-md cursor-pointer
                       flex items-center justify-center
                       transition-all duration-300 ease-in-out
                       hover:bg-primary/20 dark:hover:bg-primary/20">
                <i class="fa-solid fa-bars text-primary dark:text-white transition-colors duration-300 ease-in-out"></i>
            </span>
                </div>
            </div>

            <!-- Sidebar Mobile -->
            <flux:sidebar stashable sticky class="lg:hidden bg-white dark:bg-[#010101] border border-primary dark:border-primary">
                <div class="lg:hidden flex mr-2"
                     x-data
                     x-on:click="document.body.hasAttribute('data-show-stashed-sidebar') ? document.body.removeAttribute('data-show-stashed-sidebar') : document.body.setAttribute('data-show-stashed-sidebar', '')"
                     data-flux-sidebar-toggle>
            <span
                class="border border-primary dark:border-primary py-2 px-3 rounded-md cursor-pointer
                       flex items-center justify-center
                       transition-all duration-300 ease-in-out
                       hover:bg-primary/20 dark:hover:bg-primary/20">
                <i class="fa-solid fa-xmark text-primary dark:text-white transition-colors duration-300 ease-in-out"></i>
            </span>
                </div>

                <flux:brand href="#" logo="{{ asset('somosdevs/LOGO/apenaslogo.png') }}" name="Somos Dev's." class="px-2 dark:hidden" />
                <flux:brand href="#" logo="{{ asset('somosdevs/LOGO/apenaslogo-bg-white.png') }}" name="Somos Dev's." class="px-2 hidden dark:flex"/>

                <flux:input as="input" variant="filled" placeholder="Search..." icon="magnifying-glass" />
                <flux:navlist variant="outline">
                    <flux:navlist.item icon="home" href="#" current >Home</flux:navlist.item>
                    <flux:navlist.item icon="code-bracket" href="#">Sobre Nós</flux:navlist.item>
                    <flux:navlist.item icon="cog" href="#">Servicos</flux:navlist.item>
                    <flux:navlist.item icon="question-mark-circle" href="#">Dúvida</flux:navlist.item>
                    <flux:navlist.item icon="briefcase" href="#">Trabalhe Conosco</flux:navlist.item>
                    <flux:button icon="envelope">Entre em Contato</flux:button>
                </flux:navlist>
                <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                    <flux:radio value="light" icon="sun"></flux:radio>
                    <flux:radio value="dark" icon="moon"></flux:radio>
                    <flux:radio value="system" icon="computer-desktop"></flux:radio>
                </flux:radio.group>
            </flux:sidebar>
        </header>


        <div class="mt-26">
            {{ $slot }}
        </div>

        @fluxScripts
    </body>
</html>
