@if ($paginator->hasPages())
<nav aria-label="Page navigation example" class="pagination">
    <ul class="lista" id="pagination">  
        @for ($page = 1; $page <= $paginator->lastPage(); $page++)
            @if ($page == $paginator->currentPage())
                <li class="active"><span>{{ $page }}</span></li>
            @else
                <li><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
            @endif
        @endfor
    </ul>
@endif