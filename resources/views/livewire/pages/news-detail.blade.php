@push('styles')
    <style>
        .group-title-mobile .line2 {
            display: inline;
        }

        @media (max-width: 768px) {
            .group-title-mobile .line2 {
                display: block;
            }
        }
    </style>
@endpush
<div>
    <x-title-header :background="asset('images/title-banner.svg')" title="{{ __('new.title') }}" mobile_height="35vh" desktop_height="70vh" />

    <section class="bg-[#EBF1F1] text-white py-20">
        <x-breadcrumb :items="[
            ['title' => __('new.title'), 'url' => route('news')],
            ['title' => $newsTranslation->title, 'url' => '#'],
        ]" />
        <div class="container mx-auto px-3 md:px-24">
            <div class="container mx-auto mt-4 bg-[#EBF1F1]">

                {{-- <div class="flex grid grid-cols-4">
                    
                    <button
                        class="md:px-2 py-2 focus:outline-none text-xl uppercase cursor-pointer border-b-[1.5px] {{ $news->category === '1' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}">
                        <span
                            class="group-title-mobile text-sm md:text-base cursor-pointer uppercase transition title-animate">
                            <span class="line1">{{ __('new.environment') }}</span>
                        </span>
                    </button>
                    <button
                        class="md:px-2 py-2 focus:outline-none text-xl uppercase cursor-pointer border-b-[1.5px] {{ $news->category === '2' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}">
                        <span
                            class="group-title-mobile text-sm md:text-base cursor-pointer uppercase transition title-animate">
                            <span class="line1">{{ __('new.project') }}</span>
                        </span>
                    </button>
                    <button
                        class="md:px-2 py-2 focus:outline-none text-xl uppercase cursor-pointer border-b-[1.5px] {{ $news->category === '3' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}">
                        <span
                            class="group-title-mobile text-sm md:text-base cursor-pointer uppercase transition title-animate">
                            <span class="line1">{{ __('new.regulation') }}</span>
                        </span>
                    </button>
                    <button
                        class="md:px-2 py-2 focus:outline-none text-xl uppercase cursor-pointer border-b-[1.5px] {{ $news->category === '4' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}">
                        <span
                            class="group-title-mobile text-sm md:text-base cursor-pointer uppercase transition title-animate">
                            <span class="line1">{{ __('new.other') }}</span>
                        </span>
                    </button>
                </div> --}}
                <div class="mt-15 border-b-1 border-black">
                    <section class="content-news">
                        <h1 class="text-2xl md:text-2xl font-bold text-black mb-4 uppercase">
                            {{ $newsTranslation->title }}
                        </h1>
                        <div class="text-[#7F7F7F] text-sm mb-8">
                            {{ $news->date->format('d/m/Y') }}
                        </div>
                        <div class="text-black mb-12">
                            {!! $newsTranslation->content !!}
                        </div>
                    </section>
                </div>
            </div>
            <!-- News Section -->
            <section class="pt-12 bg-[#EBF1F1]">
                <div class="container mx-auto">
                    <div class="flex justify-between items-center mb-16">
                        <div class="flex flex-col items-start">
                            <h2 class="text-3xl font-bold text-black title-animate uppercase">
                                {{ __('new.news_other_title') }}</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($relatedNews as $item)
                            <x-news-card :title="$item['title']" :date="$item['date']" :description="$item['description']" :image="$item['image']"
                                :link="$item['slug']" />
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
