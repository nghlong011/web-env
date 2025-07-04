<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [];
        
        // Tạo 20 gallery cho category 1 (Hình ảnh)
        for ($i = 1; $i <= 20; $i++) {
            $galleries[] = [
                'order' => $i,
                'category' => 1,
                'image' => '/images/image-'.$i.'.svg',
                'status' => true,
                'video_url' => null,
                'document_url' => null,
            ];
        }

        // Tạo 20 gallery cho category 2 (Video)
        for ($i = 1; $i <= 20; $i++) {
            $galleries[] = [
                'order' => $i,
                'category' => 2,
                'image' => "/images/image-{$i}.svg",
                'video_url' => "videos/video{$i}.mp4",
                'status' => true,
                'document_url' => null,
            ];
        }

        // Tạo 20 gallery cho category 3 (Tư liệu)
        for ($i = 1; $i <= 20; $i++) {
            $galleries[] = [
                'order' => $i,
                'category' => 3,
                'image' => "/images/image-{$i}.svg",
                'status' => true,
                'video_url' => null,
                'document_url' => "documents/document{$i}.pdf",
            ];
        }

        foreach ($galleries as $gallery) {
            DB::table('galleries')->insert([
                'order' => $gallery['order'],
                'category' => $gallery['category'],
                'image' => $gallery['image'],
                'video_url' => $gallery['video_url'],
                'document_url' => $gallery['document_url'],
                'status' => $gallery['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
