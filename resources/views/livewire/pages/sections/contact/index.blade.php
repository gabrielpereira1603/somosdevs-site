<div class="relative w-full py-12 md:py-20 bg-secondary-white dark:bg-secondary-black">
    <!-- Fundo Light -->
    <div class="absolute inset-0 bg-cover bg-center dark:hidden"
         style="background-image: url('{{ asset('somosdevs/imgs/bg-3.png') }}');"></div>

    <!-- Fundo Dark -->
    <div class="absolute inset-0 bg-fixed bg-center hidden dark:block"
         style="background-image: url('{{ asset('somosdevs/imgs/bg-3-white.png') }}');"></div>

    <!-- Overlay para dar contraste -->
    <div class="absolute inset-0 bg-white/60 dark:bg-black/70"></div>

    <!-- Conteúdo -->
    <div class="relative z-10 container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        <!-- Lado Esquerdo - Copy -->
        <div class="space-y-6 text-center md:text-left">
            <h2 class="text-4xl font-bold text-secondary-black dark:text-white font-poppins">
                Solicite já seu <span class="text-primary">Orçamento Online</span>
            </h2>
            <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed max-w-lg font-roboto">
                Queremos entender melhor suas necessidades e preparar a solução ideal para o seu negócio.
                Clique no botão abaixo e responda algumas perguntas rápidas. Assim, já entraremos em contato com uma proposta personalizada para você.
            </p>
            <a href="{{ route('budget') }}"
               class="font-poppins inline-block px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/80 transition">
                Solicitar Orçamento →
            </a>
        </div>

        <!-- Lado Direito - Formulário -->
        <div class="bg-white dark:bg-neutral-900 border border-primary/20 dark:border-zinc-700 rounded-2xl shadow-xl p-8">
            <h3 class="text-2xl font-semibold text-secondary-black dark:text-white mb-6 text-center font-poppins">
                Fique por dentro das novidades  <span class="ml-2">🚀</span>
            </h3>
            <form action="#" method="POST" class="space-y-5">
                @csrf
                <!-- Input Nome -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Seu Nome</label>
                    <input type="text" name="name"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-zinc-600
                                  bg-gray-50 dark:bg-primary/20 text-secondary-black dark:text-white
                                  focus:border-primary focus:ring-2 focus:ring-primary outline-none transition">
                </div>

                <!-- Input Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Seu E-mail</label>
                    <input type="email" name="email" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-zinc-600
                                  bg-gray-50 dark:bg-primary/20 text-secondary-black dark:text-white
                                  focus:border-primary focus:ring-2 focus:ring-primary outline-none transition">
                </div>

                <!-- Botão -->
                <button type="submit"
                        class="font-poppins w-full px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md
                               hover:bg-primary/90 transition">
                    Quero Receber Novidades
                </button>
            </form>
        </div>
    </div>
</div>
