<div class="container-fluid bg-white">
    <livewire:components.banner />
    <!-- Contact Section -->
    <div class="container mx-auto px-4 py-12 xl:px-20 2xl:px-24 xl:py-20 2xl:py-24">
        <div class="grid grid-cols-1 gap-10">
            <!-- Map -->
            <div class="location-map w-full">
                @php
                    $address = $addressSetting?->translation(app()->getLocale())?->description ?? $addressSetting?->translation('vi')?->description;
                    $phone = $phoneSetting?->translation(app()->getLocale())?->description ?? $phoneSetting?->translation('vi')?->description;
                    $email = $emailSetting?->translation(app()->getLocale())?->description ?? $emailSetting?->translation('vi')?->description;

                    $mapUrl = $address ? 'https://maps.google.com/maps?q=' . urlencode($address) . '&t=&z=15&ie=UTF8&iwloc=&output=embed' : '';
                @endphp

                <div class="bg-[#46AF08] md:flex md:justify-between w-full px-2 xl:px-10 py-3">
                    <div class="flex items-center gap-2">
                        <div class="bg-button rounded-full xl:w-[30px] xl:h-[30px] flex items-center flex-shrink-0">
                            <img src="{{ asset('images/svg/location-w.svg') }}" alt="location"
                                class="w-[20px] h-[20px] xl:w-[30px] xl:h-[30px] min-w-[20px] xl:min-w-[30px]">
                        </div>
                        <span class="text-white text-base xl:text-lg">{!! $address !!}</span>
                    </div>
                    <div class="flex items-center lg:justify-center gap-2">
                        <div class="rounded-full xl:w-[30px] xl:h-[30px] flex items-center flex-shrink-0">
                            <img src="{{ asset('images/svg/email-w.svg') }}" alt="email"
                                class="w-[20px] h-[20px] xl:w-[30px] xl:h-[30px] min-w-[20px] xl:min-w-[30px]">
                        </div>
                        <span class="text-white text-base xl:text-lg">{!! $email !!}</span>
                    </div>
                    <div class="flex items-center lg:justify-end gap-2">
                        <div class=" rounded-full xl:w-[30px] xl:h-[30px] flex items-center flex-shrink-0">
                            <img src="{{ asset('images/svg/phone-w.svg') }}" alt="phone"
                                class="w-[20px] h-[20px] xl:w-[30px] xl:h-[30px] min-w-[20px] xl:min-w-[30px]">
                        </div>
                        <span class="text-white text-base xl:text-lg">{!! $phone !!}</span>
                    </div>
                </div>
                <div class="h-[500px]">
                    @if($mapUrl)
                        <iframe
                            src="{{ $mapUrl }}"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <p>Không thể tải bản đồ. Vui lòng cấu hình địa chỉ trong trang quản trị.</p>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Contact Form -->
            <div class="">
                <form wire:submit.prevent="submit" class="">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 pb-6">
                        <div class="col-span-1">
                            <div class="relative">
                                <input type="text" wire:model="name" id="name"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-500 peer"
                                    placeholder=" " />
                                <label for="name"
                                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] peer-focus:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                    {{ __('contact.form.name.label') }}</label>
                                @error('name')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="relative mt-4">
                                <input type="email" wire:model="email" id="email"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-500 peer"
                                    placeholder=" " />
                                <label for="email"
                                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] peer-focus:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                    {{ __('contact.form.email.label') }}</label>
                                @error('email')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="relative mt-4">
                                <input type="tel" wire:model="phone" id="phone"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-500 peer"
                                    placeholder=" " />
                                <label for="phone"
                                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] peer-focus:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                    {{ __('contact.form.phone.label') }}</label>
                                @error('phone')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="relative h-full">
                            <textarea wire:model="message" id="message"
                                class="block px-2.5 pb-2.5 pt-4 w-full h-full text-sm text-gray-900 bg-transparent border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-500 peer resize-none"
                                placeholder=" "></textarea>
                            <label for="message"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 -top-2 z-10 origin-[0] bg-white px-1 peer-focus:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-1 peer-placeholder-shown:top-1 peer-focus:-top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                {{ __('contact.form.message.label') }}</label>
                            @error('message')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="w-[120px] border-2 border-[#45B649] hover:bg-[#45B649] hover:text-white px-4 py-2 rounded-full  transition duration-300 text-sm cursor-pointer">
                            {{ __('contact.form.submit') }}
                        </button>
                    </div>
                    @if ($successMessage)
                        <div class="text-green-500 mt-2">{{ $successMessage }}</div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
