<div>
    <livewire:components.banner />
    <div class="h-[5px] bg-[#46af08]"></div>
    <!-- Content sections -->
    <div class="container-fluid bg-[#EBF1F1] overflow-hidden">
        <div class="container mx-auto px-4 py-6 md:py-8 lg:py-12 xl:py-25 xl:px-20 2xl:py-30 2xl:px-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-10 2xl:gap-12 items-center justify-between">
                <div class="text-center lg:text-left lg:col-span-1 transition-all duration-2000 ease-out transform -translate-x-1/2 opacity-0 invisible pb-5 lg:pb-0"
                    id="intro-text">
                    <h1 class="text-[20px] xl:text-[30px] 2xl:text-[35px] font-semibold mb-2 md:mb-2 2xl:mb-6 uppercase">
                        {{ __('home.intro.title') }}
                    </h1>
                    <div class="text-gray-600 w-full text-justify text-xs md:text-sm 2xl:text-base">
                        {!! $about?->translation(app()->getLocale())?->description !!}
                    </div>
                    <a href="{{ route('about') }}">
                        <button
                            class="border-2 border-[#45B649] bg-transparent hover:bg-[#45B649] text-black hover:text-white px-6 md:px-10 2xl:px-12 py-1.5 md:py-2 2xl:py-2.5 rounded-full text-xs md:text-[13px] 2xl:text-sm mt-6 2xl:mt-6 cursor-pointer">
                            {{ __('home.intro.button') }}
                        </button>
                    </a>
                </div>

                <div class="flex justify-end relative mt-6 md:mt-0 xl:w-auto xl:pl-7 lg:col-span-1 transition-all duration-2000 ease-out transform translate-x-1/2 opacity-0 invisible"
                    id="intro-image">
                    <img src="{{ asset($about?->image_path) }}" alt="hand-earth"
                        class="w-full h-auto rounded-tl-[100px] rounded-br-[100px] 
                               md:rounded-tl-[100px] md:rounded-br-[100px] 
                               xl:rounded-tl-[200px] xl:rounded-br-[200px]">
                </div>
            </div>
        </div>
    </div>

    <!-- News Section -->
    <div class="container-fluid bg-white">
        <div class="container mx-auto px-4 py-6 md:py-8 lg:py-12 xl:py-14 xl:px-20 2xl:py-16 2xl:px-24">
            {{-- News Title --}}
            <div class="relative z-10 flex flex-row justify-between items-center mb-[58px] transition-all duration-2000 ease-out transform translate-y-10 opacity-0 invisible"
                id="news-header">
                <div class="flex items-center">
                    <div class="w-1 h-15 bg-[#45B649] mr-[10px]"></div>
                    <h2 class="text-[20px] xl:text-[30px] 2xl:text-[35px] font-semibold uppercase">
                        {{ __('home.news.title') }}
                    </h2>
                </div>
                {{-- Categories for Desktop --}}
                <div class="hidden md:flex gap-2 md:gap-6 xl:gap-10 justify-between">
                    <a href="{{ route('news', ['tab' => 'environment']) }}"
                        class="hover:text-green-600 text-xs md:text-sm xl:text-base font-bold"><span
                            class="">{{ __('home.news.categories.environment') }}</span></a>
                    <a href="{{ route('news', ['tab' => 'project']) }}"
                        class="hover:text-green-600 text-xs md:text-sm xl:text-base font-bold"><span
                            class="">{{ __('home.news.categories.project') }}</span></a>
                    <a href="{{ route('news', ['tab' => 'regulation']) }}"
                        class="hover:text-green-600 text-xs md:text-sm xl:text-base font-bold"><span
                            class="">{{ __('home.news.categories.regulation') }}</span></a>
                    <a href="{{ route('news', ['tab' => 'other']) }}"
                        class="hover:text-green-600 text-xs md:text-sm xl:text-base font-bold"><span
                            class="">{{ __('home.news.categories.other') }}</span></a>
                </div>
                {{-- Categories for Mobile (Dropdown) --}}
                <div x-data="{ open: false, selected: '{{ __('home.news.categories.environment') }}' }" class="relative md:hidden z-20">
                    <button @click="open = !open"
                        class="flex items-center px-5 py-1.5 text-xs font-medium text-left text-gray-700 bg-white rounded-md hover:bg-gray-50 focus:outline-none">
                        <span x-text="selected" class="truncate"></span>
                        <svg class="w-4 h-4 ml-1 -mr-1 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 w-full mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-30">
                        <div class="py-1">
                            <a href="{{ route('news', ['tab' => 'environment']) }}"
                                @click="selected = '{{ __('home.news.categories.environment') }}'; open = false"
                                class="block py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-900">{{ __('home.news.categories.environment') }}</a>
                            <a href="{{ route('news', ['tab' => 'project']) }}"
                                @click="selected = '{{ __('home.news.categories.project') }}'; open = false"
                                class="block py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-900">{{ __('home.news.categories.project') }}</a>
                            <a href="{{ route('news', ['tab' => 'regulation']) }}"
                                @click="selected = '{{ __('home.news.categories.regulation') }}'; open = false"
                                class="block py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-900">{{ __('home.news.categories.regulation') }}</a>
                            <a href="{{ route('news', ['tab' => 'other']) }}"
                                @click="selected = '{{ __('home.news.categories.other') }}'; open = false"
                                class="block py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-900">{{ __('home.news.categories.other') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 2xl:gap-12 transition-all duration-2000 ease-out transform translate-y-10 opacity-0 invisible"
                id="main-news">
                <!-- Main News -->
                @if($mainNews)
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden">
                        <img src="{{ asset( $mainNews->image) }}" alt="{{ $mainNews->translation(app()->getLocale())->title ?? 'Main news' }}"
                            class="w-full h-auto aspect-[1.66] object-cover">
                        <div class="pt-8 ">
                            <h3 class="text-xl font-semibold h-6 mb-[5px] uppercase">{{ $mainNews->translation(app()->getLocale())->title ?? 'News Title' }}</h3>
                            <p class="text-[#7F7F7F] text-xs mb-3">
                                @if($mainNews->date)
                                    Ngày {{ $mainNews->date->format('j') }} tháng {{ $mainNews->date->format('n') }} năm {{ $mainNews->date->format('Y') }}
                                @else
                                    N/A
                                @endif
                            </p>
                            <p class="text-gray-600 text-sm">{{ Str::limit($mainNews->translation(app()->getLocale())->description ?? '', 200) }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- News List -->
                <div class="lg:col-span-1">
                    <div class="space-y-[30px] xl:pl-7">
                        @forelse($subNews as $news)
                        <div class="bg-white overflow-hidden flex gap-[25px]">
                            <img src="{{ asset($news->image) }}" alt="{{ $news->translation(app()->getLocale())->title ?? 'News thumbnail' }}"
                                class="w-24 h-24 xl:w-28 xl:h-28 2xl:w-32 2xl:h-32 object-cover flex-shrink-0">
                            <div class="">
                                <h4
                                    class="font-bold text-sm xl:text-base 2xl:text-xl mb-2 line-clamp-2 text-ellipsis uppercase">
                                    {{ $news->translation(app()->getLocale())->title ?? 'News Title' }}</h4>
                                <p class="text-xs xl:text-sm 2xl:text-base line-clamp-3 text-ellipsis">
                                    {{ Str::limit($news->translation(app()->getLocale())->description ?? '', 150) }}</p>
                            </div>
                        </div>
                        @empty
                        <!-- Fallback khi không có tin tức -->
                        @for ($i = 0; $i < 4; $i++)
                            <div class="bg-white overflow-hidden flex gap-[25px]">
                                <img src="{{ asset('storage/images/post2.png') }}" alt="News thumbnail"
                                    class="w-24 h-24 xl:w-28 xl:h-28 2xl:w-32 2xl:h-32 object-cover flex-shrink-0">
                                <div class="">
                                    <h4
                                        class="font-bold text-sm xl:text-base 2xl:text-xl mb-2 line-clamp-2 text-ellipsis">
                                        {{ __('home.news.sub_news.title') }}</h4>
                                    <p class="text-xs xl:text-sm 2xl:text-base line-clamp-3 text-ellipsis">
                                        {{ __('home.news.sub_news.content') }}</p>
                                </div>
                            </div>
                        @endfor
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="text-center mt-6 md:mt-8 lg:mt-12 xl:mt-14 2xl:mt-16">
                <a href="{{ route('news') }}">
                    <button
                        class="px-12 py-[8px] rounded-full border-2 border-[#45B649] bg-white hover:bg-[#45B649] text-black hover:text-white text-[13px] transition-all duration-300 text-base font-medium cursor-pointer">
                        {{ __('home.news.button') }}
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- Library Section -->
    <div class="container-fluid bg-[#EBF1F1]">
        <div class="container mx-auto px-4 py-6 md:py-8 lg:py-12 xl:py-14 xl:px-20 2xl:py-16 2xl:px-24">
            <div class="flex items-center mb-8 transition-all duration-2000 ease-out transform translate-y-10 opacity-0 invisible"
                id="news-title">
                <div class="w-1 h-15 bg-[#45B649] mr-3"></div>
                <h2 class="text-[20px] xl:text-[30px] 2xl:text-[35px] font-semibold uppercase">
                    {{ __('home.library.title') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 transition-all duration-2000 ease-out transform translate-y-10 opacity-0 invisible"
                id="library-cards">
                <!-- Image Library Card -->
                <div class="bg-white rounded-lg overflow-hidden group cursor-pointer">
                    <a href="{{ route('gallery', ['tab' => 'hinhanh']) }}">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset($library_images?->image_path) }}" alt="Thư viện hình ảnh"
                                class="w-full h-auto lg:h-[250px] object-cover transition-transform duration-500 group-hover:scale-120">
                        </div>
                        <div class="p-4 text-center group-hover:bg-[#45B649] transition-all duration-500">
                            <h3
                                class="text-[#45B649] text-lg font-medium group-hover:text-white transition-all duration-500">
                                {{ $library_images?->translation(app()->getLocale())?->name }}</h3>
                        </div>
                    </a>
                </div>

                <!-- Video Library Card -->
                <div class="bg-white rounded-lg overflow-hidden group cursor-pointer">
                    <a href="{{ route('gallery', ['tab' => 'video']) }}">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset($library_videos?->image_path) }}" alt="Thư viện video"
                                class="w-full h-auto lg:h-[250px] object-cover transition-transform duration-500 group-hover:scale-120">
                        </div>
                        <div class="p-4 text-center group-hover:bg-[#45B649] transition-all duration-500">
                            <h3
                                class="text-[#45B649] text-lg font-medium group-hover:text-white transition-all duration-500">
                                {{ $library_videos?->translation(app()->getLocale())?->name }}</h3>
                        </div>
                    </a>
                </div>

                <!-- Document Library Card -->
                <div class="bg-white rounded-lg overflow-hidden group cursor-pointer">
                    <a href="{{ route('gallery', ['tab' => 'tulieu']) }}">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset($library_documents?->image_path) }}" alt="Tài liệu"
                                class="w-full h-auto lg:h-[250px] object-cover transition-transform duration-500 group-hover:scale-120">
                        </div>
                        <div class="p-4 text-center group-hover:bg-[#45B649] transition-all duration-500">
                            <h3
                                class="text-[#45B649] text-lg font-medium group-hover:text-white transition-all duration-500">
                                {{ $library_documents?->translation(app()->getLocale())?->name }}</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Partners Section -->
    <livewire:components.partners />
</div>

@push('scripts')
    <script>
        // Scroll animation for introduction section
        const introText = document.getElementById('intro-text');
        const introImage = document.getElementById('intro-image');
        const newsHeader = document.getElementById('news-header');
        const newsTitle = document.getElementById('news-title');
        const mainNews = document.getElementById('main-news');
        const libraryCards = document.getElementById('library-cards');
        const observers = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('-translate-x-1/2', 'translate-x-1/2', 'translate-y-10',
                        'opacity-0', 'invisible');
                    entry.target.classList.add('translate-x-0', 'translate-y-0', 'opacity-100', 'visible');
                }
            });
        }, {
            threshold: 0.1
        });

        observers.observe(introText);
        observers.observe(introImage);
        observers.observe(newsHeader);
        observers.observe(newsTitle);
        observers.observe(mainNews);
        observers.observe(libraryCards);
    </script>
@endpush
