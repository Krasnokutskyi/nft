@extends('layouts.app')

@section('content')

    <div class="page">
        
        @include('layouts.headers.header-content')

        <div class="wrapper d-flex flex-direction-column">
            <div class="market blog_inner ql-editor">
                {!! $post->text !!}
            </div>
            @if ($like_posts->count() > 0)
                <div class="blog__title"><span>Maybe you like this</span></div>
                <div class="blog">
                    <div class="row">
                        @foreach ($like_posts as $post)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="blog__item">
                                    <a href="{{ route('blog.post', ['alias' => $post->alias]) }}" class="blog__item-preview">
                                        <img src="{{ route('storage.content.blog.preview', ['image' => $post->preview]) }}" alt="{{ $post->preview }}">
                                        <div class="blog__item-box">
                                            <svg width="22" height="22" fill="none" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M20.419 14.732c0 3.578-2.109 5.687-5.687 5.687H6.95c-3.587 0-5.7-2.109-5.7-5.687v-7.8c0-3.573 1.314-5.682 4.893-5.682h2a2.28 2.28 0 0 1 1.824.913l.913 1.214a2.29 2.29 0 0 0 1.826.913h2.83c3.587 0 4.911 1.826 4.911 5.477l-.028 4.965Z" stroke="#E5F43B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.48 13.463h8.736" stroke="#E5F43B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            <div class="blog__item-duration">
                                              @foreach ($post->categories as $category)@if ($loop->iteration > 1), @endif{{$category->title }}@endforeach
                                            </div>
                                        </div>
                                        <span class="blog__item-title">{{ $post->title }}</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        @include('layouts.footers.footer-content')

    </div>
    
@endsection