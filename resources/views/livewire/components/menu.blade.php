@props(['active' => false, 'isMobile' => false])

<div class="w-full relative z-[9999]">
    <!-- Desktop Menu -->
    <nav class="hidden md:flex space-x-3 lg:space-x-4 xl:space-x-6 2xl:space-x-8 justify-end mt-2">
        <a href="/"
            class="text-[13px] lg:text-sm 2xl:text-base text-gray-700 hover:text-[#46af08] {{ request()->is('/') ? 'text-[#46af08]' : '' }} whitespace-nowrap">{{ __('common.menu.home') }}</a>

        <div class="relative group">
            <a href="/about"
                class="text-[13px] lg:text-sm 2xl:text-base text-gray-700 hover:text-[#46af08] group-hover:text-[#46af08] flex items-center space-x-1 {{ request()->is('about*') ? 'text-[#46af08]' : '' }} whitespace-nowrap">
                <span>{{ __('common.menu.about') }}</span>
                <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
            <div
                class="absolute left-0 top-full mt-2 w-fit bg-white shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out z-[9999]">
                <div class="relative">
                    <a href="/about#ban-quan-ly"
                        class="block px-4 py-2 text-xs 2xl:text-sm text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">{{ __('common.menu.submenu.about.management') }}</a>
                    <a href="/about#du-an-vsmt"
                        class="block px-4 py-2 text-xs 2xl:text-sm text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">{{ __('common.menu.submenu.about.project') }}</a>
                </div>
            </div>
        </div>

        <div class="relative group">
            <a href="{{ route('news') }}"
                class="text-[13px] lg:text-sm 2xl:text-base text-gray-700 hover:text-[#46af08] group-hover:text-[#46af08] flex items-center space-x-1 {{ request()->is('news*') ? 'text-[#46af08]' : '' }} whitespace-nowrap">
                <span>{{ __('common.menu.news') }}</span>
                <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
            <div
                class="absolute left-0 top-full mt-2 w-fit bg-white shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out z-[9999]">
                <div class="relative">
                    <a href="{{ route('news', ['tab' => 'environment']) }}"
                        class="block px-4 py-2 text-xs 2xl:text-sm text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">{{ __('common.menu.submenu.news.environment') }}</a>
                    <a href="{{ route('news', ['tab' => 'project']) }}"
                        class="block px-4 py-2 text-xs 2xl:text-sm text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">{{ __('common.menu.submenu.news.project') }}</a>
                    <a href="{{ route('news', ['tab' => 'regulation']) }}"
                        class="block px-4 py-2 text-xs 2xl:text-sm text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">{{ __('common.menu.submenu.news.regulation') }}</a>
                    <a href="{{ route('news', ['tab' => 'other']) }}"
                        class="block px-4 py-2 text-xs 2xl:text-sm text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">{{ __('common.menu.submenu.news.other') }}</a>
                </div>
            </div>
        </div>

        <div class="relative group">
            <a href="{{ route('gallery') }}"
                class="text-[13px] lg:text-sm 2xl:text-base text-gray-700 hover:text-[#46af08] group-hover:text-[#46af08] flex items-center space-x-1 {{ request()->is('library*') ? 'text-[#46af08]' : '' }} whitespace-nowrap">
                <span>{{ __('common.menu.library') }}</span>
                <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
            <div
                class="absolute left-0 top-full mt-2 w-fit bg-white shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out z-[9999]">
                <div class="relative">
                    <a href="{{ route('gallery', ['tab' => 'hinhanh']) }}"
                        class="block px-4 py-2 text-xs 2xl:text-sm text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">{{ __('common.menu.submenu.library.images') }}</a>
                    <a href="{{ route('gallery', ['tab' => 'video']) }}"
                        class="block px-4 py-2 text-xs 2xl:text-sm text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">{{ __('common.menu.submenu.library.videos') }}</a>
                    <a href="{{ route('gallery', ['tab' => 'tulieu']) }}"
                        class="block px-4 py-2 text-xs 2xl:text-sm text-gray-700 hover:bg-[#46af08] hover:text-white whitespace-nowrap">{{ __('common.menu.submenu.library.documents') }}</a>
                </div>
            </div>
        </div>

        <a href="/contact"
            class="text-[13px] lg:text-sm 2xl:text-base text-gray-700 hover:text-[#46af08] {{ request()->is('contact') ? 'text-[#46af08]' : '' }} whitespace-nowrap">{{ __('common.menu.contact') }}</a>

        <div class="relative inline-block">
            <button
                wire:click="toggleSearchBox"
                class="text-[13px] lg:text-sm 2xl:text-base text-gray-700 hover:text-[#46af08] flex items-center cursor-pointer pr-4 lg:pr-5 focus:outline-none">
                <img src="{{ asset('images/svg/search.svg') }}" alt="search" class="w-5 h-5">
            </button>
            @if($showSearchBox)
                <div class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded shadow-lg z-50 p-2">
                    <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-[#46af08]" placeholder="{{ __('common.search') }}">
                </div>
            @endif
        </div>
    </nav>

    <!-- Mobile Menu -->
    @if($isMobile)
    <div class="md:hidden">
        <div class="space-y-0">
            <!-- Home -->
            <a href="/" wire:click="closeAllSubmenus"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-[#46af08] hover:text-white border-b border-gray-100 {{ request()->is('/') ? 'bg-[#46af08] text-white' : '' }}">
                <span class="text-sm font-medium">{{ __('common.menu.home') }}</span>
            </a>

            <!-- About -->
            <div class="border-b border-gray-100">
                <button wire:click="toggleSubmenu('about')"
                    class="flex items-center justify-between w-full px-4 py-3 text-left text-gray-700 hover:bg-[#46af08] hover:text-white {{ request()->is('about*') ? 'bg-[#46af08] text-white' : '' }}">
                    <span class="text-sm font-medium">{{ __('common.menu.about') }}</span>
                    <svg class="w-4 h-4 transition-transform duration-200 {{ $openSubmenu === 'about' ? 'rotate-180' : '' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="overflow-hidden transition-all duration-300 bg-gray-50"
                     style="max-height: {{ $openSubmenu === 'about' ? '500px' : '0' }};">
                    <a href="/about#ban-quan-ly" wire:click="closeAllSubmenus"
                        class="block px-8 py-2 text-sm text-gray-600 hover:bg-[#46af08] hover:text-white">
                        {{ __('common.menu.submenu.about.management') }}
                    </a>
                    <a href="/about#du-an-vsmt" wire:click="closeAllSubmenus"
                        class="block px-8 py-2 text-sm text-gray-600 hover:bg-[#46af08] hover:text-white">
                        {{ __('common.menu.submenu.about.project') }}
                    </a>
                </div>
            </div>

            <!-- News -->
            <div class="border-b border-gray-100">
                <button wire:click="toggleSubmenu('news')"
                    class="flex items-center justify-between w-full px-4 py-3 text-left text-gray-700 hover:bg-[#46af08] hover:text-white {{ request()->is('news*') ? 'bg-[#46af08] text-white' : '' }}">
                    <span class="text-sm font-medium">{{ __('common.menu.news') }}</span>
                    <svg class="w-4 h-4 transition-transform duration-200 {{ $openSubmenu === 'news' ? 'rotate-180' : '' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="overflow-hidden transition-all duration-300 bg-gray-50"
                     style="max-height: {{ $openSubmenu === 'news' ? '600px' : '0' }};">
                    <a href="{{ route('news', ['tab' => 'environment']) }}" wire:click="closeAllSubmenus"
                        class="block px-8 py-2 text-sm text-gray-600 hover:bg-[#46af08] hover:text-white">
                        {{ __('common.menu.submenu.news.environment') }}
                    </a>
                    <a href="{{ route('news', ['tab' => 'project']) }}" wire:click="closeAllSubmenus"
                        class="block px-8 py-2 text-sm text-gray-600 hover:bg-[#46af08] hover:text-white">
                        {{ __('common.menu.submenu.news.project') }}
                    </a>
                    <a href="{{ route('news', ['tab' => 'regulation']) }}" wire:click="closeAllSubmenus"
                        class="block px-8 py-2 text-sm text-gray-600 hover:bg-[#46af08] hover:text-white">
                        {{ __('common.menu.submenu.news.regulation') }}
                    </a>
                    <a href="{{ route('news', ['tab' => 'other']) }}" wire:click="closeAllSubmenus"
                        class="block px-8 py-2 text-sm text-gray-600 hover:bg-[#46af08] hover:text-white">
                        {{ __('common.menu.submenu.news.other') }}
                    </a>
                </div>
            </div>

            <!-- Library -->
            <div class="border-b border-gray-100">
                <button wire:click="toggleSubmenu('library')"
                    class="flex items-center justify-between w-full px-4 py-3 text-left text-gray-700 hover:bg-[#46af08] hover:text-white {{ request()->is('library*') ? 'bg-[#46af08] text-white' : '' }}">
                    <span class="text-sm font-medium">{{ __('common.menu.library') }}</span>
                    <svg class="w-4 h-4 transition-transform duration-200 {{ $openSubmenu === 'library' ? 'rotate-180' : '' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="overflow-hidden transition-all duration-300 bg-gray-50"
                     style="max-height: {{ $openSubmenu === 'library' ? '500px' : '0' }};">
                    <a href="{{ route('gallery', ['tab' => 'hinhanh']) }}" wire:click="closeAllSubmenus"
                        class="block px-8 py-2 text-sm text-gray-600 hover:bg-[#46af08] hover:text-white">
                        {{ __('common.menu.submenu.library.images') }}
                    </a>
                    <a href="{{ route('gallery', ['tab' => 'video']) }}" wire:click="closeAllSubmenus"
                        class="block px-8 py-2 text-sm text-gray-600 hover:bg-[#46af08] hover:text-white">
                        {{ __('common.menu.submenu.library.videos') }}
                    </a>
                    <a href="{{ route('gallery', ['tab' => 'tulieu']) }}" wire:click="closeAllSubmenus"
                        class="block px-8 py-2 text-sm text-gray-600 hover:bg-[#46af08] hover:text-white">
                        {{ __('common.menu.submenu.library.documents') }}
                    </a>
                </div>
            </div>

            <!-- Contact -->
            <a href="/contact" wire:click="closeAllSubmenus"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-[#46af08] hover:text-white border-b border-gray-100 {{ request()->is('contact') ? 'bg-[#46af08] text-white' : '' }}">
                <span class="text-sm font-medium">{{ __('common.menu.contact') }}</span>
            </a>

            <!-- Search -->
            <div class="px-4 py-3 border-b border-gray-100">
                <button class="flex items-center space-x-2 text-gray-700 hover:text-[#46af08]">
                    <img src="{{ asset('images/svg/search.svg') }}" alt="search" class="w-5 h-5">
                    <input type="text" placeholder="{{ __('common.search') }}" class="w-full">
                </button>
            </div>

            <!-- Language Selector -->
            <div class="px-4 py-3">
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-700">{{ __('common.language') }}:</span>
                    <div class="flex space-x-2">
                        <a href="{{ route('language.switch', 'vi') }}" 
                           class="flex items-center space-x-1 px-2 py-1 rounded {{ app()->getLocale() === 'vi' ? 'bg-[#46af08] text-white' : 'bg-gray-200 text-gray-700' }}">
                            <img src="{{ asset('images/flags/vi.png') }}" alt="vi" class="w-4 h-4">
                            <span class="text-xs">VI</span>
                        </a>
                        <a href="{{ route('language.switch', 'en') }}" 
                           class="flex items-center space-x-1 px-2 py-1 rounded {{ app()->getLocale() === 'en' ? 'bg-[#46af08] text-white' : 'bg-gray-200 text-gray-700' }}">
                            <img src="{{ asset('images/flags/en.png') }}" alt="en" class="w-4 h-4">
                            <span class="text-xs">EN</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
