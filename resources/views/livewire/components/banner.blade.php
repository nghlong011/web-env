<!-- Slider main container -->
<div class="swiper banner-swiper w-full h-auto max-h-[100vh] overflow-hidden">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach ($banners as $banner)
            <div class="swiper-slide">
                <a href="{{ $banner->link }}" class="block w-full aspect-[22/9]">
                    <img src="{{ $banner->img }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
                    {{--
                    @if ($banner->title || $banner->description)
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4">
                            @if ($banner->title)
                                <h3 class="text-xl font-bold mb-2">{{ $banner->title }}</h3>
                            @endif
                            @if ($banner->description)
                                <p>{{ $banner->description }}</p>
                            @endif
                        </div>
                    @endif
                    --}}
                </a>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>
</div>

@push('scripts')
    <script>
        const swiper = new Swiper('.banner-swiper', {
            loop: true,
            autoplay: {
                delay: 10000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
@endpush
