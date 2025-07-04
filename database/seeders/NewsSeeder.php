<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $news = [];
        
        // Tạo 20 news cho category 1 (Hình ảnh)
        for ($i = 1; $i <= 10; $i++) {
            $news[] = [
                'order' => $i,
                'category' => 1,
                'image' => '/images/image-'.$i.'.svg',
                'status' => true,
                'date' => '2025-04-29',
            ];
        }

        // Tạo 20 news cho category 2 (Video)
        for ($i = 1; $i <= 10; $i++) {
            $news[] = [
                'order' => $i,
                'category' => 2,
                'image' => "/images/image-{$i}.svg",
                'status' => true,
                'date' => '2025-04-29',
            ];
        }

        // Tạo 20 news cho category 3 (Tin tức)
        for ($i = 1; $i <= 10; $i++) {
            $news[] = [
                'order' => $i,
                'category' => 3,
                'image' => "/images/image-{$i}.svg",    
                'status' => true,
                'date' => '2025-04-29',
            ];
        }

        // Tạo 20 news cho category 4 (Tin tức)
        for ($i = 1; $i <= 10; $i++) {
            $news[] = [
                'order' => $i,
                'category' => 4,
                'image' => "/images/image-{$i}.svg",    
                'status' => true,
                'date' => '2025-04-29',
            ];
        }
        foreach ($news as $item) {
            DB::table('news')->insert([
                'image' => $item['image'],
                'category' => $item['category'],
                'order' => $item['order'],
                'date' => $item['date'],
                'status' => $item['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
