@extends('layouts.app')

@section('content')

    <div class="page">

        @include('layouts.headers.header-content')

        <div class="wrapper">
            <div class="downloads__title"><span>Downloads</span>@if($files->count() > 0)<a href="{{ route('storage.content.downloads.allFiles')}}" class="current_downloads" download="all_files.zip" onclick="downloadFile(event, this)">Download All</a>@endif</div>
            <div class="downloads">
                @if ($files->count() > 0)
                    @foreach ($files as $file)
                        <div class="row row_box">
                            <div class="downloads__box-item">
                                <div class="downloads__box-img-title">
                                    <img src="{{ route('storage.content.downloads.preview', ['image' => $file->preview]) }}" alt="{{ $file->title }}">
                                    <span class="downloads__box-title">{{ $file->title }}</span>
                                </div>
                                <div class="downloads__box-other">
                                    <span class="downloads__box-pres">Presentation</span>
                                    <span class="downloads__box-size">{{ str_replace('.', ',', round((Storage::disk('content')->size('downloads/files/' . $file->file)/1048576), 1)) }} MB</span>
                                    <a  href="{{ route('storage.content.downloads.file', ['file' => $file->file]) }}" onclick="downloadFile(event, this)" class="downloads__box-button" download="{{ $file->title . '.' . pathinfo(route('storage.content.downloads.preview', ['image' => $file->preview]), PATHINFO_EXTENSION) }}">
                                        <svg width="32" height="33" fill="none" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M4 16.5c0-9.333 2.668-12 12-12 9.333 0 12 2.667 12 12s-2.77 12-12 12-12-2.667-12-12Z" stroke="#E5F43B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="m20 15.166-4 4-4-4" stroke="#E5F43B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span>Download</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @else
                    <p class="lack_posts">Files haven't been found.</p>
                @endif
            </div>
            @if($files->lastPage() > 1)
                {{ $files->links('layouts.pagination') }}
            @endif
        </div>

        @include('layouts.footers.footer-content')

    </div>

@endsection