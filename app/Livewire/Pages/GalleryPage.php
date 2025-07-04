<?php

namespace App\Livewire\Pages;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryPage extends Component
{   
    use WithPagination;

    public $tab = 'hinhanh';

    public function mount()
    {
        \App::setLocale(session('locale', config('app.locale')));
        if (request()->has('tab')) {
            $this->tab = request()->query('tab');
        }
    }

    public function updatedTab()
    {
        $this->resetPage();
    }

    public function render()
    {
        $images = Gallery::where('category', '1')
            ->with(['translations' => function($query) {
                $query->where('locale', app()->getLocale());
            }])
            ->paginate(9);
        $videos = Gallery::where('category', '2')
            ->with(['translations' => function($query) {
                $query->where('locale', app()->getLocale());
            }])
            ->paginate(9);
        $documents = Gallery::where('category', '3')
            ->with(['translations' => function($query) {
                $query->where('locale', app()->getLocale());
            }])
            ->paginate(9);

        return view('livewire.pages.gallery', [
            'images' => $images,
            'videos' => $videos,
            'documents' => $documents
        ])
            ->layout('layouts.app');
    }
}
