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
            class="fixed inset-0 z-[120] overflow-hidden bg-[#010101] transition-[opacity,transform,filter] duration-[1150ms] ease-[cubic-bezier(0.16,1,0.3,1)] will-change-[transform,opacity,filter]">
            <video id="intro-video"
                class="absolute inset-0 h-full w-full scale-[1.01] object-cover transition-transform duration-[1400ms] ease-[cubic-bezier(0.16,1,0.3,1)]"
                data-src-desktop="{{ asset('somosdevs/Motion/motion_logo_black_horiz.mp4') }}"
                data-src-mobile="{{ asset('somosdevs/Motion/motion_logo_black_vert.mp4') }}" autoplay muted playsinline
                preload="auto">
                <source id="intro-video-source" src="{{ asset('somosdevs/Motion/motion_logo_black_horiz.mp4') }}"
                    type="video/mp4">
            </video>
        </div>
    @endif

    <div id="site-shell"
        class="{{ $showIntro ? 'opacity-0' : 'opacity-100' }} min-h-screen flex flex-col transition-opacity duration-[900ms] ease-[cubic-bezier(0.22,1,0.36,1)]">

        <header
            class="fixed top-0 left-0 z-50 w-full border-b border-zinc-800/80 bg-[#050505]/86 shadow-[0_12px_42px_rgba(0,0,0,0.52)] backdrop-blur-xl transition-all duration-300">

            <div class="mx-auto flex h-26 max-w-7xl items-center justify-between px-4 sm:px-8 xl:px-14">
                <div class="flex flex-1 items-center justify-start">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ asset('somosdevs/LOGO/Logo-Horizontal-Branco.png') }}" alt="Logo Somos Devs"
                            class="h-22 w-auto scale-[1.75] sm:scale-[2.3] xl:scale-[2.55] transition-transform duration-500">
                    </a>
                </div>

                <nav class="hidden flex-1 items-center justify-center gap-6 text-center xl:gap-10 lg:flex">
                    <a href="#home" data-scroll-link data-scroll-target="home"
                        class="group relative p-2 text-center text-[15px] font-semibold text-zinc-200 transition-colors hover:text-primary">
                        Início
                        <span
                            class="absolute left-0 bottom-0 h-0.5 w-0 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#sobre" data-scroll-link data-scroll-target="sobre"
                        class="group relative p-2 text-center text-[15px] font-semibold text-zinc-200 transition-colors hover:text-primary">
                        Sobre Nós
                        <span
                            class="absolute left-0 bottom-0 h-0.5 w-0 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#servicos" data-scroll-link data-scroll-target="servicos"
                        class="group relative p-2 text-center text-[15px] font-semibold text-zinc-200 transition-colors hover:text-primary">
                        Nossas Soluções
                        <span
                            class="absolute left-0 bottom-0 h-0.5 w-0 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#cases-de-sucesso" data-scroll-link data-scroll-target="cases-de-sucesso"
                        class="group relative p-2 text-center text-[15px] font-semibold text-zinc-200 transition-colors hover:text-primary">
                        Cases
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
                                <span class="relative z-10 whitespace-nowrap">Consultoria grátis</span>
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
                            class="h-20 w-auto">
                    </a>

                    <flux:sidebar.toggle icon="x-mark" data-sidebar-close="true"
                        class="cursor-pointer rounded-md px-2 py-1.5 transition-colors hover:bg-zinc-800 [&>svg]:size-5 [&>svg]:text-zinc-200" />
                </div>

                <flux:navlist variant="outline" class="mt-4 px-3 text-center">
                    <flux:navlist.item icon="home" href="#home" data-scroll-link data-scroll-target="home" current
                        class="justify-center text-center">
                        Início</flux:navlist.item>
                    <flux:navlist.item icon="code-bracket" href="#sobre" data-scroll-link data-scroll-target="sobre"
                        class="justify-center text-center">
                        Sobre Nós</flux:navlist.item>
                    <flux:navlist.item icon="cog" href="#servicos" data-scroll-link data-scroll-target="servicos"
                        class="justify-center text-center">
                        Nossas Soluções</flux:navlist.item>
                    <flux:navlist.item icon="briefcase" href="#cases-de-sucesso" data-scroll-link
                        data-scroll-target="cases-de-sucesso" class="justify-center text-center">Cases
                    </flux:navlist.item>

                    <div class="mt-5 px-2">
                        <div class="group relative inline-flex w-full">
                            <span
                                class="relative inline-flex w-full p-px bg-primary/90 transition-all duration-300 ease-out [clip-path:polygon(18px_0,100%_0,100%_100%,0_100%,0_18px)] group-hover:bg-primary group-hover:shadow-[0_0_24px_rgba(54,64,243,0.4)]">
                                <a href="#contato" data-scroll-link data-scroll-target="contato"
                                    class="relative inline-flex w-full items-center justify-center gap-2 overflow-hidden bg-[#050505] py-3 pl-6 pr-5 font-poppins text-[12px] font-extrabold tracking-[0.18em] text-primary uppercase transition-all duration-300 ease-out [clip-path:polygon(17px_0,100%_0,100%_100%,0_100%,0_17px)] group-hover:bg-primary group-hover:text-white">
                                    <span class="relative z-10">Consultoria grátis</span>
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


        <div class="mt-26 flex-1">
            {{ $slot }}
        </div>

        <footer class="relative border-t border-zinc-800/70 bg-[#050505]">

            <div class="relative mx-auto max-w-7xl px-4 sm:px-8 xl:px-14">
                <div class="pt-10">
                    <div
                        class="relative overflow-hidden rounded-[28px] border border-zinc-800/80 bg-[#0b0b0b] px-6 py-7 sm:px-8 lg:px-10">
                        <div
                            class="pointer-events-none absolute -top-16 right-[-72px] h-44 w-44 rounded-full bg-primary/25 blur-3xl">
                        </div>

                        <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                            <div class="max-w-2xl">
                                <p class="text-[11px] font-semibold tracking-[0.2em] text-primary uppercase">
                                    Vamos Construir Algo Diferente
                                </p>
                                <h3 class="mt-2 font-poppins text-2xl font-semibold text-white sm:text-3xl">
                                    Soluções digitais sob medida para escalar seu negócio com velocidade e qualidade.
                                </h3>
                                <p class="mt-3 text-sm leading-relaxed text-zinc-400 sm:text-base">
                                    Da ideia ao produto em produção, com foco em arquitetura robusta, performance e
                                    experiência.
                                </p>
                            </div>

                            <div class="flex shrink-0">
                                <a href="#contato" data-scroll-link data-scroll-target="contato"
                                    class="group relative inline-flex items-center gap-3 overflow-hidden rounded-2xl border border-primary/70 bg-primary/15 px-6 py-3.5 font-poppins text-xs font-semibold tracking-[0.16em] text-primary uppercase transition-all duration-300 hover:border-primary hover:bg-primary hover:text-white hover:shadow-[0_0_26px_rgba(54,64,243,0.42)]">
                                    <span class="relative z-10">Iniciar Projeto</span>
                                    <i
                                        class="fa-solid fa-arrow-right text-[11px] transition-transform duration-300 group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-12 py-12 lg:grid-cols-2 xl:grid-cols-4">
                    <div>
                        <a href="{{ url('/') }}" class="inline-flex items-center">
                            <img src="{{ asset('somosdevs/LOGO/Logo-Horizontal-Branco.png') }}" alt="Logo Somos Devs"
                                class="h-14 w-auto sm:h-16">
                        </a>

                        <p class="mt-5 max-w-xs text-sm leading-relaxed text-zinc-400">
                            Somos um parceiro técnico para empresas que querem transformar processos em produtos
                            digitais confiáveis.
                        </p>

                        <div class="mt-5 flex flex-wrap gap-2">
                            <span
                                class="rounded-full border border-zinc-700 bg-zinc-900/80 px-3 py-1 text-[11px] text-zinc-300">
                                Performance
                            </span>
                            <span
                                class="rounded-full border border-zinc-700 bg-zinc-900/80 px-3 py-1 text-[11px] text-zinc-300">
                                Escalabilidade
                            </span>
                            <span
                                class="rounded-full border border-zinc-700 bg-zinc-900/80 px-3 py-1 text-[11px] text-zinc-300">
                                Confiabilidade
                            </span>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold tracking-[0.14em] text-zinc-200 uppercase">Navegação</h4>
                        <ul class="mt-5 space-y-3 text-sm text-zinc-400">
                            <li>
                                <a href="#home" data-scroll-link data-scroll-target="home"
                                    class="inline-flex items-center gap-2 transition-colors hover:text-white">
                                    <span class="h-1.5 w-1.5 rounded-full bg-primary/80"></span>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#sobre" data-scroll-link data-scroll-target="sobre"
                                    class="inline-flex items-center gap-2 transition-colors hover:text-white">
                                    <span class="h-1.5 w-1.5 rounded-full bg-primary/80"></span>
                                    Sobre
                                </a>
                            </li>
                            <li>
                                <a href="#servicos" data-scroll-link data-scroll-target="servicos"
                                    class="inline-flex items-center gap-2 transition-colors hover:text-white">
                                    <span class="h-1.5 w-1.5 rounded-full bg-primary/80"></span>
                                    Serviços
                                </a>
                            </li>
                            <li>
                                <a href="#contato" data-scroll-link data-scroll-target="contato"
                                    class="inline-flex items-center gap-2 transition-colors hover:text-white">
                                    <span class="h-1.5 w-1.5 rounded-full bg-primary/80"></span>
                                    Contato
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold tracking-[0.14em] text-zinc-200 uppercase">Soluções</h4>
                        <ul class="mt-5 space-y-3 text-sm text-zinc-400">
                            <li class="inline-flex items-center gap-2">
                                <i class="fa-solid fa-code text-[12px] text-primary"></i>
                                Desenvolvimento de software
                            </li>
                            <li class="inline-flex items-center gap-2">
                                <i class="fa-solid fa-gears text-[12px] text-primary"></i>
                                Automações
                            </li>
                            <li class="inline-flex items-center gap-2">
                                <i class="fa-solid fa-shield-halved text-[12px] text-primary"></i>
                                Sustentação e evolução
                            </li>
                            <li class="inline-flex items-center gap-2">
                                <i class="fa-solid fa-lightbulb text-[12px] text-primary"></i>
                                Consultorias
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold tracking-[0.14em] text-zinc-200 uppercase">Contato</h4>

                        <ul class="mt-5 space-y-3 text-sm text-zinc-400">
                            <li class="inline-flex items-center gap-2">
                                <i class="fa-regular fa-envelope text-primary"></i>
                                <a href="mailto:admin@somosdevs.com" class="transition-colors hover:text-white">
                                    admin@somosdevs.com
                                </a>
                            </li>
                            <li class="inline-flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp text-primary"></i>
                                <a href="https://wa.me/5517976001413" target="_blank" rel="noopener noreferrer"
                                    class="transition-colors hover:text-white">
                                    +55 (17) 97600-1413
                                </a>
                            </li>
                        </ul>

                        <div class="mt-6 flex items-center gap-3">
                            <a href="#" aria-label="Instagram"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-zinc-700 bg-zinc-900 text-zinc-300 transition-all duration-300 hover:border-primary hover:bg-primary hover:text-white">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="#" aria-label="Facebook"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-zinc-700 bg-zinc-900 text-zinc-300 transition-all duration-300 hover:border-primary hover:bg-primary hover:text-white">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="#" aria-label="LinkedIn"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-zinc-700 bg-zinc-900 text-zinc-300 transition-all duration-300 hover:border-primary hover:bg-primary hover:text-white">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative border-t border-zinc-800/70 bg-[#030303]">
                <div
                    class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-5 text-xs text-zinc-500 sm:px-8 md:flex-row md:items-center md:justify-between xl:px-14">
                    <p>© {{ now()->year }} SomosDevs. Todos os direitos reservados.</p>

                    <div class="flex items-center gap-4">
                        <a href="#" class="transition-colors hover:text-zinc-300">Política de Privacidade</a>
                        <span class="h-1 w-1 rounded-full bg-zinc-700"></span>
                        <a href="#" class="transition-colors hover:text-zinc-300">Termos de Uso</a>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    @if ($showIntro)
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const overlay = document.getElementById('intro-overlay');
                const video = document.getElementById('intro-video');
                const videoSource = document.getElementById('intro-video-source');
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
