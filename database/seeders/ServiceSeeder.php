<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $virtual = [
            'Développement web',
            'Développement mobile',
            'Graphisme / Design',
            'Rédaction',
            'Community management',
        ];

        $physical = [
            'Plomberie',
            'Mécanique auto',
            'Électricité',
            'Maçonnerie',
            'Menuiserie',
            'Ménage',
        ];

        foreach ($virtual as $name) {
            Service::firstOrCreate(['type' => 'virtual', 'name' => $name]);
        }

        foreach ($physical as $name) {
            Service::firstOrCreate(['type' => 'physical', 'name' => $name]);
        }
    }
}