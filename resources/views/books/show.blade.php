@extends('layouts.app')

@section('content')
<a href="{{ route('books.reviews.create',$book) }}"><button>Thêm review</button></a>
@if(session('success'))
        {{ session('success') }}
@endif
<div class="max-w-3xl mx-auto p-6 space-y-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-3xl font-bold">{{ $book->title }}</h1>
        <p class="text-gray-600">Tác giả: {{ $book->author }}</p>

        <div class="flex items-center gap-2 mt-2">
            <x-star-rating :rating="$book->reviews_avg_rating" />
            <span class="text-sm text-gray-500">
                {{ round($book->reviews_avg_rating, 1) }}/5 • {{ $book->reviews_count }} đánh giá
            </span>
        </div>
    </div>
@forelse ($book->reviews->sortByDesc('created_at') as $item)
        <div class="bg-white rounded-lg shadow p-5 space-y-2">
            <x-star-rating :rating="$item->rating" />

            <p>{{ $item->review }}</p>

            <p class="text-sm text-gray-500">
                {{ $item->created_at->format('d/m/Y H:i') }}
            </p>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-5 text-center text-gray-500">
            Sách này chưa có đánh giá nào.
        </div>
    @endforelse

</div>

@endsection