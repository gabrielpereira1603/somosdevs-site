<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

@php
    $showIntro = request()->routeIs('welcome');
@endphp

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">

    @if ($showIntro)
        <div id="intro-overlay"
            class="fixed inset-0 z-[120] overflow-hidden bg-primary transition-[opacity,transform,filter] duration-[1150ms] ease-[cubic-bezier(0.16,1,0.3,1)] will-change-[transform,opacity,filter]">
            <video id="intro-video"
                class="absolute inset-0 h-full w-full scale-[1.01] object-cover transition-transform duration-[1400ms] ease-[cubic-bezier(0.16,1,0.3,1)]"
                data-src-desktop="{{ asset('somosdevs/Motion/Motion LOGO Horizontal.mp4') }}"
                data-src-mobile="{{ asset('somosdevs/Motion/Motion LOGO.mp4') }}" autoplay muted playsinline
                preload="auto">
                <source id="intro-video-source" src="{{ asset('somosdevs/Motion/Motion LOGO Horizontal.mp4') }}"
                    type="video/mp4">
            </video>

            <div id="intro-beam"
                class="pointer-events-none absolute -inset-x-24 top-0 h-[58%] bg-[radial-gradient(circle_at_50%_0%,rgba(255,255,255,0.34),transparent_62%)] opacity-80 transition-[transform,opacity] duration-[1250ms] ease-[cubic-bezier(0.16,1,0.3,1)]">
            </div>
            <div id="intro-shutter"
                class="pointer-events-none absolute inset-x-0 bottom-0 h-[46%] bg-gradient-to-t from-primary via-primary/80 to-transparent transition-[transform,opacity] duration-[980ms] ease-[cubic-bezier(0.16,1,0.3,1)]">
            </div>

            <div
                class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(255,255,255,0.22),transparent_45%),radial-gradient(circle_at_80%_80%,rgba(255,255,255,0.16),transparent_38%)]">
            </div>
            <div
                class="pointer-events-none absolute inset-0 bg-gradient-to-t from-primary/35 via-transparent to-primary/25">
            </div>
        </div>
    @endif

    <div id="site-shell"
        class="{{ $showIntro ? 'opacity-0' : 'opacity-100' }} transition-opacity duration-[900ms] ease-[cubic-bezier(0.22,1,0.36,1)]">

        <header
            class="w-full fixed top-0 left-0 z-50 bg-white/80 dark:bg-[#010101]/80 backdrop-blur-xl border-b border-zinc-200/50 dark:border-zinc-800/50 shadow-[0_4px_30px_rgba(0,0,0,0.05)] transition-all duration-300">

            <!-- Main Navbar -->
            <div
                class="max-w-7xl mx-auto flex items-center justify-between px-0 sm:px-20 h-26 transition-all duration-300">
                <!-- Logo (Esquerda) -->
                <div class="flex flex-1 items-center justify-start">
                    <a href="{{ url('/') }}" class="flex items-center shrink-0">
                        <img src="{{ asset('somosdevs/LOGO/Logo-Horizontal-Azul.png') }}" alt="Logo Somos Devs"
                            class="h-24 w-auto scale-200 sm:ml-0 ml-10 sm:scale-350 dark:hidden transition-transform duration-500">
                        <img src="{{ asset('somosdevs/LOGO/Logo-Horizontal-Branco.png') }}" alt="Logo Somos Devs"
                            class="h-24 w-auto scale-200 sm:ml-0 ml-10 sm:scale-350 hidden dark:flex transition-transform duration-500">
                    </a>
                </div>

                <!-- Desktop Menu (Centro) -->
                <nav
                    class="hidden lg:flex flex-1 items-center justify-center gap-6 xl:gap-8 text-[15px] font-semibold text-secondary-black dark:text-white">
                    <a href="#"
                        class="relative group p-2 hover:text-primary dark:hover:text-primary transition-colors">
                        Home
                        <span
                            class="absolute left-0 bottom-0 w-0 h-0.5 bg-primary dark:bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#"
                        class="relative group p-2 hover:text-primary dark:hover:text-primary transition-colors">
                        Sobre
                        <span
                            class="absolute left-0 bottom-0 w-0 h-0.5 bg-primary dark:bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#"
                        class="relative group p-2 hover:text-primary dark:hover:text-primary transition-colors">
                        Serviços
                        <span
                            class="absolute left-0 bottom-0 w-0 h-0.5 bg-primary dark:bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#"
                        class="relative group p-2 hover:text-primary dark:hover:text-primary transition-colors">
                        Trabalhe Conosco
                        <span
                            class="absolute left-0 bottom-0 w-0 h-0.5 bg-primary dark:bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <!-- Botão Entre em Contato Outlined com Shimmer Suave -->
                    <div class="ml-4 relative inline-flex group">
                        <a href="#"
                            class="relative inline-flex items-center justify-center whitespace-nowrap overflow-hidden rounded-md border-2 border-primary text-primary dark:border-primary dark:text-primary bg-transparent py-1.5 px-5 font-poppins text-[13px] uppercase tracking-widest font-extrabold transition-all duration-300 ease-out hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white hover:border-transparent dark:hover:border-transparent hover:shadow-[0_0_22px_rgba(54,64,243,0.35)] dark:hover:shadow-[0_0_22px_rgba(54,64,243,0.35)]">
                            <span class="relative z-10">Entre em Contato</span>

                            <!-- Shimmer com passada única no hover -->
                            <span aria-hidden="true" class="pointer-events-none absolute inset-0">
                                <span
                                    class="absolute top-0 left-[-52%] h-full w-[40%] -skew-x-12 bg-gradient-to-r from-transparent via-white/70 dark:via-white/80 to-transparent opacity-0 transition-[left,opacity] duration-0 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:left-[125%] group-hover:opacity-100 group-hover:duration-[950ms]">
                                </span>
                            </span>
                        </a>
                    </div>
                </nav>

                <!-- Desktop Actions (Direita) -->
                <div class="hidden lg:flex flex-1 items-center justify-end gap-2 xl:gap-4 relative z-10">
                    <!-- Language Dropdown -->
                    <flux:dropdown position="bottom">
                        <button
                            class="flex cursor-pointer items-center gap-2 hover:text-primary dark:hover:text-primary text-zinc-700 dark:text-zinc-300 transition-colors text-xs font-bold tracking-wide uppercase px-2 py-1.5 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800">
                            <img src="{{ asset('flag-brasil.png') }}" alt="PT-BR"
                                class="w-4 h-4 rounded-full object-cover">
                            <span>PT-BR</span>
                            <i class="fa-solid fa-chevron-down text-[10px]"></i>
                        </button>

                        <flux:menu class="min-w-[140px]">
                            <flux:menu.item class="flex cursor-pointer items-center gap-2">
                                <img src="{{ asset('flag-brasil.png') }}" alt="Brasil"
                                    class="w-4 h-4 rounded-full object-cover"> Português
                            </flux:menu.item>
                            <flux:menu.item class="flex cursor-pointer items-center gap-2">
                                <img src="{{ asset('flag-usa.png') }}" alt="USA"
                                    class="w-4 h-4 rounded-full object-cover"> English
                            </flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>

                    <div class="h-5 w-px bg-zinc-300 dark:bg-zinc-700 mx-1"></div>

                    <!-- Theme Switcher -->
                    <button x-data x-on:click="$flux.dark = ! $flux.dark"
                        class="w-10 h-10 cursor-pointer text-zinc-700 dark:text-zinc-300 hover:text-primary dark:hover:text-primary transition-colors p-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-sun absolute transition-all duration-300 text-xl"
                            :class="$flux.dark ? 'translate-y-0 opacity-100 scale-100' : '-translate-y-8 opacity-0 scale-50'"
                            x-cloak></i>
                        <i class="fa-solid fa-moon absolute transition-all duration-300 text-[20px]"
                            :class="!$flux.dark ? 'translate-y-0 opacity-100 scale-100' : 'translate-y-8 opacity-0 scale-50'"
                            x-cloak></i>
                    </button>
                </div>

                <!-- Botão Mobile -->
                <div class="lg:hidden flex items-center gap-2 mr-6">
                    <flux:sidebar.toggle icon="bars-2" inset="left"
                        class="cursor-pointer rounded-lg border border-primary/20 bg-primary/5 px-3 py-2 text-primary transition-all duration-300 ease-in-out hover:bg-primary/20 dark:border-zinc-700 dark:bg-zinc-800/50 dark:text-white dark:hover:bg-zinc-700 [&>svg]:size-5" />
                </div>
            </div>

            <!-- Sidebar Mobile -->
            <flux:sidebar stashable sticky
                class="lg:hidden bg-white/95 dark:bg-[#010101]/95 backdrop-blur-xl border-r border-zinc-200 dark:border-zinc-800 shadow-2xl">
                <div class="flex justify-end p-2">
                    <flux:sidebar.toggle icon="x-mark"
                        class="cursor-pointer rounded-md px-2 py-1.5 transition-colors hover:bg-zinc-100 dark:hover:bg-zinc-800 [&>svg]:size-5 [&>svg]:text-zinc-600 dark:[&>svg]:text-zinc-300" />
                </div>

                <flux:brand href="#" logo="{{ asset('somosdevs/LOGO/apenaslogo.png') }}" name="Somos Dev's"
                    class="px-4 mb-4 dark:hidden" />
                <flux:brand href="#" logo="{{ asset('somosdevs/LOGO/apenaslogo-bg-white.png') }}"
                    name="Somos Dev's" class="px-4 mb-4 hidden dark:flex" />

                <div class="px-4 mb-4">
                    <flux:input as="input" variant="filled" placeholder="Buscar..." icon="magnifying-glass" />
                </div>

                <flux:navlist variant="outline" class="px-2">
                    <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>
                    <flux:navlist.item icon="code-bracket" href="#">Sobre Nós</flux:navlist.item>
                    <flux:navlist.item icon="cog" href="#">Serviços</flux:navlist.item>
                    <flux:navlist.item icon="question-mark-circle" href="#">Dúvida</flux:navlist.item>
                    <flux:navlist.item icon="briefcase" href="#">Trabalhe Conosco</flux:navlist.item>

                    <div class="mt-4 px-2">
                        <flux:button variant="primary" class="w-full justify-center rounded-full">Entre em Contato
                        </flux:button>
                    </div>
                </flux:navlist>

                <div class="mt-auto px-4 pb-4 border-t border-zinc-100 dark:border-zinc-800 pt-4">
                    <!-- Mobile Language Switcher -->
                    <div class="mb-4">
                        <span
                            class="text-[10px] tracking-wider font-bold text-zinc-500 mb-2 block uppercase">Idioma</span>
                        <flux:radio.group x-data variant="segmented">
                            <flux:radio value="pt" class="cursor-pointer"><img
                                    src="{{ asset('flag-brasil.png') }}" class="w-4 h-4 rounded-full mr-1"> PT
                            </flux:radio>
                            <flux:radio value="en" class="cursor-pointer"><img src="{{ asset('flag-usa.png') }}"
                                    class="w-4 h-4 rounded-full mr-1"> EN</flux:radio>
                        </flux:radio.group>
                    </div>

                    <span
                        class="text-[10px] tracking-wider font-bold text-zinc-500 mb-2 block uppercase">Aparência</span>
                    <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                        <flux:radio value="light" icon="sun" class="cursor-pointer"></flux:radio>
                        <flux:radio value="dark" icon="moon" class="cursor-pointer"></flux:radio>
                        <flux:radio value="system" icon="computer-desktop" class="cursor-pointer"></flux:radio>
                    </flux:radio.group>
                </div>
            </flux:sidebar>
        </header>


        <div class="mt-26">
            {{ $slot }}
        </div>

    </div>

    @if ($showIntro)
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const overlay = document.getElementById('intro-overlay');
                const video = document.getElementById('intro-video');
                const videoSource = document.getElementById('intro-video-source');
                const introBeam = document.getElementById('intro-beam');
                const introShutter = document.getElementById('intro-shutter');
                const shell = document.getElementById('site-shell');

                const notifySiteReady = () => {
                    window.dispatchEvent(new CustomEvent('site:ready'));
                };

                if (!overlay || !video || !shell) {
                    notifySiteReady();
                    return;
                }

                if (videoSource) {
                    const isMobileViewport = window.matchMedia('(max-width: 767px)').matches;
                    const selectedSrc = isMobileViewport ? video.dataset.srcMobile : video.dataset.srcDesktop;

                    if (selectedSrc && videoSource.getAttribute('src') !== selectedSrc) {
                        videoSource.setAttribute('src', selectedSrc);
                        video.load();
                    }
                }

                const introDurationMs = 2000;
                const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                let revealed = false;
                let introTimer = null;
                let hardTimeout = null;

                const clearTimers = () => {
                    if (introTimer !== null) {
                        window.clearTimeout(introTimer);
                        introTimer = null;
                    }

                    if (hardTimeout !== null) {
                        window.clearTimeout(hardTimeout);
                        hardTimeout = null;
                    }
                };

                const revealSite = () => {
                    if (revealed) {
                        return;
                    }

                    revealed = true;
                    clearTimers();
                    overlay.classList.add('opacity-0', 'scale-[1.04]', 'blur-sm');
                    video.classList.add('scale-[1.09]');
                    shell.classList.remove('opacity-0');
                    shell.classList.add('opacity-100');

                    if (introBeam) {
                        introBeam.classList.add('translate-y-[-22%]', 'opacity-0');
                    }

                    if (introShutter) {
                        introShutter.classList.add('translate-y-full', 'opacity-0');
                    }

                    document.body.classList.remove('overflow-hidden');
                    notifySiteReady();

                    window.setTimeout(() => {
                        overlay.remove();
                    }, 980);
                };

                if (prefersReducedMotion) {
                    revealSite();
                    return;
                }

                document.body.classList.add('overflow-hidden');

                const startIntroTimer = () => {
                    if (introTimer !== null) {
                        return;
                    }

                    introTimer = window.setTimeout(() => {
                        video.pause();
                        revealSite();
                    }, introDurationMs);
                };

                hardTimeout = window.setTimeout(revealSite, 4500);

                video.addEventListener('ended', () => {
                    revealSite();
                }, {
                    once: true
                });

                video.addEventListener('error', () => {
                    revealSite();
                }, {
                    once: true
                });

                video.addEventListener('playing', startIntroTimer, {
                    once: true
                });

                try {
                    video.currentTime = 0;
                } catch (error) {
                    // noop
                }

                const playPromise = video.play();

                if (playPromise && typeof playPromise.catch === 'function') {
                    playPromise.catch(() => {
                        revealSite();
                    });
                }

                if (video.readyState >= 2 && !video.paused) {
                    startIntroTimer();
                }
            });
        </script>
    @endif

    @fluxScripts
</body>

</html>
