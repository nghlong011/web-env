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

        /* CSS cho video trong glightbox */
        .gslide-video {
            width: 80vw !important;
            height: auto !important;
            max-width: 100vw !important;
            max-height: 80vh !important;
        }

        .gslide-video video {
            width: 100% !important;
            height: auto !important;
            max-height: 80vh !important;
        }

        .gslide-video iframe {
            width: 100% !important;
            height: 80vh !important;
            max-height: 80vh !important;
        }

        /* CSS cho Plyr player */
        .plyr {
            width: 100% !important;
            height: auto !important;
            max-height: 80vh !important;
        }

        .plyr video {
            width: 100% !important;
            height: auto !important;
            max-height: 80vh !important;
        }

        /* Đảm bảo video container có kích thước phù hợp */
        .gslide-media {
            width: 80vw !important;
            height: auto !important;
            max-width: 100vw !important;
            max-height: 80vh !important;
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
                                    data-gallery="gallery-image">
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
                                // Kiểm tra xem có phải là video external (YouTube, Vimeo) hay local
                                $videoUrl = $video->video_url;
                                $isExternalVideo = false;
                                
                                // Kiểm tra nếu là YouTube hoặc Vimeo
                                if (str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be') || str_contains($videoUrl, 'vimeo.com')) {
                                    $isExternalVideo = true;
                                }
                            @endphp
                            <div class="flex flex-col items-center">
                                @if ($isExternalVideo)
                                    <a href="{{ $video->video_url }}"
                                        class="glightbox relative w-full bg-gray-800 overflow-hidden group"
                                        data-gallery="gallery-video" 
                                        data-type="video">
                                        <div class="aspect-[16/9] w-full">
                                            <img src="{{ asset($video->image) }}" alt="{{ $video->title }}"
                                                class="object-cover w-full h-full opacity-80 group-hover:scale-110 transition-all duration-300" />
                                            <span class="absolute inset-0 flex items-center justify-center">
                                                <img src="{{ asset('images/svg/yellow-play-icon.svg') }}" alt="Play"
                                                    class="w-16 h-16" />
                                            </span>
                                        </div>
                                    </a>
                                @else
                                    <a href="{{ asset($video->video_url) }}"
                                        class="glightbox relative w-full bg-gray-800 overflow-hidden group"
                                        data-gallery="gallery-video" 
                                        data-type="video">
                                        <div class="aspect-[16/9] w-full">
                                            <img src="{{ asset($video->image) }}" alt="{{ $video->title }}"
                                                class="object-cover w-full h-full opacity-80 group-hover:scale-110 transition-all duration-300" />
                                            <span class="absolute inset-0 flex items-center justify-center">
                                                <img src="{{ asset('images/svg/yellow-play-icon.svg') }}" alt="Play"
                                                    class="w-16 h-16" />
                                            </span>
                                        </div>
                                    </a>
                                @endif
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

<script>
// Hàm khởi tạo GLightbox với kiểm tra
function initGLightbox() {
    // Kiểm tra xem GLightbox đã được load chưa
    if (typeof GLightbox === 'undefined') {
        console.log('GLightbox not loaded yet, retrying in 100ms...');
        setTimeout(initGLightbox, 100);
        return;
    }
    
    // Hủy lightbox cũ nếu có
    if (window.glightboxGallery) {
        window.glightboxGallery.destroy();
    }
    
    // Đợi DOM cập nhật
    setTimeout(() => {
        try {
            window.glightboxGallery = GLightbox({ 
                selector: '.glightbox',
                onOpen: () => {
                    setTimeout(() => {
                        const activeElement = document.activeElement;
                        if (activeElement && activeElement.classList.contains('glightbox')) {
                            activeElement.blur();
                        }
                    }, 100);
                }
            });
            console.log('GLightbox initialized with', document.querySelectorAll('.glightbox').length, 'elements');
        } catch (error) {
            console.error('Error initializing GLightbox:', error);
        }
    }, 100);
}

// Đợi Livewire và GLightbox đều sẵn sàng
function waitForLivewireAndGLightbox() {
    if (typeof Livewire !== 'undefined' && typeof GLightbox !== 'undefined') {
        // Khởi tạo GLightbox lần đầu
        initGLightbox();
        
        // Lắng nghe sự kiện cập nhật của Livewire
        Livewire.hook('message.processed', (message, component) => {
            console.log('Livewire message processed, reinitializing GLightbox');
            initGLightbox();
        });
        
        // Lắng nghe sự kiện navigate của Livewire
        Livewire.hook('navigate', () => {
            console.log('Livewire navigate, reinitializing GLightbox');
            initGLightbox();
        });
    } else {
        // Nếu chưa sẵn sàng, thử lại sau 100ms
        setTimeout(waitForLivewireAndGLightbox, 100);
    }
}

// Bắt đầu khi DOM load
document.addEventListener('DOMContentLoaded', waitForLivewireAndGLightbox);

// Lắng nghe sự kiện click trên các nút phân trang
document.addEventListener('click', function(e) {
    // Kiểm tra nếu click vào nút phân trang
    if (e.target && (
        e.target.matches('button[wire\\:click*="previousPage"]') ||
        e.target.matches('button[wire\\:click*="nextPage"]') ||
        e.target.matches('button[wire\\:click*="gotoPage"]')
    )) {
        console.log('Pagination button clicked, will reinitialize GLightbox after update');
        // Đợi Livewire cập nhật xong rồi khởi tạo lại
        setTimeout(() => {
            initGLightbox();
        }, 300);
    }
});
</script>


