<?php

namespace App\Livewire\Pages;

use App\Models\Setting;
use App\Models\News;
use Livewire\Component;

class Home extends Component
{
    public $locale;

    public function mount()
    {
        \App::setLocale(session('locale', config('app.locale')));
    }
    public function render()
    {
        $about = Setting::with('translations')->where('key', 'about')->first();
        $library_images = Setting::with('translations')->where('key', 'library_images')->first();
        $library_videos = Setting::with('translations')->where('key', 'library_videos')->first();
        $library_documents = Setting::with('translations')->where('key', 'library_documents')->first();
        
        // Lấy tin tức từ database
        $mainNews = News::with('translations')
            ->where('status', true)
            ->orderBy('date', 'desc')
            ->first();
            
        $subNews = News::with('translations')
            ->where('status', true)
            ->where('id', '!=', $mainNews ? $mainNews->id : 0)
            ->orderBy('date', 'desc')
            ->limit(4)
            ->get();
        
        return view('livewire.pages.home', compact('about', 'library_images', 'library_videos', 'library_documents', 'mainNews', 'subNews'))
            ->layout('layouts.app');
    }
} 