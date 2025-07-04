<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert banners
        $banners = [
            [
                'img' => '/storage/images/banner.jpg',
                'link' => null,
                'category' => '1',
                'order'=>0,
                'active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'img' => '/storage/images/banner.jpg',
                'link' => null,
                'category' => '1',
                'order'=>0,
                'active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $bannerIds = [];
        foreach ($banners as $banner) {
            $bannerIds[] = DB::table('banners')->insertGetId($banner);
        }

        // Insert banner translations
        $translations = [];
        foreach ($bannerIds as $bannerId) {
            // Vietnamese translation
            $translations[] = [
                'banner_id' => $bannerId,
                'locale' => 'vi',
                'title' => '',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            // English translation
            $translations[] = [
                'banner_id' => $bannerId,
                'locale' => 'en',
                'title' => '',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        DB::table('banner_translations')->insert($translations);
    }
}
