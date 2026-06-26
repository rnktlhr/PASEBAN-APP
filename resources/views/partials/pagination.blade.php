@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation"
        style="display: flex; justify-content: center; align-items: center; gap: 16px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span
                style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: #9ca3af; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; cursor: not-allowed;">
                &laquo; Sebelumnya
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: var(--navy); background-color: #ffffff; border: 1px solid #d1d5db; border-radius: 8px; text-decoration: none; transition: all 0.2s;"
                onmouseover="this.style.borderColor='var(--orange-600)'; this.style.color='var(--orange-600)';"
                onmouseout="this.style.borderColor='#d1d5db'; this.style.color='var(--navy)';">
                &laquo; Sebelumnya
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: var(--navy); background-color: #ffffff; border: 1px solid #d1d5db; border-radius: 8px; text-decoration: none; transition: all 0.2s;"
                onmouseover="this.style.borderColor='var(--orange-600)'; this.style.color='var(--orange-600)';"
                onmouseout="this.style.borderColor='#d1d5db'; this.style.color='var(--navy)';">
                Selanjutnya &raquo;
            </a>
        @else
            <span
                style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: #9ca3af; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; cursor: not-allowed;">
                Selanjutnya &raquo;
            </span>
        @endif
    </nav>
@endif