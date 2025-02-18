@extends('_layouts.master')

@php
    $page->type = 'article';
@endphp

@section('body')
    @if ($page->cover_image)
        <img src="{{ $page->cover_image }}" alt="{{ $page->title }} cover image" class="mb-2">
    @endif

    <h1 class="leading-none mb-4">{{ $page->title }}</h1>
    <p class="mb-2"><strong>Approx Time:</strong> {{ $page->getReadTime() }} Minutes</p>
    {{--    <p class="text-xl md:mt-0 md:mb-4">{{ $page->description }}</p> --}}
    <p class="text-gray-700 text-lg md:mt-0">{{ $page->author }} • {{ date('F j, Y', $page->date) }}</p>

    <div>
        @if ($page->categories)
            @foreach ($page->categories as $i => $category)
                <a href="{{ '/articles/categories/' . $category }}" title="View posts in {{ $category }}"
                    class="inline-block bg-gray-300 hover:bg-blue-200 leading-loose tracking-wide text-gray-800 uppercase text-xs font-semibold rounded mr-4 px-3 pt-px ">{{ $category }}</a>
            @endforeach
        @endif
    </div>


    <div class="border-b border-blue-200 my-8" v-pre></div>
    <div class="border-b border-blue-200 mb-10 pb-4" v-pre>
        @yield('content')
    </div>

    <div class="-mt-8 mb-4">
        @include('_components.social-share')
    </div>



    <div id="cusdis_thread"
      data-host="https://cusdis.com"
      data-app-id="3594ef33-d3a4-4d4f-a260-7e603cb11196"
      data-page-id="{{ PAGE_ID }}"
      data-page-url="{{ PAGE_URL }}"
      data-page-title="{{ PAGE_TITLE }}"
    ></div>
    <script async defer src="https://cusdis.com/js/cusdis.es.js"></script>



    <nav class="flex justify-between text-sm md:text-base">
        <div>
            @if ($next = $page->getNext())
                <a href="{{ $next->getUrl() }}" title="Older Post: {{ $next->title }}">
                    &LeftArrow; {{ $next->title }}
                </a>
            @endif
        </div>

        <div>
            @if ($previous = $page->getPrevious())
                <a href="{{ $previous->getUrl() }}" title="Newer Post: {{ $previous->title }}">
                    {{ $previous->title }} &RightArrow;
                </a>
            @endif
        </div>
    </nav>
@endsection
