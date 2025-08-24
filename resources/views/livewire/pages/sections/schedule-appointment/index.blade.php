<div class="relative w-full py-12 md:py-20 bg-secondary-white dark:bg-secondary-black">
    <!-- Fundo Light -->
    <div class="absolute inset-0 bg-cover bg-center dark:hidden"
         style="background-image: url('{{ asset('somosdevs/imgs/bg-3.png') }}');"></div>

    <!-- Fundo Dark -->
    <div class="absolute inset-0 bg-fixed bg-center hidden dark:block"
         style="background-image: url('{{ asset('somosdevs/imgs/bg-3-white.png') }}');"></div>

    <!-- Overlay para dar contraste -->
    <div class="absolute inset-0 bg-white/40 dark:bg-black/70"></div>

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
                   class="flex items-center gap-2 px-6 py-3 rounded-sm  bg-secondary-black dark:bg-secondary-white dark:text-secondary-black font-poppins text-white shadow-md hover:bg-secondary-black/90 dark:hover:bg-white/90 transition">
                    <i class="fa-brands fa-whatsapp text-secondary-white dark:text-secondary-black text-2xl"></i>
                    <span class="font-roboto">(67) 9 8195-7833</span>
                </a>

                <!-- Botão principal -->
                <a href="#contato"
                   class="flex items-center gap-2 px-6 py-3 rounded-sm bg-primary text-white font-bold shadow-lg hover:bg-primary/80 transition font-poppins">
                    <i class="fa-solid fa-envelope"></i>
                    Enviar E-mail
                </a>
            </div>
        </div>
    </div>
</div>
