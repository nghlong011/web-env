<footer class="bg-[#1E1E1E] text-white">
    <div class="container mx-auto px-4 py-10 xl:px-20 lg:py-20 2xl:px-24 2xl:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Column 1 - Logo & Copyright -->
            <div class="flex flex-col justify-between h-full order-4 lg:order-0">
                <div class="flex-grow grid grid-rows-4 gap-2">
                    <div class="row-span-3 flex items-center justify-center lg:justify-start">
                        @if($logo && $logo->image_path)
                            <img src="{{ asset($logo->image_path) }}" alt="Logo" class="w-[120px] h-auto">
                        @else
                            <img src="{{ asset('images/svg/logo.svg') }}" alt="Logo" class="w-[120px] h-auto">
                        @endif
                    </div>
                    <div class="row-span-1">
                        @if($copyright)
                            @php
                                $copyrightTranslation = $copyright->translation(app()->getLocale()) ?? $copyright->translation('vi');
                            @endphp
                            @if($copyrightTranslation)
                                {!! $copyrightTranslation->description !!}
                            @else
                                <p class="text-sm text-gray-400 text-center lg:text-left">
                                    Copyright © 2023 Imct Company<br>
                                    All Rights Reserved.
                                </p>
                            @endif
                        @else
                            <p class="text-sm text-gray-400 text-center lg:text-left">
                                Copyright © 2023 Imct Company<br>
                                All Rights Reserved.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Column 2 - Quick Links -->
            <div class="flex flex-col h-full ">
                <div
                    class="grid grid-cols-4 lg:grid-cols-1 lg:grid-rows-4 gap-2 lg:gap-0 h-full justify-center content-center lg:justify-start lg:content-start">
                    <div class="flex items-center justify-center lg:justify-start">
                        <a href="{{ route('about') }}" class="hover:text-white transition duration-300">{{ __('common.about') }}</a>
                    </div>
                    <div class="flex items-center justify-center lg:justify-start">
                        <a href="{{ route('news') }}" class="hover:text-white transition duration-300">{{ __('common.news') }}</a>
                    </div>
                    <div class="flex items-center justify-center lg:justify-start">
                        <a href="{{ route('gallery') }}" class="hover:text-white transition duration-300">{{ __('common.gallery') }}</a>
                    </div>
                    <div class="flex items-center justify-center lg:justify-start">
                        <a href="{{ route('contact') }}" class="hover:text-white transition duration-300">{{ __('common.contact') }}</a>
                    </div>
                </div>
            </div>

            <!-- Column 3 - Contact Info -->
            <div class="flex flex-col h-full">
                <div class="grid grid-rows-4 h-full gap-2">
                    <div class="flex items-center justify-center lg:justify-start">
                        <a href="#" class="hover:text-white transition duration-300">{{ __('common.contact') }}</a>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 flex items-center justify-center">
                            @if($address && $address->image_path)
                                <img src="{{ asset($address->image_path) }}" alt="location" class="w-5 h-5">
                            @else
                                <img src="{{ asset('images/svg/location.svg') }}" alt="location" class="w-5 h-5">
                            @endif
                        </div>
                        <span class="text-gray-400 text-xs">
                            @if($address)
                                @php
                                    $addressTranslation = $address->translation(app()->getLocale()) ?? $address->translation('vi');
                                @endphp
                                {!! $addressTranslation ? $addressTranslation->description : 'abcxyzzzzzzzzzzzzzzzzzzzzz' !!}
                            @else
                                abcxyzzzzzzzzzzzzzzzzzzzzz
                            @endif
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="rounded-full w-5 h-5 flex items-center justify-center">
                            @if($email && $email->image_path)
                                <img src="{{ asset($email->image_path) }}" alt="email" class="w-5 h-5">
                            @else
                                <img src="{{ asset('images/svg/email.svg') }}" alt="email" class="w-5 h-5">
                            @endif
                        </div>
                        <span class="text-gray-400 text-xs">
                            @if($email)
                                @php
                                    $emailTranslation = $email->translation(app()->getLocale()) ?? $email->translation('vi');
                                @endphp
                                {!! $emailTranslation ? $emailTranslation->description : 'info@duanvesinhmoitruong.com' !!}
                            @else
                                info@duanvesinhmoitruong.com
                            @endif
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="rounded-full w-5 h-5 flex items-center justify-center">
                            @if($phone && $phone->image_path)
                                <img src="{{ asset($phone->image_path) }}" alt="phone" class="w-5 h-5">
                            @else
                                <img src="{{ asset('images/svg/phone.svg') }}" alt="phone" class="w-5 h-5">
                            @endif
                        </div>
                        <span class="text-gray-400 text-xs">
                            @if($phone)
                                @php
                                    $phoneTranslation = $phone->translation(app()->getLocale()) ?? $phone->translation('vi');
                                @endphp
                                {!! $phoneTranslation ? $phoneTranslation->description : '0909 999 999' !!}
                            @else
                                0909 999 999
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Column 4 - Newsletter -->
            <div class="flex flex-col h-full">
                <div class="grid grid-rows-4 h-full">
                    <div class="flex items-center justify-center lg:justify-start">
                        <h3 class="text-lg font-medium">{{ __('common.subscribe') }}</h3>
                    </div>
                    <div class="flex items-center">
                        <p class="text-gray-400 text-xs w-3/4">{{ __('common.subscribe_description') }}</p>
                    </div>
                    <form wire:submit.prevent="subscribe" class="flex items-center">
                        <div class="flex w-full max-w-full relative">
                            <input type="email" wire:model.defer="email_subscribe" placeholder="Email"
                                class="w-full bg-white text-gray-900 px-2 py-2 focus:outline-none text-sm">
                            <button type="submit"
                                class="bg-[#45B649] px-3 py-2 hover:bg-[#3a9b3d] transition duration-300 flex-shrink-0 cursor-pointer">
                                <img src="{{ asset('images/svg/send.svg') }}" alt="send" class="w-5 h-5">
                            </button>
                        </div>
                    </form>
                    @if ($errors->has('email_subscribe') || $successMessage)
                        <div class="h-4">
                            @error('email_subscribe') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            @if ($successMessage) <span class="text-green-500 text-xs">{{ $successMessage }}</span> @endif
                        </div>
                    @endif
                    <div class="flex items-center gap-4">
                        <a href="{{ $facebook?->translation(app()->getLocale())?->description }}" class="hover:opacity-80 transition duration-300">
                            <div class="bg-black rounded-full w-5 h-5 flex items-center justify-center">
                                <img src="{{ asset('images/svg/facebook-green.svg') }}" alt="facebook" class="w-5 h-5">
                            </div>
                        </a>
                        <a href="{{ $youtube?->translation(app()->getLocale())?->description }}" class="hover:opacity-80 transition duration-300">
                            <div class="rounded-full w-5 h-5 flex items-center justify-center">
                                <img src="{{ asset('images/svg/youtube-green.svg') }}" alt="youtube" class="w-5 h-5">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
