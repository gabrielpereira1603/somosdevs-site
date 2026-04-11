<div class="relative w-full py-12 md:py-20 bg-secondary-white dark:bg-secondary-black">
    <!-- Fundo Light -->
    <div class="absolute inset-0 bg-cover bg-center dark:hidden"
         style="background-image: url('{{ asset('somosdevs/imgs/bg-3.png') }}');"></div>

    <!-- Fundo Dark -->
    <div class="absolute inset-0 bg-fixed bg-center hidden dark:block"
         style="background-image: url('{{ asset('somosdevs/imgs/bg-3-white.png') }}');"></div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-white/60 dark:bg-black/70"></div>

    <!-- Conteúdo -->
    <div class="relative z-10 container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 overflow-hidden rounded-3xl border border-primary/20 dark:border-zinc-700 shadow-2xl bg-white/95 dark:bg-neutral-900 backdrop-blur-sm">

            <!-- Lado Esquerdo - Contato -->
            <div class="bg-secondary-black dark:bg-zinc-950 text-white p-8 md:p-10 flex flex-col justify-between min-h-full">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-11 h-11 rounded-xl border border-white/15 bg-white/5 flex items-center justify-center">
                            <i class="fa-regular fa-address-card text-primary text-lg"></i>
                        </span>

                        <h3 class="text-2xl md:text-3xl font-bold font-poppins">
                            Entrar em contato
                        </h3>
                    </div>

                    <p class="text-white/70 text-base md:text-lg leading-relaxed font-roboto mb-10 max-w-md">
                        Estamos presente em diversos Estados do Brasil com clientes de consultoria e alunos dos nossos cursos.
                    </p>

                    <div class="space-y-6">
                        <!-- Email -->
                        <div class="flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 hover:bg-white/10 transition">
                            <div class="w-14 h-14 rounded-2xl bg-primary/15 flex items-center justify-center shrink-0">
                                <i class="fa-regular fa-envelope text-xl text-primary"></i>
                            </div>

                            <div>
                                <h4 class="text-lg md:text-xl font-semibold font-poppins mb-1">Email</h4>
                                <p class="text-white/70 text-base font-roboto break-all">
                                    admin@somosdevs.com
                                </p>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 hover:bg-white/10 transition">
                            <div class="w-14 h-14 rounded-2xl bg-primary/15 flex items-center justify-center shrink-0">
                                <i class="fa-brands fa-whatsapp text-xl text-primary"></i>
                            </div>

                            <div>
                                <h4 class="text-lg md:text-xl font-semibold font-poppins mb-1">Whatsapp</h4>
                                <p class="text-white/70 text-base font-roboto">
                                    +55 (17) 97600-1413
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Redes sociais -->
                <div class="mt-12">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="w-10 h-[2px] bg-primary/70"></span>
                        <h4 class="text-xl md:text-2xl font-semibold font-poppins text-white">
                            Redes Sociais
                        </h4>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="#"
                           class="group w-14 h-14 rounded-2xl border border-white/10 bg-white/5 hover:bg-primary hover:border-primary transition flex items-center justify-center">
                            <i class="fa-brands fa-instagram text-xl text-white/80 group-hover:text-white"></i>
                        </a>

                        <a href="#"
                           class="group w-14 h-14 rounded-2xl border border-white/10 bg-white/5 hover:bg-primary hover:border-primary transition flex items-center justify-center">
                            <i class="fa-brands fa-facebook-f text-xl text-white/80 group-hover:text-white"></i>
                        </a>

                        <a href="#"
                           class="group w-14 h-14 rounded-2xl border border-white/10 bg-white/5 hover:bg-primary hover:border-primary transition flex items-center justify-center">
                            <i class="fa-brands fa-linkedin-in text-xl text-white/80 group-hover:text-white"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Lado Direito - Formulário -->
            <div class="bg-white dark:bg-neutral-900 p-8 md:p-10">
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-11 h-11 rounded-xl border border-primary/20 bg-primary/10 flex items-center justify-center">
                        <i class="fa-solid fa-list-ul text-primary text-lg"></i>
                    </span>

                    <h3 class="text-2xl md:text-3xl font-bold text-secondary-black dark:text-white font-poppins">
                        Formulário
                    </h3>
                </div>

                <form action="#" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nome -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                                Nome:
                            </label>
                            <input
                                type="text"
                                name="name"
                                placeholder="Digite seu nome aqui"
                                class="w-full px-4 py-4 rounded-xl border border-gray-300 dark:border-zinc-700
                                       bg-gray-50 dark:bg-zinc-800/80 text-secondary-black dark:text-white
                                       placeholder:text-gray-400 dark:placeholder:text-gray-500
                                       focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition"
                            >
                        </div>

                        <!-- Telefone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                                Telefone:
                            </label>
                            <input
                                type="text"
                                name="phone"
                                placeholder="Digite seu telefone aqui"
                                class="w-full px-4 py-4 rounded-xl border border-gray-300 dark:border-zinc-700
                                       bg-gray-50 dark:bg-zinc-800/80 text-secondary-black dark:text-white
                                       placeholder:text-gray-400 dark:placeholder:text-gray-500
                                       focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition"
                            >
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                                Email:
                            </label>
                            <input
                                type="email"
                                name="email"
                                placeholder="Digite seu email aqui"
                                class="w-full px-4 py-4 rounded-xl border border-gray-300 dark:border-zinc-700
                                       bg-gray-50 dark:bg-zinc-800/80 text-secondary-black dark:text-white
                                       placeholder:text-gray-400 dark:placeholder:text-gray-500
                                       focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition"
                            >
                        </div>

                        <!-- Empresa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                                Empresa:
                            </label>
                            <input
                                type="text"
                                name="company"
                                placeholder="Digite o nome aqui"
                                class="w-full px-4 py-4 rounded-xl border border-gray-300 dark:border-zinc-700
                                       bg-gray-50 dark:bg-zinc-800/80 text-secondary-black dark:text-white
                                       placeholder:text-gray-400 dark:placeholder:text-gray-500
                                       focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition"
                            >
                        </div>
                    </div>

                    <!-- Resumo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                            Resumo do projeto:
                        </label>
                        <textarea
                            name="message"
                            rows="6"
                            placeholder="Digite sua mensagem aqui"
                            class="w-full px-4 py-4 rounded-xl border border-gray-300 dark:border-zinc-700
                                   bg-gray-50 dark:bg-zinc-800/80 text-secondary-black dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-gray-500
                                   focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition resize-none"
                        ></textarea>
                    </div>

                    <!-- Botão -->
                    <button
                        type="submit"
                        class="font-poppins w-full px-6 py-4 bg-primary text-white text-base md:text-lg font-semibold rounded-xl shadow-lg hover:bg-primary/90 transition">
                        ENVIAR MENSAGEM
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
