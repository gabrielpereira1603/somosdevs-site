<div class="relative w-full py-20 bg-white dark:bg-secondary-black">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        <!-- Texto Sobre Nós -->
        <div class="space-y-6">
            <!-- Subtítulo -->
            <span class="text-sm uppercase tracking-wider text-primary font-poppins font-bold rounded-lg border border-primary px-2 py-2">
                Sobre Nós
            </span>

            <!-- Título principal -->
            <h2 class="text-4xl font-bold text-secondary-black dark:text-white font-poppins mt-4">
                Somos a <span class="text-primary">SomosDevs</span>, uma empresa moldada ao seu negócio
            </h2>

            <!-- Copy -->
            <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed font-roboto">
                Nosso compromisso é adaptar a tecnologia à realidade de cada cliente.
                Criamos soluções digitais <strong>flexíveis, escaláveis e inovadoras</strong>,
                garantindo que sua empresa cresça com eficiência e segurança.
            </p>

            <!-- Lista de vantagens -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-arrows-rotate text-primary text-2xl"></i>
                    <p class="text-gray-700 dark:text-gray-300 font-roboto">
                        <strong>Moldável ao seu negócio</strong><br>
                        Sistemas personalizados para sua realidade.
                    </p>
                </div>

                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-gear text-primary text-2xl"></i>
                    <p class="text-gray-700 dark:text-gray-300 font-roboto">
                        <strong>Automatização de processos</strong><br>
                        Elimine tarefas repetitivas e ganhe tempo.
                    </p>
                </div>

                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-shield-halved text-primary text-2xl"></i>
                    <p class="text-gray-700 dark:text-gray-300 font-roboto">
                        <strong>Segurança e confiabilidade</strong><br>
                        Proteção de dados e estabilidade garantida.
                    </p>
                </div>

                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-headset text-primary text-2xl"></i>
                    <p class="text-gray-700 dark:text-gray-300 font-roboto">
                        <strong>Suporte contínuo</strong><br>
                        Equipe disponível para te ajudar sempre.
                    </p>
                </div>
            </div>

            <!-- CTA -->
            <a href="#contato"
               class="font-poppins inline-block px-6 py-3 mt-6 bg-primary text-white rounded-lg shadow-md hover:bg-primary/80 transition">
                Fale Conosco →
            </a>
        </div>

        <!-- Vídeo como "GIF" -->
        <div class="relative w-full h-64 md:h-96 rounded-2xl overflow-hidden shadow-lg">
            <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover rounded-2xl">
                <source src="{{ asset('somosdevs/Motion/Motion LOGO Horizontal.mp4') }}" type="video/mp4">
                Seu navegador não suporta vídeos HTML5.
            </video>
        </div>
    </div>
</div>
