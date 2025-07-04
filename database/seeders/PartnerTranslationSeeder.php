<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\PartnerTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = Partner::all();
        $locales = ['en', 'vi'];

        foreach ($partners as $partner) {
            foreach ($locales as $locale) {
                PartnerTranslation::create([
                    'partner_id' => $partner->id,
                    'locale' => $locale,
                    'name' => "Partner " . $partner->id . " (" . strtoupper($locale) . ")",
                    'description' => "Description for Partner " . $partner->id . " in " . strtoupper($locale),
                    'website' => "https://partner" . $partner->id . ".com"
                ]);
            }
        }
    }
}
