@if ($paginator->hasPages())
    <div class="pesco-pagination mb-40" data-aos="fade-up" data-aos-duration="2000">
        <ul>

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <span><i class="far fa-angle-left"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="far fa-angle-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)

                {{-- Dots --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <a href="javascript:void(0)" class="active" aria-current="page">
                                    {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">
                                    {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="far fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span><i class="far fa-angle-right"></i></span>
                </li>
            @endif

        </ul>
    </div>
@endif
