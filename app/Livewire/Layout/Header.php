<?php

namespace App\Livewire\Layout;

use App\Models\Setting;
use Livewire\Component;

class Header extends Component
{
    public $isMobileMenuOpen = false;

    public function toggleMobileMenu()
    {
        $this->isMobileMenuOpen = !$this->isMobileMenuOpen;
    }

    public function closeMobileMenu()
    {
        $this->isMobileMenuOpen = false;
    }

    public function render()
    {
        $logo = Setting::with('translations')->where('key', 'logo')->first();
        $phone = Setting::with('translations')->where('key', 'phone')->first();
        $email = Setting::with('translations')->where('key', 'email')->first();
        $facebook = Setting::with('translations')->where('key', 'facebook')->first();
        $youtube = Setting::with('translations')->where('key', 'youtube')->first();
        return view('livewire.layout.header', compact('logo', 'phone', 'email', 'facebook', 'youtube'));
    }
} 