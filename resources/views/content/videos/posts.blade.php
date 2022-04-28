@extends('layouts.app')

@section('content')

    <div class="page">

        @include('layouts.headers.header-content')
        
        <div class="wrapper">
            <div class="inner__title"><span>Videos</span></div>
            <div class="category blog__cat inner__cat">
                <a href="{{ route('videos.posts') }}" class="@if (Route::currentRouteName() === 'videos.posts') current @endif">All</a>
                @foreach ($categories as $category)
                    @if ($category->posts->count() > 0 or Request::route('alias') === $category->alias)
                        <a class="@if (Request::route('alias') === $category->alias) current @endif" href="{{ route('videos.postsByCategory', ['alias' => $category->alias]) }}">{{ $category->title }}</a>
                    @endif
                @endforeach
            </div>
            <div class="videos">
                <div class="row">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="videos__item">
                                    <a href="#" class="videos__item-preview">
                                        <div class="show_video">
                                            <img src="{{ route('storage.content.video.preview', ['image' => $post->preview]) }}" alt="{{ $post->title }}" onclick="showVideo('{{ route('storage.content.video', ['video' => $post->video]) }}', '{{ route('storage.content.video.preview', ['image' => $post->preview]) }}')">
                                            <svg onclick="showVideo('{{ route('storage.content.video', ['video' => $post->video]) }}', '{{ route('storage.content.video.preview', ['image' => $post->preview]) }}')" width="80" height="80" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M40 73.33a33.33 33.33 0 1 0 0-66.66 33.33 33.33 0 0 0 0 66.66Zm-.04-45.52c1.6.83 3.51 2.15 5.82 3.73l.27.18c1.76 1.21 3.27 2.25 4.36 3.2 1.13 1 2.18 2.23 2.48 3.93.13.76.13 1.54 0 2.3-.3 1.7-1.35 2.92-2.48 3.92-1.1.96-2.6 2-4.36 3.2l-.27.2c-2.3 1.57-4.23 2.9-5.82 3.72-1.61.84-3.46 1.5-5.4.93a6.84 6.84 0 0 1-2.33-1.18c-1.61-1.26-2.13-3.16-2.36-4.94-.22-1.77-.22-4.07-.22-6.83v-.34c0-2.76 0-5.06.22-6.83.23-1.78.75-3.68 2.36-4.94a6.84 6.84 0 0 1 2.32-1.18c1.95-.57 3.8.09 5.4.93Z" fill="currentColor" opacity=".8"/></svg>
                                        </div>
                                    </a>
                                    <div class="videos__item-title">{{ $post->title }}</div>
                                    <div class="videos__item-duration">
                                        {{ $post->playtime }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="lack_posts">Videos haven't been found.</p>
                    @endif
                </div>
            </div>
            @if($posts->lastPage() > 1)
                {{ $posts->links('layouts.pagination') }}
            @endif
        </div>

        @include('layouts.footers.footer-content')

    </div>

@endsection