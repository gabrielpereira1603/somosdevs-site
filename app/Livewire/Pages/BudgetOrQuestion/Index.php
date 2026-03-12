<?php

namespace App\Livewire\Pages\BudgetOrQuestion;

use App\Models\BudgetRequest;
use Livewire\Component;

class Index extends Component
{
    public int $step = 1;

    public string $name = '';
    public string $email = '';
    public string $contact = '';

    public string $intent = '';
    public string $message = '';

    public string $projectType = '';
    public string $description = '';
    public string $deadline = '';
    public string $budget = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'contact' => ['nullable', 'string', 'max:30'],

            'intent' => ['required', 'in:duvida,orcamento'],

            'message' => ['nullable', 'string', 'min:5'],

            'projectType' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'min:5'],
            'deadline' => ['nullable', 'string', 'max:255'],
            'budget' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Informe seu nome.',
            'name.min' => 'Seu nome precisa ter pelo menos 3 caracteres.',
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'intent.required' => 'Selecione uma opção para continuar.',
            'message.min' => 'Escreva mais detalhes sobre sua dúvida.',
            'description.min' => 'Descreva melhor seu projeto.',
        ];
    }

    public function nextStep(): void
    {
        if ($this->step === 1) {
            $this->validate([
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'contact' => ['nullable', 'string', 'max:30'],
            ]);
        }

        if ($this->step === 2) {
            $this->validate([
                'intent' => ['required', 'in:duvida,orcamento'],
            ]);
        }

        if ($this->step === 3 && $this->intent === 'duvida') {
            $this->validate([
                'message' => ['required', 'string', 'min:5'],
            ]);
        }

        if ($this->step === 3 && $this->intent === 'orcamento') {
            $this->validate([
                'projectType' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'min:5'],
            ]);
        }

        if ($this->step < 4) {
            $this->step++;
        }
    }

    public function prevStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function selectIntent(string $intent): void
    {
        $this->intent = $intent;
        $this->nextStep();
    }

    public function submit(): void
    {
        $this->validateFinalStep();

        BudgetRequest::create([
            'name' => $this->name,
            'email' => $this->email,
            'contact' => $this->contact,
            'intent' => $this->intent,
            'message' => $this->intent === 'duvida' ? $this->message : null,
            'project_type' => $this->intent === 'orcamento' ? $this->projectType : null,
            'description' => $this->intent === 'orcamento' ? $this->description : null,
            'deadline' => $this->intent === 'orcamento' ? $this->deadline : null,
            'budget' => $this->intent === 'orcamento' ? $this->budget : null,
            'status' => 'novo',
            'source' => 'site',
        ]);

        session()->flash('success', 'Recebemos sua solicitação com sucesso! Em breve entraremos em contato.');

        $this->resetForm();
    }

    protected function validateFinalStep(): void
    {
        if ($this->intent === 'duvida') {
            $this->validate([
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'intent' => ['required', 'in:duvida,orcamento'],
                'message' => ['required', 'string', 'min:5'],
            ]);

            return;
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'intent' => ['required', 'in:duvida,orcamento'],
            'projectType' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:5'],
            'deadline' => ['required', 'string', 'max:255'],
            'budget' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function resetForm(): void
    {
        $this->step = 1;
        $this->name = '';
        $this->email = '';
        $this->contact = '';
        $this->intent = '';
        $this->message = '';
        $this->projectType = '';
        $this->description = '';
        $this->deadline = '';
        $this->budget = '';
    }

    public function render()
    {
        return view('livewire.pages.budget-or-question.index')
            ->layout('components.layouts.home');
    }
}
