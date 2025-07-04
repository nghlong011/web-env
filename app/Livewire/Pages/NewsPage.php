<?php

namespace App\Livewire\Pages;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class NewsPage extends Component
{
    use WithPagination;

    public $tab = 'environment';

    public function mount()
    {
        \App::setLocale(session('locale', config('app.locale')));
        if (request()->has('tab')) {
            $this->tab = request()->query('tab');
        }
    }
    public function updatedTab()
    {
        $this->resetPage('page');
    }
    public function render()
    {
        $newsEnvironment = News::where('category', 1)
            ->where('status', true)
            ->orderBy('date', 'desc')
            ->paginate(9)
            ->through(function ($news) {
                $translation = $news->translation();
                $news->title = $translation ? $translation->title : '';
                $news->content = $translation ? $translation->content : '';
                $news->description = $translation ? $translation->description : '';
                $news->slug = $translation ? $translation->slug : '';
                return $news;
            });
        $newsProject = News::where('category', 2)
            ->where('status', true)
            ->orderBy('date', 'desc')
            ->paginate(9)
            ->through(function ($news) {
                $translation = $news->translation();
                $news->title = $translation ? $translation->title : '';
                $news->content = $translation ? $translation->content : '';
                $news->description = $translation ? $translation->description : '';
                $news->slug = $translation ? $translation->slug : '';
                return $news;
            });
        $newsRegulation = News::where('category', 3)
            ->where('status', true)
            ->orderBy('date', 'desc')
            ->paginate(9)
            ->through(function ($news) {
                $translation = $news->translation();
                $news->title = $translation ? $translation->title : '';
                $news->content = $translation ? $translation->content : '';
                $news->description = $translation ? $translation->description : '';
                $news->slug = $translation ? $translation->slug : '';
                return $news;
            });
        $newsOther = News::where('category', 4)
            ->where('status', true)
            ->orderBy('date', 'desc')
            ->paginate(9)
            ->through(function ($news) {
                $translation = $news->translation();
                $news->title = $translation ? $translation->title : '';
                $news->content = $translation ? $translation->content : '';
                $news->description = $translation ? $translation->description : '';
                $news->slug = $translation ? $translation->slug : '';
                return $news;
            });
        return view('livewire.pages.news', [
            'newsEnvironment' => $newsEnvironment,
            'newsProject' => $newsProject,
            'newsRegulation' => $newsRegulation,
            'newsOther' => $newsOther
        ])->layout('layouts.app');
    }
} 