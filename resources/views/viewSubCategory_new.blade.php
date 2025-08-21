@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ $subCategory->name }}</h2>
    <div class="row">
        @forelse($newsList as $news)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}" class="card-img-top" alt="" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('news.show', $news->id) }}" class="text-dark">{{ $news->title }}</a>
                        </h5>
                        <p class="card-text">{!! Str::limit($news->content, 100, '...') !!}</p>
                        <div class="d-flex justify-content-between">
                            <small><i class="fa fa-clock"></i> {{ $news->created_at->translatedFormat('d F Y') }}</small>
                            <small><i class="fa fa-eye"></i> {{ $news->views }}</small>
                            <small><i class="fa fa-thumbs-up"></i> {{ $news->likes->count() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>لا توجد أخبار في هذا القسم الفرعي.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
