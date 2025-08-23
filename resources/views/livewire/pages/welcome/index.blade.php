<div class="relative w-full h-screen">
    <!-- bg light -->
    <div class="absolute inset-0 bg-cover bg-center dark:hidden"
         style="background-image: url('{{ asset('somosdevs/download-2.svg') }}');"></div>

    <!-- bg dark -->
    <div class="absolute inset-0 bg-cover bg-center hidden dark:block"
         style="background-image: url('{{ asset('somosdevs/download-2.svg') }}');"></div>


    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/20 "></div>

    <!-- Conteúdo -->
    <div class="relative z-10 flex flex-col items-center justify-center text-center h-full px-6">
        <h1 class="text-4xl md:text-6xl font-bold font-poppins
                   text-secondary-white dark:text-secondary-white">
            Desenvolvendo
            <span class="text-primary dark:text-primary">soluções tecnológicas</span>
            que ajudam a expandir seus negócios
        </h1>

        <p class="mt-6 max-w-3xl text-lg md:text-xl font-roboto text-gray-200 dark:text-gray-200">
            Inovação segura e eficiente para grandes e pequenas empresas,
            desbloqueando o verdadeiro potencial da sua empresa.
        </p>

        <a href="#contato"
           class="mt-8 inline-block bg-primary dark:bg-primary
                  hover:bg-primary/80 dark:hover:bg-primary/80
                  text-white dark:text-[#010101] font-semibold
                  px-6 py-3 rounded-md transition">
            Fale conosco →
        </a>
    </div>
</div>
