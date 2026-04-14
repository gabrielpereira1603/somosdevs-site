<div id="trabalhe-conosco" class="relative w-full py-5 md:py-14 bg-secondary-white dark:bg-secondary-black">
    <!-- Fundo Light -->
    <div class="absolute inset-0 bg-cover bg-center dark:hidden"
        style="background-image: url('{{ asset('somosdevs/imgs/bg-3.png') }}');"></div>

    <!-- Fundo Dark -->
    <div class="absolute inset-0 bg-fixed bg-center hidden dark:block"
        style="background-image: url('{{ asset('somosdevs/imgs/bg-3-white.png') }}');"></div>

    <!-- Overlay para dar contraste -->
    <div class="absolute inset-0 bg-white/70 dark:bg-black/70"></div>

    <!-- Conteúdo -->
    <div class="relative z-10 container mx-auto px-6">
        <!-- Lado Esquerdo - Copy -->
        <div class="space-y-2 text-center md:text-left">
            <h2 class="text-4xl font-bold text-secondary-black dark:text-white font-poppins">
                Solicite já seu <span class="text-primary">Orçamento Online</span>
            </h2>
            <p class="text-lg text-secondary-black dark:text-gray-300 leading-relaxed max-w-lg font-roboto">
                Queremos entender melhor suas necessidades e preparar a solução ideal para o seu negócio.
                Clique no botão abaixo e responda algumas perguntas rápidas. Assim, já entraremos em contato com uma
                proposta personalizada para você.
            </p>
            <a href="{{ route('budget') }}"
                class="font-poppins inline-block px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/80 transition">
                Solicitar Orçamento →
            </a>
        </div>
    </div>
</div>
