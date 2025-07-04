<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Partner;

class Partners extends Component
{
    public function render()
    {
        $partners = Partner::with(['translations' => function($q) {
            $q->where('locale', app()->getLocale());
        }])->active()->ordered()->get();
        return view('livewire.components.partners', compact('partners'));
    }
} 