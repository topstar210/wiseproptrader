
<nav>
    <div class="d-flex justify-content-between pl-2">
        @if ($paginator->hasPages())
            <ul class="pagination pagination-rounded float-right p-1 m-1">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
                <li>
                    <div class="dropdown" style="display: inline-block;margin-left: 2em;">
                        Showing {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (Request::query('per_page'))
                                {{ (integer) Request::query('per_page') }} results
                            @else
                                15 results
                            @endif
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style="z-index: 10000;">
                            <li><a class="" href="{{ handle_query_string('per_page=25', Request::query()) }}">25 results</a></li>
                            <li><a class="" href="{{ handle_query_string('per_page=50', Request::query()) }}">50 results</a></li>
                            <li><a class="" href="{{ handle_query_string('per_page=100', Request::query()) }}">100 results</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        @else
            <div class="align-self-center">Showing {{ $paginator->total() }} results </div>
        @endif
    </div>
</nav>
