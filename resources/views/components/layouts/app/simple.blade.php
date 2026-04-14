<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

@php
    $showIntro = request()->routeIs('welcome');
@endphp

<body class="min-h-screen bg-linear-to-b from-neutral-950 to-neutral-900 antialiased">

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
            class="fixed top-0 left-0 z-50 w-full border-b border-zinc-800/80 bg-[#050505]/86 shadow-[0_12px_42px_rgba(0,0,0,0.52)] backdrop-blur-xl transition-all duration-300">

            <div class="mx-auto flex h-26 max-w-7xl items-center justify-between px-4 sm:px-8 xl:px-14">
                <div class="flex flex-1 items-center justify-start">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ asset('somosdevs/LOGO/Logo-Horizontal-Branco.png') }}" alt="Logo Somos Devs"
                            class="h-22 w-auto scale-[1.75] sm:scale-[2.3] xl:scale-[2.55] transition-transform duration-500">
                    </a>
                </div>

                <nav class="hidden flex-1 items-center justify-center gap-6 xl:gap-10 lg:flex">
                    <a href="#home" data-scroll-link data-scroll-target="home"
                        class="group relative p-2 text-[15px] font-semibold text-zinc-200 transition-colors hover:text-primary">
                        Home
                        <span
                            class="absolute left-0 bottom-0 h-0.5 w-0 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#sobre" data-scroll-link data-scroll-target="sobre"
                        class="group relative p-2 text-[15px] font-semibold text-zinc-200 transition-colors hover:text-primary">
                        Sobre
                        <span
                            class="absolute left-0 bottom-0 h-0.5 w-0 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#servicos" data-scroll-link data-scroll-target="servicos"
                        class="group relative p-2 text-[15px] font-semibold text-zinc-200 transition-colors hover:text-primary">
                        Serviços
                        <span
                            class="absolute left-0 bottom-0 h-0.5 w-0 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#trabalhe-conosco" data-scroll-link data-scroll-target="trabalhe-conosco"
                        class="group relative p-2 text-[15px] font-semibold text-zinc-200 transition-colors hover:text-primary">
                        Trabalhe Conosco
                        <span
                            class="absolute left-0 bottom-0 h-0.5 w-0 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </nav>

                <div class="hidden flex-1 items-center justify-end gap-3 xl:gap-4 lg:flex">
                    <div class="group relative inline-flex">
                        <span
                            class="relative inline-flex p-px bg-primary/90 transition-all duration-300 ease-out [clip-path:polygon(20px_0,100%_0,100%_100%,0_100%,0_20px)] group-hover:bg-primary group-hover:shadow-[0_0_28px_rgba(54,64,243,0.42)]">
                            <a href="#contato" data-scroll-link data-scroll-target="contato"
                                class="relative inline-flex items-center gap-2 overflow-hidden bg-[#050505] py-2.5 pl-6 pr-5 font-poppins text-[12px] font-extrabold tracking-[0.2em] text-primary uppercase transition-all duration-300 ease-out [clip-path:polygon(19px_0,100%_0,100%_100%,0_100%,0_19px)] group-hover:bg-primary group-hover:text-white">
                                <span class="relative z-10 whitespace-nowrap">Contate-nos</span>
                                <i
                                    class="fa-solid fa-envelope text-[12px] transition-transform duration-300 group-hover:translate-x-0.5"></i>

                                <span aria-hidden="true" class="pointer-events-none absolute inset-0">
                                    <span
                                        class="absolute top-0 left-[-52%] h-full w-[40%] -skew-x-12 bg-gradient-to-r from-transparent via-white/70 to-transparent opacity-0 transition-[left,opacity] duration-0 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:left-[125%] group-hover:opacity-100 group-hover:duration-[950ms]"></span>
                                </span>
                            </a>
                        </span>
                    </div>

                    <flux:dropdown position="bottom end">
                        <button
                            class="inline-flex cursor-pointer items-center justify-center transition-transform duration-300 hover:scale-[1.05]"
                            aria-label="Selecionar idioma">
                            <img src="{{ asset('flag-brasil.png') }}" alt="Português" class="h-5 w-5 object-cover">
                        </button>

                        <flux:menu class="min-w-[88px]">
                            <flux:menu.item class="flex items-center justify-center">
                                <img src="{{ asset('flag-brasil.png') }}" alt="Português" class="h-5 w-5 object-cover">
                            </flux:menu.item>
                            <flux:menu.item class="flex items-center justify-center">
                                <img src="{{ asset('flag-usa.png') }}" alt="English" class="h-5 w-5 object-cover">
                            </flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>

                <div class="flex items-center gap-2 lg:hidden">
                    <flux:sidebar.toggle icon="bars-2" inset="left"
                        class="cursor-pointer rounded-lg border border-zinc-700 bg-zinc-900/75 px-3 py-2 text-zinc-100 transition-all duration-300 ease-in-out hover:border-primary/70 hover:bg-zinc-800 [&>svg]:size-5" />
                </div>
            </div>

            <flux:sidebar stashable sticky
                class="lg:hidden border-r border-zinc-800 bg-[#050505]/95 shadow-2xl backdrop-blur-xl">
                <div class="flex items-center justify-between px-4 pt-3">
                    <a href="{{ url('/') }}" class="inline-flex items-center">
                        <img src="{{ asset('somosdevs/LOGO/Logo-Horizontal-Branco.png') }}" alt="Logo Somos Devs"
                            class="h-14 w-auto">
                    </a>

                    <flux:sidebar.toggle icon="x-mark" data-sidebar-close="true"
                        class="cursor-pointer rounded-md px-2 py-1.5 transition-colors hover:bg-zinc-800 [&>svg]:size-5 [&>svg]:text-zinc-200" />
                </div>

                <flux:navlist variant="outline" class="mt-4 px-3">
                    <flux:navlist.item icon="home" href="#home" data-scroll-link data-scroll-target="home" current>
                        Home</flux:navlist.item>
                    <flux:navlist.item icon="code-bracket" href="#sobre" data-scroll-link data-scroll-target="sobre">
                        Sobre</flux:navlist.item>
                    <flux:navlist.item icon="cog" href="#servicos" data-scroll-link data-scroll-target="servicos">
                        Serviços</flux:navlist.item>
                    <flux:navlist.item icon="briefcase" href="#trabalhe-conosco" data-scroll-link
                        data-scroll-target="trabalhe-conosco">Trabalhe Conosco</flux:navlist.item>

                    <div class="mt-5 px-2">
                        <div class="group relative inline-flex w-full">
                            <span
                                class="relative inline-flex w-full p-px bg-primary/90 transition-all duration-300 ease-out [clip-path:polygon(18px_0,100%_0,100%_100%,0_100%,0_18px)] group-hover:bg-primary group-hover:shadow-[0_0_24px_rgba(54,64,243,0.4)]">
                                <a href="#contato" data-scroll-link data-scroll-target="contato"
                                    class="relative inline-flex w-full items-center justify-center gap-2 overflow-hidden bg-[#050505] py-3 pl-6 pr-5 font-poppins text-[12px] font-extrabold tracking-[0.18em] text-primary uppercase transition-all duration-300 ease-out [clip-path:polygon(17px_0,100%_0,100%_100%,0_100%,0_17px)] group-hover:bg-primary group-hover:text-white">
                                    <span class="relative z-10">Contate-nos</span>
                                    <i
                                        class="fa-solid fa-envelope text-[12px] transition-transform duration-300 group-hover:translate-x-0.5"></i>

                                    <span aria-hidden="true" class="pointer-events-none absolute inset-0">
                                        <span
                                            class="absolute top-0 left-[-52%] h-full w-[40%] -skew-x-12 bg-gradient-to-r from-transparent via-white/70 to-transparent opacity-0 transition-[left,opacity] duration-0 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:left-[125%] group-hover:opacity-100 group-hover:duration-[900ms]"></span>
                                    </span>
                                </a>
                            </span>
                        </div>
                    </div>
                </flux:navlist>

                <div class="mt-auto border-t border-zinc-800 px-4 pt-5 pb-6">
                    <flux:dropdown position="top start">
                        <button
                            class="inline-flex cursor-pointer items-center justify-center transition-transform duration-300 hover:scale-[1.05]"
                            aria-label="Selecionar idioma">
                            <img src="{{ asset('flag-brasil.png') }}" alt="Português" class="h-5 w-5 object-cover">
                        </button>

                        <flux:menu class="min-w-[88px]">
                            <flux:menu.item class="flex items-center justify-center">
                                <img src="{{ asset('flag-brasil.png') }}" alt="Português"
                                    class="h-5 w-5 object-cover">
                            </flux:menu.item>
                            <flux:menu.item class="flex items-center justify-center">
                                <img src="{{ asset('flag-usa.png') }}" alt="English" class="h-5 w-5 object-cover">
                            </flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
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
