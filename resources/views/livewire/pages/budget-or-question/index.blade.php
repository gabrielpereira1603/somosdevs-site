<div class="relative w-full py-20 bg-white dark:bg-secondary-black ">
    <div class="container mx-auto px-6 max-w-3xl bg-white/90 dark:bg-primary/20 border border-primary rounded-2xl shadow-xl p-8 mt-2 lg:mt-5">

        {{-- Header --}}
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-secondary-black dark:text-white">
                🚀 Solicite seu Orçamento ou Tire sua Dúvida
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mt-2">
                Preencha as informações abaixo para podermos te ajudar da melhor forma.
            </p>
        </div>

        {{-- Steps Indicator --}}
        <div class="flex justify-between items-center mb-10">
            @foreach([1,2,3,4] as $s)
                <div class="flex-1 flex items-center">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border-2
                        {{ $step >= $s ? 'bg-primary text-white border-primary' : 'border-gray-400 text-gray-400 bg-white dark:bg-zinc-800' }}">
                        {{ $s }}
                    </div>
                    @if($s < 4)
                        <div class="flex-1 h-1 {{ $step > $s ? 'bg-primary' : 'bg-gray-400 dark:bg-zinc-700' }}"></div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Step 1: Identificação --}}
        @if($step === 1)
            <div class="space-y-4">
                <input type="text" wire:model="name" placeholder="Seu nome"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-zinc-700 dark:bg-primary/20 dark:text-white focus:border-primary" />
                <input type="email" wire:model="email" placeholder="Seu e-mail"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white focus:border-primary" />
                <input type="text" wire:model="contact" placeholder="WhatsApp (opcional)"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white focus:border-primary" />

                <button wire:click="nextStep"
                        class="mt-4 px-6 py-3 bg-primary text-white rounded-lg shadow hover:bg-primary/80">
                    Próximo →
                </button>
            </div>
        @endif

        {{-- Step 2: Intenção --}}
        @if($step === 2)
            <div class="space-y-4">
                <p class="text-lg font-semibold text-secondary-black dark:text-white">O que você deseja?</p>

                <button wire:click="$set('intent','duvida'); nextStep()"
                        class="w-full px-6 py-3 border rounded-lg hover:bg-primary hover:text-white transition
                        {{ $intent==='duvida' ? 'bg-primary text-white' : 'border-gray-300 dark:border-zinc-700 dark:text-white' }}">
                    Tirar uma dúvida
                </button>
                <button wire:click="$set('intent','orcamento'); nextStep()"
                        class="w-full px-6 py-3 border rounded-lg hover:bg-primary hover:text-white transition
                        {{ $intent==='orcamento' ? 'bg-primary text-white' : 'border-gray-300 dark:border-zinc-700 dark:text-white' }}">
                    Solicitar orçamento
                </button>

                <button wire:click="prevStep" class="mt-4 px-6 py-3 bg-gray-200 dark:bg-zinc-700 dark:text-white rounded-lg">← Voltar</button>
            </div>
        @endif

        {{-- Step 3: Se dúvida → campo mensagem / Se orçamento → detalhes --}}
        @if($step === 3)
            @if($intent === 'duvida')
                <div class="space-y-4">
                    <textarea wire:model="message" rows="4" placeholder="Escreva sua dúvida..."
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white focus:border-primary"></textarea>
                    <div class="flex justify-between">
                        <button wire:click="prevStep" class="px-6 py-3 bg-gray-200 dark:bg-zinc-700 dark:text-white rounded-lg">← Voltar</button>
                        <button wire:click="submit" class="px-6 py-3 bg-primary text-white rounded-lg">Enviar</button>
                    </div>
                </div>
            @else

                <div class="space-y-4">
                    <select wire:model="projectType"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white focus:border-primary">
                        <option value="">Selecione o tipo de projeto</option>
                        <option value="web">Sistema Web</option>
                        <option value="mobile">Aplicativo Mobile</option>
                        <option value="erp">ERP / CRM</option>
                        <option value="consultoria">Consultoria</option>
                        <option value="consultoria">Outros</option>
                    </select>

                    <textarea wire:model="description" rows="4" placeholder="Descreva seu projeto..."
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white focus:border-primary"></textarea>

                    <button wire:click="nextStep" class="px-6 py-3 bg-primary text-white rounded-lg">Próximo →</button>
                    <button wire:click="prevStep" class="px-6 py-3 bg-gray-200 dark:bg-zinc-700 dark:text-white rounded-lg">← Voltar</button>
                </div>
            @endif
        @endif

        {{-- Step 4: Detalhes finais (só orçamento) --}}
        @if($step === 4 && $intent === 'orcamento')
            <div class="space-y-4">
                <select wire:model="deadline"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white focus:border-primary">
                    <option value="">Prazo estimado</option>
                    <option value="urgente">Imediato</option>
                    <option value="curto">Próximos 3 meses</option>
                    <option value="medio">6 meses</option>
                    <option value="flexivel">Flexível</option>
                </select>

                <select wire:model="budget"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white focus:border-primary">
                    <option value="">Faixa de investimento</option>
                    <option value="baixo">Até R$ 5 mil</option>
                    <option value="medio">R$ 5 mil – R$ 20 mil</option>
                    <option value="alto">Acima de R$ 20 mil</option>
                    <option value="nao_sabe">Não sei dizer</option>
                </select>

                <div class="flex justify-between">
                    <button wire:click="prevStep" class="px-6 py-3 bg-gray-200 dark:bg-zinc-700 dark:text-white rounded-lg">← Voltar</button>
                    <button wire:click="submit" class="px-6 py-3 bg-primary text-white rounded-lg">Enviar</button>
                </div>
            </div>
        @endif

        {{-- Mensagem de sucesso --}}
        @if (session()->has('success'))
            <div class="mt-6 p-4 bg-green-100 text-green-800 rounded-lg dark:bg-green-800 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>
