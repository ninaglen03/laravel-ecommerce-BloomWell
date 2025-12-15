@if ($paginator->hasPages())
    <div class="pagination-shell reveal">
        <div class="page-info text-muted">
            Showing
            <strong>
                {{ $paginator->firstItem() ?? 1 }}
            </strong>
            to
            <strong>
                {{ $paginator->lastItem() ?? $paginator->count() }}
            </strong>
            of
            <strong>{{ $paginator->total() ?? $paginator->count() }}</strong>
            results
        </div>

        <nav class="pagination-nav" role="navigation" aria-label="Pagination">
            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <span class="pagination-btn is-disabled" aria-disabled="true" aria-label="Previous page">
                    <i class="bi bi-chevron-left"></i>
                </span>
            @else
                <a class="pagination-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif

            <ul class="pagination-pages">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="pagination-ellipsis" aria-hidden="true">{{ $element }}</li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <span class="pagination-page is-active" aria-current="page">{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a class="pagination-page" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <a class="pagination-btn" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">
                    <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span class="pagination-btn is-disabled" aria-disabled="true" aria-label="Next page">
                    <i class="bi bi-chevron-right"></i>
                </span>
            @endif
        </nav>
    </div>
@endif
