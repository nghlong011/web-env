<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Setting;
class About extends Component
{
    public $locale;

    public function mount()
    {
        \App::setLocale(session('locale', config('app.locale')));

    }
    public function render()
    {
        $about_us = Setting::with('translations')->where('key', 'about_us')->first();
        $project = Setting::with('translations')->where('key', 'project')->first();
        $meaning = Setting::with('translations')->where('key', 'meaning')->first();
        return view('livewire.pages.about', [
            'about_us' => $about_us,
            'project' => $project,
            'meaning' => $meaning,
        ])
            ->layout('layouts.app');
    }
} 