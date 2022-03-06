@if ($paginator->hasPages())
    <div class="mt-5 d-flex justify-content-end">
        <nav aria-label="page-pagination">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link">Предыдущие</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Предыдущие</a>
                    </li>
                @endif
                @foreach ($elements as $element)

                    @if (is_string($element))
                        <li class="page-item disabled"><a class="page-link">{{ $element }}</a></li>
                    @endif



                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><a class="page-link">{{$page}}</a></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>

                            @endif
                        @endforeach
                    @endif
                @endforeach


                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Следующие</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link">Следующие</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif

