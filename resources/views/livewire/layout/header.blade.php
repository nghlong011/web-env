<header class="bg-white shadow-md relative">
    <div class="h-[5px] bg-black"></div>
    <div class="container mx-auto px-4 xl:px-20 2xl:px-24">
        <div class="flex justify-between h-22 relative">
            <div
                class="absolute w-[60%] hidden md:block top-0 right-0 xl:w-[60%] 2xl:w-[45%] h-7 bg-black transform overflow-hidden">
                <div
                    class="absolute w-[10%] top-0 left-[-10%] lg:w-[35%] h-full bg-white transform skew-x-40 origin-top-left">
                </div>
            </div>
            <div class="flex flex-shrink-0 items-center">
                <a href="/" class="flex items-center">
                    @if($logo && $logo->image_path)
                        <img src="{{ asset($logo->image_path) }}" alt="Logo" class="h-19 w-auto">
                    @else
                        <img src="{{ asset('images/svg/logo.svg') }}" alt="Logo" class="h-19 w-auto">
                    @endif
                </a>
            </div>
            <div class="z-10 hidden md:block">
                <div class="top-contact h-7 mb-[25px] pr-2 lg:pr-3">
                    <div class="flex items-center justify-end space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="rounded-full w-[15px] h-[15px] flex items-center justify-center">
                                <img src="{{ asset('images/svg/email.svg') }}" alt="mail" class="w-full h-full">
                            </div>
                            <span class="text-[10px] text-white">
                                @if($email)
                                    @php
                                        $emailTranslation = $email->translation(app()->getLocale()) ?? $email->translation('vi');
                                    @endphp
                                    {{ $emailTranslation ? $emailTranslation->description : 'info@duanvesinhmoitruong.com' }}
                                @else
                                    info@duanvesinhmoitruong.com
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="rounded-full w-[15px] h-[15px] flex items-center justify-center">
                                <img src="{{ asset('images/svg/phone.svg') }}" alt="phone" class="w-full h-full">
                            </div>
                            <span class="text-[10px] text-white">
                                @if($phone)
                                    @php
                                        $phoneTranslation = $phone->translation(app()->getLocale()) ?? $phone->translation('vi');
                                    @endphp
                                    {{ $phoneTranslation ? $phoneTranslation->description : '0909 999 999' }}
                                @else
                                    0909 999 999
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($facebook)
                                <a href="{{ optional($facebook->translation(app()->getLocale()))->description ?? '#' }}">
                                    <img src="{{ asset('images/svg/facebook.svg') }}" alt="facebook" class="w-full h-full">
                                </a>
                            @else
                                <a href="#">
                                    <img src="{{ asset('images/svg/facebook.svg') }}" alt="facebook" class="w-full h-full">
                                </a>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($youtube)
                                <a href="{{ optional($youtube->translation(app()->getLocale()))->description ?? '#' }}">
                                    <img src="{{ asset('images/svg/youtube.svg') }}" alt="youtube" class="w-full h-full">
                                </a>
                            @else
                                <a href="#">
                                    <img src="{{ asset('images/svg/youtube.svg') }}" alt="youtube" class="w-full h-full">
                                </a>
                            @endif
                        </div>
                        <!-- Language Selector -->
                        <div class="relative group">
                            <button class="flex items-center space-x-1">
                                <img src="{{ asset('images/flags/' . app()->getLocale() . '.png') }}"
                                    alt="{{ app()->getLocale() }}" class="w-5 h-5">
                                <img src="{{ asset('images/svg/arrow-down.svg') }}" alt="en" class="w-2 h-2">
                            </button>
                            <div
                                class="absolute right-0 w-10 bg-white shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out z-10000">
                                <div>
                                    <a href="{{ route('language.switch', 'vi') }}"
                                        class="flex items-center justify-center space-x-2 px-2 py-2 text-xs text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">
                                        <img src="{{ asset('images/flags/vi.png') }}" alt="vi" class="w-5 h-5">
                                    </a>
                                    <a href="{{ route('language.switch', 'en') }}"
                                        class="flex items-center justify-center space-x-2 px-2 py-2 text-xs text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">
                                        <img src="{{ asset('images/flags/en.png') }}" alt="en" class="w-5 h-5">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <livewire:components.menu />
            </div>
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center justify-center">
                <button type="button" wire:click="toggleMobileMenu" class="text-gray-700 hover:text-gray-900">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    @if($isMobileMenuOpen)
    <div class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" wire:click="closeMobileMenu"></div>
    @endif

    <!-- Mobile Menu -->
    <div class="md:hidden">
        <div class="fixed top-0 right-0 h-full w-80 bg-white shadow-lg transform transition-transform duration-300 ease-in-out z-50 {{ $isMobileMenuOpen ? 'translate-x-0' : 'translate-x-full' }}">
            <div class="flex flex-col h-full">
                <!-- Mobile Header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <div class="flex items-center">
                        <img src="{{ asset('images/svg/logo.svg') }}" alt="Logo" class="h-8 w-auto">
                    </div>
                    <button wire:click="closeMobileMenu" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile Contact Info -->
                <div class="p-4 bg-gray-50 border-b">
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('images/svg/email.svg') }}" alt="mail" class="w-4 h-4">
                            <span class="text-xs text-gray-600">info@duanvesinhmoitruong.com</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('images/svg/phone.svg') }}" alt="phone" class="w-4 h-4">
                            <span class="text-xs text-gray-600">0909 999 999</span>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Items -->
                <div class="flex-1 overflow-y-auto">
                    <livewire:components.menu :isMobile="true" />
                </div>

                <!-- Mobile Footer -->
                <div class="p-4 border-t">
                    <div class="flex items-center justify-center space-x-4">
                        @if($facebook)
                            <a href="{{ optional($facebook->translation(app()->getLocale()))->description ?? '#' }}" class="text-gray-500 hover:text-[#46af08]">
                                <img src="{{ asset('images/svg/facebook.svg') }}" alt="facebook" class="w-6 h-6">
                            </a>
                        @else
                            <a href="#" class="text-gray-500 hover:text-[#46af08]">
                                <img src="{{ asset('images/svg/facebook.svg') }}" alt="facebook" class="w-6 h-6">
                            </a>
                        @endif
                        @if($youtube)
                            <a href="{{ optional($youtube->translation(app()->getLocale()))->description ?? '#' }}" class="text-gray-500 hover:text-[#46af08]">
                                <img src="{{ asset('images/svg/youtube.svg') }}" alt="youtube" class="w-6 h-6">
                            </a>
                        @else
                            <a href="#" class="text-gray-500 hover:text-[#46af08]">
                                <img src="{{ asset('images/svg/youtube.svg') }}" alt="youtube" class="w-6 h-6">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
