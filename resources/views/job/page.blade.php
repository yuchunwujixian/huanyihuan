@if ($paginator->hasPages())
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <a class="jp-first jp-disabled">首页</a>
      <a class="jp-previous jp-disabled">上一页</a>
    @else
      <a class="jp-first" href="{{ $paginator->url(1) }}">首页</a>
      <a class="jp-previous" href="{{ $paginator->previousPageUrl() }}">上一页</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
        <a class="jp-current">{{ $element }}</a>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <a class="jp-current">{{ $page }}</a>
          @else
            <a href="{{ $url }}">{{ $page }}</a>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <a class="jp-next" href="{{ $paginator->nextPageUrl() }}">下一页</a>
      <a class="jp-last" href="{{ $paginator->url($paginator->lastPage()) }}">尾页</a>
    @else
      <a class="jp-next jp-disabled">下一页</a>
      <a class="jp-last jp-disabled">尾页</a>
    @endif
@endif
