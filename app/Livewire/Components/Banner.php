<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Banner as BannerModel;

class Banner extends Component
{
    public $banners = [];

    public function mount()
    {
        $this->banners = BannerModel::where('active', true)
            ->orderBy('order')
            ->get();
    }

    public function render()
    {
        return view('livewire.components.banner');
    }
}