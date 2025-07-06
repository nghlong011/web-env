<div class="container-fluid bg-[#F4F8F6]">
    <livewire:components.banner />
    <div class="h-[5px] bg-[#46af08]"></div>

    <!-- Section: Giới thiệu Ban Quản Lý Dự Án -->
    <div id="ban-quan-ly" class="container-fluid bg-[#EBF1F1] overflow-hidden">
        <div class="container mx-auto px-4 py-6 md:py-8 lg:py-12 xl:py-25 xl:px-20 2xl:py-30 2xl:px-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-10 2xl:gap-12 items-center justify-between">
                <div class="text-center lg:text-left lg:col-span-1 transition-all duration-2000 ease-out transform -translate-x-1/2 opacity-0 invisible pb-5 lg:pb-0"
                    id="intro-text">
                    <h1 class="text-[20px] xl:text-[30px] 2xl:text-[35px] font-semibold mb-2 md:mb-2 2xl:mb-6 uppercase">
                        {{ $about_us?->translation(app()->getLocale())?->name }}
                    </h1>
                    <div class="text-gray-600 w-full text-justify text-xs md:text-sm 2xl:text-base">
                        {!! $about_us?->translation(app()->getLocale())?->description !!}
                    </div>
                </div>

                <div class="flex justify-end relative mt-6 md:mt-0 xl:w-auto lg:col-span-1 transition-all duration-2000 ease-out transform translate-x-1/2 opacity-0 invisible"
                    id="intro-image">
                    <img src="{{ asset('storage/images/hand-earth.png') }}" alt="hand-earth"
                        class="w-full h-auto rounded-tl-[100px] rounded-br-[100px] 
                               md:rounded-tl-[100px] md:rounded-br-[100px] 
                               xl:rounded-tl-[200px] xl:rounded-br-[200px]">
                </div>
            </div>
        </div>
    </div>
    <div id="du-an-vsmt" class="container-fluid bg-white overflow-hidden">
        <div class="container mx-auto px-4 py-6 md:py-8 lg:py-12 xl:py-25 xl:px-20 2xl:py-30 2xl:px-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:gap-10 2xl:gap-12 items-center justify-between">
                <div class="text-center lg:order-2 lg:text-left lg:col-span-1" id="intro-text-2">
                    <h1
                        class="text-[20px] lg:text-[25px] xl:text-[30px] 2xl:text-[35px] font-semibold mb-2 md:mb-2 2xl:mb-6 uppercase">
                        {{ $project?->translation(app()->getLocale())?->name }}
                    </h1>
                    <div class="text-gray-600 w-full text-justify text-xs md:text-sm 2xl:text-base">
                        {!! $project?->translation(app()->getLocale())?->description !!}
                    </div>
                </div>
                <div class="flex justify-end relative mt-6 md:mt-0 xl:w-auto lg:col-span-1" id="intro-image-2">
                    <img src="{{ asset('images/about-img.svg') }}" alt="hand-earth" class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-[#EBF1F1] overflow-hidden">
        <div class="container mx-auto px-4 py-6 md:py-8 lg:py-12 xl:py-25 xl:px-20 2xl:py-30 2xl:px-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:gap-10 2xl:gap-12 items-center justify-between">
                <div class="text-center lg:text-left lg:col-span-1" id="intro-text-3">
                    <h1
                        class="text-[20px] lg:text-[25px] xl:text-[30px] 2xl:text-[35px] font-semibold mb-2 md:mb-2 2xl:mb-6 uppercase">
                        {{ $meaning?->translation(app()->getLocale())?->name }}
                    </h1>
                    <div class="text-gray-600 w-full text-justify text-xs md:text-sm 2xl:text-base">
                        {!! $meaning?->translation(app()->getLocale())?->description !!}
                    </div>
                </div>
                <div class="flex justify-end relative mt-6 md:mt-0 xl:w-auto lg:col-span-1" id="intro-image-3">
                    <img src="{{ asset('images/about-img-1.svg') }}" alt="hand-earth" class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Các đơn vị - các phương dự án -->
    <livewire:components.partners />

</div>
@push('scripts')
    <script>
        // Scroll animation for introduction section
        const introText = document.getElementById('intro-text');
        const introImage = document.getElementById('intro-image');
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
    </script>
@endpush
