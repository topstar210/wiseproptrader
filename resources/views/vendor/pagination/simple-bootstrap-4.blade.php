@if ($paginator->hasPages())
    <nav>
        <ul class="pagination m-0 p-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link bg-dark">@lang('pagination.previous')</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link bg-dark" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link bg-dark" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link bg-dark">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
