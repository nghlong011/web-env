<div class="container-fluid bg-white">
    <div class="container mx-auto px-4 py-6 md:py-8 lg:py-12 xl:py-14 xl:px-20 2xl:py-24 2xl:px-24">
        <div class="flex items-center mb-8 transition-all duration-2000 ease-out transform translate-y-10 opacity-0 invisible"
            id="customer-title">
            <div class="w-1 h-15 bg-[#45B649] mr-3"></div>
            <h2
                class="text-[20px] xl:text-[30px] 2xl:text-[35px] font-semibold uppercase">
                {{ __('home.partners.title') }}
            </h2>
        </div>

        <!-- Swiper -->
        <div class="swiper logo-swiper overflow-hidden cursor-grab transition-all duration-2000 ease-out transform translate-y-10 opacity-0 invisible"
            id="customer-swiper">
            <div class="swiper-wrapper logo-slide-track">
                @foreach($partners as $partner)
                    <div class="swiper-slide">
                        <div class="bg-[#F5F5F5] p-6 flex items-center justify-center h-full">
                            <img src="{{ asset($partner->logo) }}" alt="{{ $partner->translation()?->name ?? 'Partner' }}"
                                class="w-[100px] h-auto max-w-[200px]">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const logoSwiper = new Swiper('.logo-swiper', {
            slidesPerView: 4,
            loop: true,
            spaceBetween: 30,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                0: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            }
        });

        // Scroll animation for partners section
        const customerTitle = document.getElementById('customer-title');
        const customerSwiper = document.getElementById('customer-swiper');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('translate-y-10', 'opacity-0', 'invisible');
                    entry.target.classList.add('translate-y-0', 'opacity-100', 'visible');
                }
            });
        }, {
            threshold: 0.1
        });

        observer.observe(customerTitle);
        observer.observe(customerSwiper);
    </script>
@endpush 