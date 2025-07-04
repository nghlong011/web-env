@props(['title', 'date', 'description', 'image', 'link'])

<a href="{{ route('news.detail', ['slug' => $link]) }}" class="block group">
    <div class="flex flex-col h-full">
        <div class="aspect-[16/9] overflow-hidden">
            <img src="{{ $image }}" alt="{{ $title }}"
                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
        </div>
        <div class="flex flex-col flex-1 pt-4">
            <h3 class="text-black font-semibold text-lg 2xl:text-2xl uppercase line-clamp-3 min-h-[40px]">{{ $title }}</h3>
            <p class="text-[#7F7F7F] text-sm py-2 italic">{{ $date->format('d/m/Y') }}</p>
            <div class="text-black min-h-[72px] line-clamp-3">{!! $description !!}</div>
        </div>
    </div>
</a>
