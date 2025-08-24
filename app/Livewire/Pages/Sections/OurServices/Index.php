<?php

namespace App\Livewire\Pages\Sections\OurServices;

use Livewire\Component;

class Index extends Component
{
    public string $filter = 'all';
    public array $services = [
        [
            'title' => 'SMI',
            'type' => 'web',
            'image' => 'somosdevs/imgs/smi-2.png',
            'link' => 'https://somosdevteam.com/SMI/login',
            'desc' => 'Sistema de Manutenções Integrado - SMI',
        ],
        [
            'title' => 'SMI Mobile',
            'type' => 'mobile',
            'image' => 'somosdevs/imgs/smi-mobile-2.png',
            'link' => '#',
            'desc' => 'Sistema de Manutenções Integrado - Mobile',
        ],
        [
            'title' => 'GeoSegBar - ERP',
            'type' => 'web',
            'image' => 'somosdevs/imgs/geosegbar.png',
            'link' => '#',
            'desc' => 'Sistema Gestão de Usinas Hidrelétricas',
        ],
        [
            'title' => 'GeoSegBar - Mobile',
            'type' => 'web',
            'image' => 'somosdevs/imgs/geosegbar-mobile.png',
            'link' => '#',
            'desc' => 'Sistema Gestão de Usinas Hidrelétricas para tabletes e celulares',
        ],
        [
            'title' => 'Trilha do Java - CRM',
            'type' => 'web',
            'image' => 'somosdevs/imgs/trilhadojava-2.png',
            'link' => '#',
            'desc' => 'Sistema CRM para vendas de ingressos online',
        ],
        [
            'title' => 'Etec Andradina - ERP',
            'type' => 'web',
            'image' => 'somosdevs/imgs/etec.jpg',
            'link' => '#',
            'desc' => 'Sistema ERP para gestão de inscrições em vestibulares',
        ],
        [
            'title' => 'Cure On - CRM',
            'type' => 'web',
            'image' => 'somosdevs/imgs/cureon.png',
            'link' => '#',
            'desc' => 'Sistema CRM para vendas de planos de telemedicina',
        ],
    ];

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
    }

    public function getFilteredServicesProperty(): array
    {
        if ($this->filter === 'all') {
            return $this->services;
        }

        // Reindexa o array para evitar problemas no foreach
        return array_values(array_filter(
            $this->services,
            fn ($service) => $service['type'] === $this->filter
        ));
    }

    public function render()
    {
        return view('livewire.pages.sections.our-services.index');
    }
}
