@props([
    'background' => null,
    'title' => '',
    'height' => '350px',
    'mobile_height' => '35vh',
    'desktop_height' => '70vh',
])

@push('styles')
    <style>
        .border-animation {
            position: relative;
        }

        .border-animation::before,
        .border-animation::after {
            content: '';
            position: absolute;
            background: white;
        }

        .border-animation::before {
            top: 0;
            left: 0;
            width: 0;
            height: 1.5px;
            animation: borderTop 0.2s linear forwards;
        }

        .border-animation::after {
            top: 0;
            right: 0;
            width: 1.5px;
            height: 0;
            animation: borderRight 0.2s linear forwards 0.2s;
        }

        .border-animation .border-bottom {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 0;
            height: 1.5px;
            background: white;
            animation: borderBottom 0.2s linear forwards 0.4s;
        }

        .border-animation .border-left {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 1.5px;
            height: 0;
            background: white;
            animation: borderLeft 0.2s linear forwards 0.6s;
        }

        .title-text {
            opacity: 0;
            animation: fadeIn 0.3s ease forwards 0.8s;
        }

        @keyframes borderTop {
            to {
                width: 100%;
            }
        }

        @keyframes borderRight {
            to {
                height: 100%;
            }
        }

        @keyframes borderBottom {
            to {
                width: 100%;
            }
        }

        @keyframes borderLeft {
            to {
                height: 100%;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
@endpush
<div class="relative bg-[#EBF1F1] flex items-center justify-center">
    <!-- Background Image -->
    <div class="w-full">
        <img src="{{ $background }}" alt="Contact Background" class="w-full h-auto object-cover">
    </div>
    <!-- Title -->
    <div class="absolute inset-0 z-[1] flex flex-col w-full items-start justify-center">
        <div class="container mx-auto px-4 xl:px-20 2xl:px-24">
            <h1 class="text-2xl md:text-3xl xl:text-4xl 2xl:text-5xl text-white py-8">
                <span class="title-text uppercase font-bold">{{ $title }}</span>
            </h1>
        </div>
    </div>
</div>
