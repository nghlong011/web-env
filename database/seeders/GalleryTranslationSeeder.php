<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $translations = [];
        
        // Tạo dữ liệu cho 9 gallery sự kiện (ID 1-9)
        for ($i = 1; $i <= 20; $i++) {
            // Tiếng Việt
            $translations[] = [
                'title' => "Sự kiện {$i}",
                'locale' => 'vi',
                'gallery_id' => $i,
            ];
            
            // Tiếng Anh
            $translations[] = [
                'title' => "Event {$i}",
                'locale' => 'en',
                'gallery_id' => $i,
            ];
        }
        
        // Tạo dữ liệu cho 9 gallery video (ID 10-18)
        for ($i = 1; $i <= 20; $i++) {
            // Tiếng Việt
            $translations[] = [
                'title' => "Video {$i}",
                'locale' => 'vi',
                'gallery_id' => $i + 20,
            ];
            
            // Tiếng Anh
            $translations[] = [
                'title' => "Video {$i}",
                'locale' => 'en',
                'gallery_id' => $i + 20,
            ];
        }
        
        // Tạo dữ liệu cho 9 gallery tư liệu (ID 19-27)
        for ($i = 1; $i <= 20; $i++) {
            // Tiếng Việt
            $translations[] = [
                'title' => "Tư liệu {$i}",
                'locale' => 'vi',
                'gallery_id' => $i + 40,
            ];
            
            // Tiếng Anh
            $translations[] = [
                'title' => "Document {$i}",
                'locale' => 'en',
                'gallery_id' => $i + 40,
            ];
        }

        foreach ($translations as $translation) {
            DB::table('galleries_translations')->insert([
                'title' => $translation['title'],
                'locale' => $translation['locale'],
                'gallery_id' => $translation['gallery_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 