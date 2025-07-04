<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'logo' => 'images/svg/logo-1.svg',
                'status' => true,
                'sort_order' => 1
            ],
            [
                'logo' => 'images/svg/logo-2.svg',
                'status' => true,
                'sort_order' => 2
            ],
            [
                'logo' => 'images/svg/logo-3.svg',
                'status' => true,
                'sort_order' => 3
            ],
            [
                'logo' => 'images/svg/logo-4.svg',
                'status' => true,
                'sort_order' => 4
            ],
            [
                'logo' => 'images/svg/logo-1.svg',
                'status' => true,
                'sort_order' => 5
            ],
            
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
