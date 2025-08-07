@extends('layouts.app')

@section('content')
        <!-- Hero Section Start -->
        <div class="container-fluid py-4">
            <div class="container">
                <div class="row g-4">
                    <!-- Main News -->
                    <div class="col-lg-8">
                        @foreach ($latestNews->take(1) as $news)
                            <div class="position-relative overflow-hidden rounded">
                                <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                    class="img-fluid w-100" alt="" style="height: 500px; object-fit: cover;" />
                                <div class="position-absolute w-100 h-100 d-flex align-items-end"
                                    style="background: linear-gradient(transparent, rgba(0,0,0,0.8)); top: 0; left: 0;">
                                    <div class="text-white p-4">
                                        <span class="bg-primary px-2 py-1 rounded text-white small">{{ $news->category->name }}</span>
                                        <a href="{{ route('news.show', $news->id) }}"><h2 class="text-white mt-2 mb-0">{{ $news->title }}</h2></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Side News -->
                    <div class="col-lg-4">
                        <div class="row g-3 h-100">
                            @foreach ($latestNews->skip(1)->take(3) as $news)
                                <div class="col-12">
                                    <div class="position-relative overflow-hidden rounded h-100" style="min-height: 160px;">
                                        <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                            class="img-fluid w-100 h-100" alt="" style="object-fit: cover;" />
                                        <div class="position-absolute w-100 h-100 d-flex align-items-end"
                                            style="background: linear-gradient(transparent, rgba(0,0,0,0.7)); top: 0; left: 0;">
                                           <a href="{{ route('news.show', $news->id) }}">
                                             <div class="text-white p-3">
                                                <span class="bg-primary px-2 py-1 rounded text-white small">{{ $news->category->name }}</span>
                                                <h6 class="text-white mt-1 mb-0">{{ Str::limit($news->title, 60, '...') }}</h6>
                                            </div>
                                           </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Section End -->

        <!-- News Sections Grid -->
        <div class="container-fluid py-5">
            <div class="container">
                <!-- Marine News Room -->
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 class="text-center mb-4">{{ __('general.marine_news_room') }}</h3>
                        <div class="row g-3">
                            @php
    $marineCategory = \App\Models\Category::where('name', 'LIKE', '%Marine%')->first() ??
        \App\Models\Category::first();
    $marineNews = $marineCategory ? $marineCategory->news()
        ->where('status', 'Accept')
        ->latest()
        ->take(4)
        ->get() : collect();
                            @endphp
                            @foreach ($marineNews as $news)
                                <div class="col-lg-3 col-md-6">
                                    <div class="news-card h-100">
                                        <div class="position-relative overflow-hidden">
                                            <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                                class="card-img-top" style="height: 200px; object-fit: cover;" alt="">
                                            <span class="position-absolute category-badge text-white px-2 py-1 rounded"
                                                style="top: 10px; left: 10px;">{{ __('general.home') }}</span>
                                        </div>
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-0">
                                                <a href="{{ route('news.show', $news->id) }}" class="news-link">
                                                    {{ Str::limit($news->title, 60, '...') }}
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Exclusive -->
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 class="text-center mb-4">{{ __('general.exclusive') }}</h3>
                        <div class="row g-3">
                            @php
    $exclusiveNews = \App\Models\News::where('status', 'Accept')
        ->withCount('likes')
        ->orderBy('likes_count', 'desc')
        ->take(3)
        ->get();
                            @endphp
                            @foreach ($exclusiveNews as $news)
                                <div class="col-lg-4 col-md-6">
                                    <div class="news-card h-100">
                                        <div class="position-relative overflow-hidden">
                                            <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                                class="card-img-top" style="height: 250px; object-fit: cover;" alt="">
                                            <span class="position-absolute bg-secondary text-white px-2 py-1 rounded category-badge"
                                                style="top: 10px; left: 10px;">{{ __('general.exclusive') }}</span>
                                        </div>
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-0">
                                                <a href="{{ route('news.show', $news->id) }}" class="news-link">
                                                    {{ $news->title }}
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Ports -->
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 class="text-center mb-4">{{ __('general.ports') }}</h3>
                        <div class="row g-3">
                            @php
    $portsCategory = \App\Models\Category::where('name', 'LIKE', '%Port%')->first() ??
        \App\Models\Category::skip(1)->first();
    $portsNews = $portsCategory ? $portsCategory->news()
        ->where('status', 'Accept')
        ->latest()
        ->take(2)
        ->get() : collect();
                            @endphp

                            <div class="col-lg-8">
                                @if($portsNews->first())
                                    @php $mainNews = $portsNews->first(); @endphp
                                    <div class="position-relative overflow-hidden rounded">
                                        <img src="{{ $mainNews->image ? asset('storage/images/' . $mainNews->image) : asset('img/noimg.jpg') }}"
                                            class="img-fluid w-100" style="height: 300px; object-fit: cover;" alt="">
                                        <div class="position-absolute w-100 h-100 d-flex align-items-end"
                                            style="background: linear-gradient(transparent, rgba(0,0,0,0.7)); top: 0; left: 0;">
                                            <div class="text-white p-4">
                                                <span class="bg-primary px-2 py-1 rounded text-white small">{{ __('general.home') }}</span>
                                                <h5 class="text-white mt-2 mb-0">{{ $mainNews->title }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-4">
                                @if($portsNews->count() > 1)
                                    @php $sideNews = $portsNews->skip(1)->first(); @endphp
                                    <div class="position-relative overflow-hidden rounded h-100">
                                        <img src="{{ $sideNews->image ? asset('storage/images/' . $sideNews->image) : asset('img/noimg.jpg') }}"
                                            class="img-fluid w-100 h-100" style="object-fit: cover;" alt="">
                                        <div class="position-absolute w-100 h-100 d-flex align-items-end"
                                            style="background: linear-gradient(transparent, rgba(0,0,0,0.7)); top: 0; left: 0;">
                                            <div class="text-white p-3">
                                                <span class="bg-primary px-2 py-1 rounded text-white small">{{ __('general.home') }}</span>
                                                <h6 class="text-white mt-1 mb-0">{{ $sideNews->title }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Grid -->
                <div class="row">
                    @foreach ($topCategory->take(8) as $category)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="text-center">
                                <h5 class="mb-3">{{ $category->name }}</h5>
                                @php
        $categoryNews = $category->news()
            ->where('status', 'Accept')
            ->latest()
            ->take(1)
            ->first();
                                @endphp
                                @if($categoryNews)
                                    <div class="position-relative overflow-hidden rounded mb-3">
                                        <img src="{{ $categoryNews->image ? asset('storage/images/' . $categoryNews->image) : asset('img/noimg.jpg') }}"
                                            class="img-fluid w-100" style="height: 200px; object-fit: cover;" alt="">
                                        <span class="position-absolute bg-dark text-white px-2 py-1 rounded"
                                            style="top: 10px; left: 10px; font-size: 12px;">{{ $category->name }}</span>
                                    </div>
                                    <h6>{{ Str::limit($categoryNews->title, 50, '...') }}</h6>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
