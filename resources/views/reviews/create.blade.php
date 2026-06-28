@extends('layouts.app')
@section('content')
    <h1>Thêm review cho Sách:</h1>
    {{ $book->title }}
    </br>
    <form action="{{route('books.reviews.store', $book)}}" method="POST">
        @csrf
          <textarea name="review" id="" cols="30" rows="10" required></textarea>
        </br>
        <input type="number" min="1" max="5" name="rating" value="1" />

        <button type="submit">Submit</button>
    </form>

@endsection