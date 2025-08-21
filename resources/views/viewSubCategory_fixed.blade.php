@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">{{ $subCategory->name }}</h2>
        </div>
    </div>
    
    <div class="row">
        @forelse($newsList as $news)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}" 
                         class="card-img-top" alt="{{ $news->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('news.show', $news->id) }}" class="text-dark text-decoration-none">
                                {{ $news->title }}
                            </a>
                        </h5>
                        <p class="card-text flex-grow-1">
                            {!! Str::limit($news->content, 100, '...') !!}
                        </p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between text-muted small">
                                <span><i class="fa fa-clock"></i> {{ $news->created_at->format('d/m/Y') }}</span>
                                <span><i class="fa fa-eye"></i> {{ $news->views }}</span>
                                <span><i class="fa fa-thumbs-up"></i> {{ $news->likes->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h4><i class="fa fa-info-circle"></i> لا توجد أخبار</h4>
                    <p class="mb-0">لا توجد أخبار في هذا القسم الفرعي حالياً.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
