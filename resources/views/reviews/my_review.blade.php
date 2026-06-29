@extends('layouts.app')
@section('content')
Đánh giá của tôi
@if (session('success'))
<p>Xóa thành công</p>
@endif
@forelse( $reviews as $item )
<div
    class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col justify-between hover:shadow-md transition-all">
    <div>
        <div class="flex justify-between items-start mb-2">
            <h2 class="text-xl font-bold text-gray-900 hover:text-indigo-600 transition-colors">
                {{$item->book->title }}
            </h2>
            <span class="bg-amber-100 text-amber-800 font-bold px-2 py-1 rounded text-sm shrink-0 ml-2">
                <p> <x-star-rating :rating="$item->rating" /></p>
            </span>
        </div>
        <p class="text-sm text-gray-500 mb-4">
            Tác giả: <span class="font-medium text-gray-700">{{$item->book->author}}</span>
        </p>
        <p>{{ $item->review }}</p>
        <p>{{ $item->created_at->format('H:i d/m/Y') }}</p>
    </div>
    <div class="border-t border-gray-100 pt-4 mt-4 flex justify-between items-center text-sm text-gray-500">
    </div>

    <form action="{{ route('reviews.deleteMyReviews', $item->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Xóa bình luận</button>
    </form>

</div>

@empty
    <p>Không tìm thấy bình luận nào</p>
@endforelse


@endsection