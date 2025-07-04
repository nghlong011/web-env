<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsTranslationSeeder extends Seeder
{
    public function run(): void
    {
        $translations = [];
        
        // Tạo bản dịch cho 28 bài viết
        for ($i = 1; $i <= 40; $i++) {
            // Bản dịch tiếng Anh
            $translations[] = [
                'news_id' => $i,
                'locale' => 'en',
                'title' => $this->getEnglishTitle($i),
                'content' => $this->getEnglishContent($i),
                'description' => $this->getEnglishSummary($i),
                'slug' => $this->getEnglishSlug($i),
                'meta_title' => $this->getEnglishTitle($i),
                'meta_description' => $this->getEnglishSummary($i),
                'meta_keywords' => $this->getEnglishKeywords($i),
                'og_title' => $this->getEnglishTitle($i),
                'og_description' => $this->getEnglishSummary($i),
                'og_image' => '/images/news.png',
                'h1' => $this->getEnglishTitle($i),
                'alt_text' => $this->getEnglishAltText($i),
            ];

            // Bản dịch tiếng Việt
            $translations[] = [
                'news_id' => $i,
                'locale' => 'vi',
                'title' => $this->getVietnameseTitle($i),
                'content' => $this->getVietnameseContent($i),
                'description' => $this->getVietnameseSummary($i),
                'slug' => $this->getVietnameseSlug($i),
                'meta_title' => $this->getVietnameseTitle($i),
                'meta_description' => $this->getVietnameseSummary($i),
                'meta_keywords' => $this->getVietnameseKeywords($i),
                'og_title' => $this->getVietnameseTitle($i),
                'og_description' => $this->getVietnameseSummary($i),
                'og_image' => '/images/news.png',
                'h1' => $this->getVietnameseTitle($i),
                'alt_text' => $this->getVietnameseAltText($i),
            ];
        }

        foreach ($translations as $translation) {
            DB::table('news_translations')->insert([
                'news_id' => $translation['news_id'],
                'locale' => $translation['locale'],
                'title' => $translation['title'],
                'content' => $translation['content'],
                'description' => $translation['description'],
                'slug' => $translation['slug'],
                'meta_title' => $translation['meta_title'],
                'meta_description' => $translation['meta_description'],
                'meta_keywords' => $translation['meta_keywords'],
                'og_title' => $translation['og_title'],
                'og_description' => $translation['og_description'],
                'og_image' => $translation['og_image'],
                'h1' => $translation['h1'],
                'alt_text' => $translation['alt_text'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function getEnglishTitle($index): string
    {
        $titles = [
            0 => 'Environmental Protection Solutions',
            1 => 'Waste Treatment Technology',
            2 => 'Sustainable Development',
            3 => 'Green Technology',
            4 => 'Environmental Impact Assessment',
            5 => 'Waste Management Process',
            6 => 'Environmental Protection Solutions',
            7 => 'Waste Treatment Technology',
            8 => 'Sustainable Development',
            9 => 'Green Technology',
            10 => 'Environmental Impact Assessment',
            11 => 'Waste Management Process'
        ];

        return $titles[$index] ?? "News {$index}";
    }

    private function getVietnameseTitle($index): string
    {
        $titles = [
            0 => 'Giải pháp bảo vệ môi trường',
            1 => 'Công nghệ xử lý rác thải',
            2 => 'Phát triển bền vững',
            3 => 'Công nghệ xanh',
            4 => 'Đánh giá tác động môi trường',
            5 => 'Quy trình quản lý rác thải',
            6 => 'Giải pháp bảo vệ môi trường',
            7 => 'Công nghệ xử lý rác thải',
            8 => 'Phát triển bền vững',
            9 => 'Công nghệ xanh',
            10 => 'Đánh giá tác động môi trường',
            11 => 'Quy trình quản lý rác thải'
        ];

        return $titles[$index] ?? "News {$index}";
    }

    private function getEnglishContent($index): string
    {
        return '<div class="text-black mb-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</div><img src="/images/image-10.svg" alt="news detail" class="w-full max-w-[80%] mx-auto mb-12" /><div class="text-black mb-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</div><img src="/images/image-11.svg" alt="news detail 1" class="w-full max-w-[80%] mx-auto mb-12" /><div class="text-black mb-12">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>';
    }

    private function getVietnameseContent($index): string
    {
        return '<div class="text-black mb-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</div><img src="/images/image-10.svg" alt="news detail" class="w-full max-w-[80%] mx-auto mb-12" /><div class="text-black mb-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</div><img src="/images/image-11.svg" alt="news detail 1" class="w-full max-w-[80%] mx-auto mb-12" /><div class="text-black mb-12">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>';
    }

    private function getEnglishSummary($index): string
    {
        return 'Recently, the Ministry of Natural Resources and Environment has issued technical guidance on the classification of household waste.';
    }

    private function getVietnameseSummary($index): string
    {
        return 'Mới đây, Bộ Tài Nguyên và Môi Trường đã ban hành hướng dẫn kỹ thuật về phân loại chất thải rắn sinh hoạt.';
    }

    private function getEnglishSlug($index): string
    {
        return 'en-' . strtolower(str_replace(' ', '-', $this->getEnglishTitle($index))) . '-' . $index;
    }

    private function getVietnameseSlug($index): string
    {
        return 'vi-' . strtolower(str_replace(' ', '-', $this->getVietnameseTitle($index))) . '-' . $index;
    }

    private function getEnglishKeywords($index): string
    {
        return 'Mới đây, Bộ Tài Nguyên và Môi Trường đã ban hành hướng dẫn kỹ thuật về phân loại chất thải rắn sinh hoạt.';
    }

    private function getVietnameseKeywords($index): string
    {
        return 'Mới đây, Bộ Tài Nguyên và Môi Trường đã ban hành hướng dẫn kỹ thuật về phân loại chất thải rắn sinh hoạt.';
    }

    private function getEnglishAltText($index): string
    {
        return $this->getEnglishTitle($index);
    }

    private function getVietnameseAltText($index): string
    {
        return $this->getVietnameseTitle($index);
    }
} 