@if ($paginator->hasPages())
    <div class="product__pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="disabled">&laquo;</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="previous-page">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <a href="#" class="disabled">{{ $element }}</a>
            @elseif (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="#" class="current-page">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="next-page"><i class="fa fa-angle-double-right"></i></a>
        @else
            <a href="#" class="disabled"><i class="fa fa-angle-double-right"></i></a>
        @endif
    </div>
@endif
