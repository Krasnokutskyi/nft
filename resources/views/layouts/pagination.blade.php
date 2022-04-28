<div class="pagination-container xlarge">
  <div class="pagination">
    <ul>
      <!-- Previous Page Link -->
      @if ($paginator->onFirstPage())
        <li class="previous disabled"><a href="#">Previous</a></li>
      @else
        <li class="previous"><a href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
      @endif

      <!-- Pagination Elements -->
      @foreach ($elements as $element)
        @if (is_string($element))
          <li class="active">
            {{ $element }}
          </li>
        @endif
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="active">
                <a>{{ $page }}</a>
              </li>
            @else
              <li>
                <a href="{{ $url }}">{{ $page }}</a>
              </li>
            @endif
          @endforeach
        @endif
      @endforeach
     
      <!-- Next Page Link -->
      @if ($paginator->hasMorePages())
        <li class="next"><a href="{{ $paginator->nextPageUrl() }}">Next</a></li>
      @else
        <li class="next disabled"><a href="{{ $paginator->nextPageUrl() }}">Next</a></li>
      @endif
    </ul>
  </div>
</div>