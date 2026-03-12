<div class="relative w-full py-16 md:py-20 bg-white dark:bg-secondary-black">
    <!-- Fundo Light -->
    <div class="absolute inset-0 bg-cover bg-center dark:hidden"
         style="background-image: url('{{ asset('somosdevs/imgs/bg-3.png') }}');"></div>

    <!-- Fundo Dark -->
    <div class="absolute inset-0 bg-fixed bg-center hidden dark:block"
         style="background-image: url('{{ asset('somosdevs/imgs/bg-3-white.png') }}');"></div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-white/70 dark:bg-black/75"></div>

    <div class="relative z-10 container mx-auto px-6">
        <div class="max-w-4xl mx-auto rounded-3xl border border-primary/20 dark:border-zinc-700 shadow-2xl bg-white/95 dark:bg-zinc-900/95 backdrop-blur-sm p-8 md:p-10">

            <!-- Header -->
            <div class="mb-8 text-center">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <span class="w-12 h-12 rounded-2xl border border-primary/20 bg-primary/10 flex items-center justify-center">
                        <i class="fa-solid fa-file-signature text-primary text-lg"></i>
                    </span>

                    <h2 class="text-2xl md:text-3xl font-bold text-secondary-black dark:text-white font-poppins">
                        Formulário de Solicitação
                    </h2>
                </div>

                <p class="text-gray-600 dark:text-gray-300 font-roboto max-w-2xl mx-auto leading-relaxed">
                    Preencha as etapas abaixo para solicitar um orçamento ou enviar sua dúvida.
                    O processo é rápido, organizado e no final sua solicitação ficará salva para acompanhamento no painel.
                </p>
            </div>

            <!-- Steps -->
            <div class="mb-8">
                <div class="flex items-center gap-2 md:gap-4">
                    @foreach([1,2,3,4] as $s)
                        <div class="flex items-center flex-1">
                            <div class="w-10 h-10 md:w-11 md:h-11 rounded-full flex items-center justify-center text-sm font-bold border-2 transition
                                {{ $step >= $s
                                    ? 'bg-primary text-white border-primary shadow-md'
                                    : 'bg-white dark:bg-zinc-800 text-gray-400 border-gray-300 dark:border-zinc-700' }}">
                                {{ $s }}
                            </div>

                            @if($s < 4)
                                <div class="flex-1 h-1 mx-1 rounded-full {{ $step > $s ? 'bg-primary' : 'bg-gray-200 dark:bg-zinc-700' }}"></div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 flex justify-center">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary text-sm font-medium text-center">
                        <i class="fa-solid fa-layer-group"></i>
                        @if($step === 1) Identificação
                        @elseif($step === 2) Tipo de solicitação
                        @elseif($step === 3 && $intent === 'duvida') Sua dúvida
                        @elseif($step === 3 && $intent === 'orcamento') Sobre seu projeto
                        @elseif($step === 4) Informações finais
                        @endif
                    </div>
                </div>
            </div>

            @if (session()->has('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 text-green-700 px-5 py-4 dark:bg-green-900/20 dark:border-green-800 dark:text-green-300">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-circle-check mt-1"></i>
                        <div>
                            <p class="font-semibold font-poppins">Solicitação enviada com sucesso!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Step 1 -->
            @if($step === 1)
                <div class="space-y-5 max-w-3xl mx-auto">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                            Seu nome
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <input
                                type="text"
                                wire:model.defer="name"
                                placeholder="Digite seu nome completo"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700
                                bg-gray-50 dark:bg-zinc-800 text-secondary-black dark:text-white
                                focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                            >
                        </div>
                        @error('name') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                            Seu e-mail
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fa-regular fa-envelope"></i>
                            </span>
                            <input
                                type="email"
                                wire:model.defer="email"
                                placeholder="Digite seu melhor e-mail"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700
                                bg-gray-50 dark:bg-zinc-800 text-secondary-black dark:text-white
                                focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                            >
                        </div>
                        @error('email') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                            WhatsApp
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fa-brands fa-whatsapp"></i>
                            </span>
                            <input
                                type="text"
                                wire:model.defer="contact"
                                placeholder="Opcional"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700
                                bg-gray-50 dark:bg-zinc-800 text-secondary-black dark:text-white
                                focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                            >
                        </div>
                        @error('contact') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2 flex justify-center md:justify-end">
                        <button
                            wire:click="nextStep"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl shadow-md hover:bg-primary/90 transition font-poppins">
                            Próximo
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Step 2 -->
            @if($step === 2)
                <div class="space-y-4 max-w-3xl mx-auto">
                    <p class="text-lg font-semibold text-secondary-black dark:text-white font-poppins text-center">
                        O que você deseja?
                    </p>

                    <button
                        type="button"
                        wire:click="selectIntent('duvida')"
                        class="w-full text-left rounded-2xl border p-5 transition
                        {{ $intent === 'duvida'
                            ? 'border-primary bg-primary text-white'
                            : 'border-gray-200 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-800 hover:border-primary' }}">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                {{ $intent === 'duvida' ? 'bg-white/15' : 'bg-primary/10 text-primary' }}">
                                <i class="fa-regular fa-circle-question"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold font-poppins text-lg">Tirar uma dúvida</h3>
                                <p class="text-sm {{ $intent === 'duvida' ? 'text-white/80' : 'text-gray-500 dark:text-gray-400' }}">
                                    Envie uma pergunta sobre serviços, funcionamento ou atendimento.
                                </p>
                            </div>
                        </div>
                    </button>

                    <button
                        type="button"
                        wire:click="selectIntent('orcamento')"
                        class="w-full text-left rounded-2xl border p-5 transition
                        {{ $intent === 'orcamento'
                            ? 'border-primary bg-primary text-white'
                            : 'border-gray-200 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-800 hover:border-primary' }}">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                {{ $intent === 'orcamento' ? 'bg-white/15' : 'bg-primary/10 text-primary' }}">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold font-poppins text-lg">Solicitar orçamento</h3>
                                <p class="text-sm {{ $intent === 'orcamento' ? 'text-white/80' : 'text-gray-500 dark:text-gray-400' }}">
                                    Conte mais sobre o seu projeto para montarmos uma proposta personalizada.
                                </p>
                            </div>
                        </div>
                    </button>

                    @error('intent') <span class="text-sm text-red-500 block text-center">{{ $message }}</span> @enderror

                    <div class="pt-2 flex justify-center md:justify-start">
                        <button
                            wire:click="prevStep"
                            type="button"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 dark:bg-zinc-800 text-secondary-black dark:text-white rounded-xl hover:bg-gray-200 dark:hover:bg-zinc-700 transition font-poppins">
                            <i class="fa-solid fa-arrow-left"></i>
                            Voltar
                        </button>
                    </div>
                </div>
            @endif

            <!-- Step 3 dúvida -->
            @if($step === 3 && $intent === 'duvida')
                <div class="space-y-5 max-w-3xl mx-auto">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                            Escreva sua dúvida
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-gray-400">
                                <i class="fa-regular fa-message"></i>
                            </span>
                            <textarea
                                wire:model.defer="message"
                                rows="6"
                                placeholder="Descreva sua dúvida com o máximo de detalhes possível"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700
                                bg-gray-50 dark:bg-zinc-800 text-secondary-black dark:text-white
                                focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none"
                            ></textarea>
                        </div>
                        @error('message') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center sm:justify-between gap-3">
                        <button
                            wire:click="prevStep"
                            type="button"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 dark:bg-zinc-800 text-secondary-black dark:text-white rounded-xl hover:bg-gray-200 dark:hover:bg-zinc-700 transition font-poppins">
                            <i class="fa-solid fa-arrow-left"></i>
                            Voltar
                        </button>

                        <button
                            wire:click="submit"
                            wire:loading.attr="disabled"
                            type="button"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-xl shadow-md hover:bg-primary/90 transition font-poppins">
                            Enviar solicitação
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Step 3 orçamento -->
            @if($step === 3 && $intent === 'orcamento')
                <div class="space-y-5 max-w-3xl mx-auto">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                            Tipo de projeto
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fa-solid fa-briefcase"></i>
                            </span>
                            <select
                                wire:model.defer="projectType"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700
                                bg-gray-50 dark:bg-zinc-800 text-secondary-black dark:text-white
                                focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                                <option value="">Selecione o tipo de projeto</option>
                                <option value="web">Sistema Web</option>
                                <option value="mobile">Aplicativo Mobile</option>
                                <option value="erp_crm">ERP / CRM</option>
                                <option value="consultoria">Consultoria</option>
                                <option value="outros">Outros</option>
                            </select>
                        </div>
                        @error('projectType') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                            Descreva seu projeto
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-gray-400">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </span>
                            <textarea
                                wire:model.defer="description"
                                rows="6"
                                placeholder="Explique o objetivo, funcionalidades esperadas e qualquer detalhe importante"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700
                                bg-gray-50 dark:bg-zinc-800 text-secondary-black dark:text-white
                                focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none"
                            ></textarea>
                        </div>
                        @error('description') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center sm:justify-between gap-3">
                        <button
                            wire:click="prevStep"
                            type="button"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 dark:bg-zinc-800 text-secondary-black dark:text-white rounded-xl hover:bg-gray-200 dark:hover:bg-zinc-700 transition font-poppins">
                            <i class="fa-solid fa-arrow-left"></i>
                            Voltar
                        </button>

                        <button
                            wire:click="nextStep"
                            type="button"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-xl shadow-md hover:bg-primary/90 transition font-poppins">
                            Próximo
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Step 4 -->
            @if($step === 4 && $intent === 'orcamento')
                <div class="space-y-5 max-w-3xl mx-auto">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                            Prazo estimado
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fa-regular fa-calendar"></i>
                            </span>
                            <select
                                wire:model.defer="deadline"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700
                                bg-gray-50 dark:bg-zinc-800 text-secondary-black dark:text-white
                                focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                                <option value="">Selecione o prazo</option>
                                <option value="urgente">Imediato</option>
                                <option value="curto">Próximos 3 meses</option>
                                <option value="medio">Até 6 meses</option>
                                <option value="flexivel">Flexível</option>
                            </select>
                        </div>
                        @error('deadline') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 font-roboto">
                            Faixa de investimento
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </span>
                            <select
                                wire:model.defer="budget"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700
                                bg-gray-50 dark:bg-zinc-800 text-secondary-black dark:text-white
                                focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                                <option value="">Selecione uma faixa</option>
                                <option value="baixo">Até R$ 5 mil</option>
                                <option value="medio">R$ 5 mil a R$ 20 mil</option>
                                <option value="alto">Acima de R$ 20 mil</option>
                                <option value="nao_sei">Ainda não sei informar</option>
                            </select>
                        </div>
                        @error('budget') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center sm:justify-between gap-3">
                        <button
                            wire:click="prevStep"
                            type="button"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 dark:bg-zinc-800 text-secondary-black dark:text-white rounded-xl hover:bg-gray-200 dark:hover:bg-zinc-700 transition font-poppins">
                            <i class="fa-solid fa-arrow-left"></i>
                            Voltar
                        </button>

                        <button
                            wire:click="submit"
                            wire:loading.attr="disabled"
                            type="button"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-xl shadow-md hover:bg-primary/90 transition font-poppins">
                            Finalizar envio
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            @endif

            <div wire:loading.flex class="mt-6 items-center justify-center gap-2 text-primary font-medium">
                <i class="fa-solid fa-spinner fa-spin"></i>
                Processando...
            </div>
        </div>
    </div>
</div>
