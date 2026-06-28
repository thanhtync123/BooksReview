@extends('layouts.app')
@section('content')
    <h1>Danh sách Book</h1>
    <form action="{{route('books.index')}}" method="GET">
        <input type="text" name="txb_search" value="{{ request('txb_search') }}">
        <input type="hidden" name="filter" value="{{ request('filter') }}"/>
        <button type="submit">Tìm kiếm</button>
        <a href="{{ route('books.index') }}"><button>Clear</button></a>
    </form>
    @php
        $filters = [
            'popular' => 'Mới nhất',
            'popular_last_month' => 'Phổ biến tháng trước',
            'popular_6_months_ago' => 'Phổ biến 6 tháng trước',
            'highest_review_last_month' => 'Đánh giá cao tháng trước',
            'highest_review_6_months_ago' => 'Đánh giá cao 6 tháng trước'
        ];
    @endphp

    @foreach ($filters as $key => $label)
        <p>
            <a href="{{ route('books.index',['filter'=>$key]) }}">{{ $label }}</a>
        </p>
    @endforeach
    @forelse ($books as $item)
        <div
            class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col justify-between hover:shadow-md transition-all">
            <div>
                <div class="flex justify-between items-start mb-2">
                    <h2 class="text-xl font-bold text-gray-900 hover:text-indigo-600 transition-colors">
                        <a href="{{route('books.show', $item)}}">{{$item->title}}</a>
                    </h2>
                    <span class="bg-amber-100 text-amber-800 font-bold px-2 py-1 rounded text-sm shrink-0 ml-2">
                        ⭐ {{round($item->reviews_avg_rating, 1)}} trong tổng {{$item->reviews_count}} bình luận
                        <p> <x-star-rating :rating="$item->reviews_avg_rating" /></p>

                    </span>
                </div>
                <p class="text-sm text-gray-500 mb-4">
                    Tác giả: <span class="font-medium text-gray-700">{{$item->author}}</span>
                </p>
            </div>
            <div class="border-t border-gray-100 pt-4 mt-4 flex justify-between items-center text-sm text-gray-500">
                <div class="flex items-center space-x-1">
                    <span>💬</span>
                    <span class="font-medium text-gray-700">{{$item->reviews_count}}</span>
                    <span>lượt đánh giá</span>
                </div>
                <a href="{{route('books.show', $item)}}"
                    class="text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center group">
                    Xem chi tiết
                    <span class="transform group-hover:translate-x-1 transition-transform ml-1">&rarr;</span>
                </a>
            </div>
        </div>
    @empty
        <div
            class="col-span-full bg-white text-center py-16 px-4 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
            <div class="text-6xl mb-4 text-gray-300 select-none">📭</div>

            <h3 class="text-xl font-bold text-gray-700 mb-2 tracking-tight">
                Không tìm thấy cuốn sách nào!
            </h3>

            <p class="text-gray-400 max-w-md mx-auto mb-6 text-sm leading-relaxed">
                Hệ thống không tìm thấy kết quả nào trùng khớp với từ khóa tìm kiếm hoặc điều kiện bộ lọc hiện tại của bạn. Vui
                lòng thử lại.
            </p>

            <a href="/books"
                class="inline-flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-2.5 rounded-lg border border-gray-300 text-sm transition-colors shadow-sm">
                🔄 Làm mới danh sách
            </a>
        </div>
    @endforelse


@endsection