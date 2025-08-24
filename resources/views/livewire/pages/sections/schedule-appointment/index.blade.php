<div class="relative w-full py-12 md:py-20 bg-secondary-white dark:bg-secondary-black">
    <!-- Fundo Light -->
    <div class="absolute inset-0 bg-cover bg-center dark:hidden"
         style="background-image: url('{{ asset('somosdevs/imgs/bg-3.png') }}');"></div>

    <!-- Fundo Dark -->
    <div class="absolute inset-0 bg-fixed bg-center hidden dark:block"
         style="background-image: url('{{ asset('somosdevs/imgs/bg-3-white.png') }}');"></div>

    <!-- Overlay -->

    <!-- Conteúdo -->
    <div class="relative z-10 container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">

            <!-- Texto -->
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-secondary-black dark:text-secondary-white text-center md:text-left font-poppins">
                Entre em <span class="text-primary">contato</span> <br class="hidden md:block"> com a gente
            </h2>

            <!-- CTA -->
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <!-- Telefone -->
                <a href="tel:+5517991489765"
                   class="flex items-center gap-2 px-6 py-3 rounded-sm bg-secondary-black dark:bg-secondary-white dark:text-secondary-black font-poppins text-white shadow-md hover:bg-white/20 transition">
                    <i class="fa-solid fa-phone text-primary"></i>
                    <span class="font-roboto">(67) 981957833</span>
                </a>

                <!-- Botão principal -->
                <a href="#contato"
                   class="px-8 py-3 rounded-sm bg-primary text-white font-bold shadow-lg hover:bg-primary/80 transition font-poppins">
                    Enviar E-mail
                </a>
            </div>
        </div>
    </div>
</div>
