@if ($paginator->hasPages())
    <nav class="flex items-center space-x-2 text-black">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-2 py-1 text-gray-500 cursor-pointer">&lt;</span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled"
                class="px-2 py-1 hover:text-[#529949] cursor-pointer">&lt;</button>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-2 py-1">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="px-2 py-1 font-bold border-b border-[#529949] text-[#529949] cursor-pointer">{{ $page }}</span>
                    @else
                        <button wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled"
                            class="px-2 py-1 hover:text-[#529949] cursor-pointer">{{ $page }}</button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled"
                class="px-2 py-1 hover:text-[#529949] cursor-pointer">&gt;</button>
        @else
            <span class="px-2 py-1 text-gray-500 cursor-pointer">&gt;</span>
        @endif
    </nav>
@endif
