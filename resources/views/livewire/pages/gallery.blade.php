@push('styles')
    <style>
        .gslide-image img,
        .gslide-image svg {
            width: 70vw !important;
            height: auto !important;
            max-width: 100vw !important;
            max-height: 100vh !important;
            display: block;
            margin: 0 auto;
        }

        .glightbox-clean .gprev {
            left: 5vw !important;
        }

        .glightbox-clean .gnext {
            right: 5vw !important;
        }
    </style>
@endpush

<div>
    <x-title-header :background="asset('images/title-banner.svg')" title="{{ __('gallery.title') }}" mobile_height="35vh" desktop_height="70vh" />

    <section class="bg-[#EBF1F1] text-white py-10 xl:py-20">
        <div class="container mx-auto px-4 xl:px-20 2xl:px-24 mt-4 bg-[#EBF1F1]">
            <div class="grid grid-cols-3">
                <button
                    class="md:px-2 py-2 focus:outline-none text-[10px] md:text-sm 2xl:text-base border-b-[1.5px] uppercase cursor-pointer {{ $tab === 'hinhanh' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}"
                    wire:click="$set('tab', 'hinhanh')">
                    {{ __('gallery.image') }}
                </button>
                <button
                    class="md:px-2 py-2 focus:outline-none text-[10px] md:text-sm 2xl:text-base border-b-[1.5px] uppercase cursor-pointer {{ $tab === 'video' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}"
                    wire:click="$set('tab', 'video')">
                    {{ __('gallery.video') }}
                </button>
                <button
                    class="md:px-2 py-2 focus:outline-none text-[10px] md:text-sm 2xl:text-base border-b-[1.5px] uppercase cursor-pointer {{ $tab === 'tulieu' ? 'text-[#529949] font-bold border-[#529949]' : 'text-[#969696] border-[#969696]' }}"
                    wire:click="$set('tab', 'tulieu')">
                    {{ __('gallery.document') }}
                </button>
            </div>
            <div>
                @if ($tab === 'hinhanh')
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 xl:gap-12 py-10 xl:py-12">
                        @foreach ($images as $image)
                            <div class="flex flex-col items-center">
                                <a href="{{ asset($image->image) }}" class="glightbox overflow-hidden w-full"
                                    data-gallery="gallery1">
                                    <div class="aspect-[16/9] w-full">
                                        <img src="{{ asset($image->image) }}" alt="{{ $image->title }}"
                                            class="shadow-lg cursor-pointer hover:scale-110 w-full h-full object-cover transition-all duration-300" />
                                    </div>
                                </a>
                                <div class="mt-4 text-center font-bold text-lg text-[#529949]">
                                    <span class="text-xl">{{ $image->translation->title }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        {{ $images->links('components.pagination') }}
                    </div>
                @elseif ($tab === 'video')
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 xl:gap-12 py-10 xl:py-12">
                        @foreach ($videos as $video)
                            @php
                                $allowedDomains = [config('app.url'), 'domain2.com', 'domain3.com'];
                                $isLocalVideo = false;
                                foreach ($allowedDomains as $domain) {
                                    if (str_contains($video->video_url, $domain)) {
                                        $isLocalVideo = true;
                                        break;
                                    }
                                }
                            @endphp
                            <div class="flex flex-col items-center">
                                <a href="{{ asset($video->video_url) }}"
                                    class="glightbox relative w-full bg-gray-800 overflow-hidden group"
                                    @if ($isLocalVideo) data-gallery="gallery-video" data-type="video" @else target="_blank" @endif>
                                    <div class="aspect-[16/9] w-full">
                                        <img src="{{ asset($video->image) }}" alt="{{ $video->title }}"
                                            class="object-cover w-full h-full opacity-80 group-hover:scale-110 transition-all duration-300" />
                                        <span class="absolute inset-0 flex items-center justify-center">
                                            <img src="{{ asset('images/svg/yellow-play-icon.svg') }}" alt="Play"
                                                class="w-16 h-16" />
                                        </span>
                                    </div>
                                </a>
                                <div class="mt-4 text-center font-bold text-lg text-[#529949]">
                                    <span class="text-xl">{{ $video->translation->title }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center mt-8">
                        {{ $videos->links('components.pagination') }}
                    </div>
                @elseif ($tab === 'tulieu')
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 xl:gap-12 py-10 xl:py-12">
                        @foreach ($documents as $document)
                            <div class="flex flex-col items-center">
                                <a href="{{ asset($document->document_url) }}" target="_blank"
                                    class="overflow-hidden w-full">
                                    <div class="aspect-[16/9] w-full">
                                        <img src="{{ asset($document->image) }}" alt="{{ $document->title }}"
                                            class="shadow-lg cursor-pointer hover:scale-110 w-full h-full object-cover transition-all duration-300" />
                                    </div>
                                </a>
                                <div class="mt-4 text-center font-bold text-lg text-[#529949]">
                                    <span class="text-xl">{{ $document->translation->title }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center mt-8">
                        {{ $documents->links('components.pagination') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
