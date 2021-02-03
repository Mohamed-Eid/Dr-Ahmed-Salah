<div class="print intro-y flex flex-wrap sm:flex-row sm:flex-no-wrap items-center mt-3">
@if ($paginator->hasPages())
    <ul class="pagination">
        @if ($paginator->onFirstPage())
        <li>
            <a class="pagination__link" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-left w-4 h-4">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </a>
        </li>        
        @else
        <li>
            <a class="pagination__link" href="{{ $paginator->previousPageUrl() }}"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-left w-4 h-4">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </a>
        </li>  
        @endif


        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li> 
                            <a class="pagination__link pagination__link--active" href="">{{ $page }}</a>
                        </li>
                    @else
                        <li> 
                            <a class="pagination__link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
        <li>
            <a class="pagination__link" href="{{ $paginator->nextPageUrl() }}"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-right w-4 h-4">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg> </a>
        </li>
        @else
        <li>
            <a class="pagination__link" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-right w-4 h-4">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg> </a>
        </li>
        @endif
    </ul>
@endif
</div>