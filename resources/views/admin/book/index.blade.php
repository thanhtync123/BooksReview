@extends('layouts.sidebar')
@section('title')
    Sách
@endsection
@section('content')
@if (session('success'))
    <p>{{ (session('success')) }}</p>
@endif
<a href="{{ route('admin.books.create') }}">Thêm</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sách</th>
            <th>Tác giả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $books as $item )
         <tr>
            <td>{{ $item->id }}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->author}}</td>
            <td>
                <a href="{{ route('admin.books.edit',$item->id) }}">Sửa</a>
                    <form action="{{ route('admin.books.destroy',$item->id) }}" method="post">
                            @csrf
                            <button type="submit">Xóa</button>
                            @method('DELETE')
                    </form>
            </td>
        </tr>
        @endforeach
       
    </tbody>
</table>
@endsection