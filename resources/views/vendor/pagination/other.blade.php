@if ($paginator->hasPages())
<ul class="segunda-paginacion">
   
    @if ($paginator->onFirstPage())
        <li class="disabled">{{ $paginator->currentPage() }}</li>
        <li class="disabled"><span>|←</span></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}">@if($paginator->onFirstPage()) {{ $paginator->currentPage() }} @else {{ $paginator->currentPage()-1 }} @endif</a></li>
        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">|←</a></li>
    @endif

    
    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">→|</a></li>
        <li><a href="{{ $paginator->nextPageUrl() }}">@if(($paginator->currentPage()) == $paginator->lastPage()) {{ $paginator->currentPage() }} @else {{ $paginator->currentPage()+1 }} @endif</a></li>
    @else
        <li class="disabled"><span>→|</span></li>
        <li class="disabled">@if(($paginator->currentPage()) == $paginator->lastPage()) {{ $paginator->currentPage() }} @else {{ $paginator->currentPage()+1 }} @endif</li>
    @endif

</ul>
@endif 