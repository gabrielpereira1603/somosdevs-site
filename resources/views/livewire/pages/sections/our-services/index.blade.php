<div class="relative w-full py-20">
    <!-- bg light -->
    <div class="absolute inset-0 bg-cover bg-center dark:hidden"
         style="background-image: url('{{ asset('somosdevs/bg-2.png') }}');"></div>

    <!-- bg dark -->
    <div class="absolute inset-0 bg-cover bg-center hidden dark:block"
         style="background-image: url('{{ asset('somosdevs/bg-2.png') }}');"></div>

    <!-- camada de cor -->
    <div class="absolute inset-0 bg-white/40 dark:bg-secondary-black/70"></div>

    <div class="relative z-10 container mx-auto px-6">
        <!-- Título -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-secondary-black dark:text-white">
                Nossos <span class="text-primary">Serviços</span>
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                Abaixo estão alguns dos nossos sistemas. Se você já é cliente, clique para ser redirecionado ao painel.
            </p>
        </div>

        <!-- Filtros -->
        <div class="flex justify-center gap-6 mb-6">
            @foreach(['all' => 'Todos', 'mobile' => 'Mobile', 'desktop' => 'Desktop', 'web' => 'Web'] as $value => $label)
                <button
                    wire:click="setFilter('{{ $value }}')"
                    class="px-4 py-2 font-medium transition
                        {{ $filter === $value
                            ? 'border-b-4 border-primary text-primary'
                            : 'border-b-2 border-transparent text-gray-600 dark:text-gray-300 hover:text-primary hover:border-primary/50' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <!-- Grid Serviços -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @php
                $limitedServices = array_slice($this->filteredServices, 0, 5);
            @endphp

            @foreach($limitedServices as $index => $service)
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition"
                     wire:key="service-{{ $filter }}-{{ $index }}">

                    <!-- Imagem -->
                    <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}"
                         class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/70 dark:bg-primary/90 flex flex-col
                                items-center justify-center opacity-0 group-hover:opacity-100
                                transition duration-500">
                        <h4 class="text-white text-2xl font-bold">{{ $service['title'] }}</h4>
                        <p class="text-gray-300 text-sm mb-4 px-4 text-center">{{ $service['desc'] }}</p>
                        <div class="flex gap-4">
                            <a href="{{ asset($service['image']) }}"
                               class="bg-white text-primary w-10 h-10 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                            <a href="{{ $service['link'] }}" target="_blank"
                               class="bg-white text-primary w-10 h-10 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition">
                                <i class="fa-solid fa-link"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Card "Ver Todos" -->
            @if(!empty($limitedServices) && count($this->filteredServices) > 5)
                <div class="flex items-center justify-center rounded-2xl shadow-lg bg-primary/90 dark:bg-secondary-black border border-primary hover:scale-105 transition cursor-pointer"
                     onclick="">
                    <div class="text-center p-10">
                        <i class="fa-solid fa-grid-2 text-white text-4xl mb-4"></i>
                        <h3 class="text-white font-bold text-xl">Ver Todos os Serviços</h3>
                        <p class="text-gray-200 mt-2 text-sm">Clique aqui e explore nossa lista completa de soluções.</p>
                        <span class="inline-block mt-4 px-6 py-2 bg-white text-primary font-semibold rounded-lg shadow hover:bg-gray-200 transition">
                Explorar →
            </span>
                    </div>
                </div>
            @endif


            @if(empty($limitedServices))
                <!-- Fallback quando nem 1 item -->
                <div class="col-span-3 flex flex-col items-center justify-center py-20 bg-primary/10 dark:bg-primary/20 border border-primary dark:border-primary rounded-2xl shadow-lg">
                    <i class="fa-solid fa-circle-exclamation text-5xl text-primary mb-6"></i>
                    <h3 class="text-center text-2xl font-bold text-secondary-black dark:text-white mb-4">
                        Nenhum serviço disponível nesta categoria
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 max-w-lg text-center">
                        No momento, não temos serviços cadastrados aqui.
                        Mas nossa equipe pode desenvolver a solução perfeita para você.
                    </p>
                    <a href="#contato"
                       class="px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/80 transition">
                        Fale Conosco →
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
