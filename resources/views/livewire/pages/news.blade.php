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

    <section class="bg-[#EBF1F1] text-white py-10 xl:py-20">
        <div class="container mx-auto px-4 xl:px-20 2xl:px-24">
            <div class="container mx-auto mt-4 bg-[#EBF1F1]">
                <div class="grid grid-cols-2 xl:grid-cols-4">
                    <button
                        class="py-2 focus:outline-none border-b-[1.5px] cursor-pointer {{ $tab === 'environment' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}"
                        wire:click="$set('tab', 'environment')">
                        <span
                            class="group-title-mobile text-[8px] md:text-sm 2xl:text-base cursor-pointer uppercase transition title-animate">
                            <span class="line1">{{ __('new.environment') }}</span>
                        </span>
                    </button>
                    <button
                        class="py-2 focus:outline-none border-b-[1.5px] cursor-pointer {{ $tab === 'project' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}"
                        wire:click="$set('tab', 'project')">
                        <span
                            class="group-title-mobile text-[8px] md:text-sm 2xl:text-base cursor-pointer uppercase transition title-animate">
                            <span class="line1">{{ __('new.project') }}</span>
                        </span>
                    </button>
                    <button
                        class="py-2 focus:outline-none border-b-[1.5px] cursor-pointer {{ $tab === 'regulation' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}"
                        wire:click="$set('tab', 'regulation')">
                        <span
                            class="group-title-mobile text-[8px] md:text-sm 2xl:text-base cursor-pointer uppercase transition title-animate">
                            <span class="line1">{{ __('new.regulation') }}</span>
                        </span>
                    </button>
                    <button
                        class="py-2 focus:outline-none border-b-[1.5px] cursor-pointer {{ $tab === 'other' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}"
                        wire:click="$set('tab', 'other')">
                        <span
                            class="group-title-mobile text-[8px] md:text-sm 2xl:text-base cursor-pointer uppercase transition title-animate">
                            <span class="line1">{{ __('new.other') }}</span>
                        </span>
                    </button>
                </div>
                <div class="mt-15">
                    @if ($tab === 'environment')
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($newsEnvironment as $item)
                                <x-news-card :title="$item->title" :date="$item->date" :description="$item->description" :image="$item->image"
                                    :link="$item->slug" :category="$item->category" />
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="flex justify-center mt-8">
                            {{ $newsEnvironment->links('components.pagination') }}
                        </div>
                    @elseif ($tab === 'project')
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($newsProject as $item)
                                <x-news-card :title="$item->title" :date="$item->date" :description="$item->description" :image="$item->image"
                                    :link="$item->slug" :category="$item->category" />
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="flex justify-center mt-8">
                            {{ $newsProject->links('components.pagination') }}
                        </div>
                    @elseif ($tab === 'regulation')
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($newsRegulation as $item)
                                <x-news-card :title="$item->title" :date="$item->date" :description="$item->description" :image="$item->image"
                                    :link="$item->slug" :category="$item->category" />
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="flex justify-center mt-8">
                            {{ $newsRegulation->links('components.pagination') }}
                        </div>
                    @elseif ($tab === 'other')
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($newsOther as $item)
                                <x-news-card :title="$item->title" :date="$item->date" :description="$item->description" :image="$item->image"
                                    :link="$item->slug" :category="$item->category" />
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="flex justify-center mt-8">
                            {{ $newsOther->links('components.pagination') }}
                        </div>
                    @endif
                </div>
            </div>
    </section>
</div>
