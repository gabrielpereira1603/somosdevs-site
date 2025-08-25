<?php

namespace App\Livewire\Pages\BudgetOrQuestion;

use Livewire\Component;

class Index extends Component
{
    public int $step = 3;

    public string $name = '';
    public string $email = '';
    public string $contact = '';

    public string $intent = ''; // dúvida ou orçamento
    public string $message = '';

    public string $projectType = '';
    public string $description = '';
    public string $deadline = '';
    public string $budget = '';

    public function nextStep(): void
    {
        $this->step++;
    }

    public function prevStep(): void
    {
        $this->step--;
    }

    public function submit()
    {
        // aqui você pode salvar no banco, enviar email etc
        // Exemplo:
        // Lead::create([...]);

        session()->flash('success', 'Obrigado! Entraremos em contato em breve.');
        $this->reset(); // limpa o form
    }

    public function render()
    {
        return view('livewire.pages.budget-or-question.index')->layout('components.layouts.home');
    }
}
