<?php

namespace App\Livewire\Pages;
use App\Models\News;
use App\Models\NewsTranslation;
use App\Models\Banner;
use Livewire\Component;

class NewsDetail extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
        \App::setLocale(session('locale', config('app.locale')));
    }

    public function render()
    {
        $newsTranslation = NewsTranslation::where('slug', $this->slug)->first();
        if (!$newsTranslation) {
            abort(404);
        }

        $news_id = $newsTranslation->news_id;
        $newsTranslation = NewsTranslation::where('news_id', $news_id)
            ->where('locale', session('locale', 'vi'))
            ->first();

        $news = News::find($news_id);
        

        $relatedNews = News::where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->where('status', true)
            ->with(['translations' => function($query) {
                $query->where('locale', session('locale', 'vi'));
            }])
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($news) {
                $translation = $news->translations->first();
                return [
                    'id' => $news->id,
                    'title' => $translation ? $translation->title : '',
                    'description' => $translation ? $translation->description : '',
                    'slug' => $translation ? $translation->slug : '',
                    'image' => $news->image,
                    'date' => $news->date
                ];
            });
        
        return view('livewire.pages.news-detail', [
            'news' => $news,
            'newsTranslation' => $newsTranslation,
            'relatedNews' => $relatedNews
        ])->layout('layouts.app');
    }
} 