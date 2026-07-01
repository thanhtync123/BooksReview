@include('partials.alert')
<form action="{{ isset($book) ? route('admin.books.update',$book->id):route('admin.books.store') }}"
    method="post">
    @csrf
    @isset($book)
        @method('PUT')
    @endisset
    <input type="text" name="title" id="" value="{{ old('title',$book->title ?? '') }}">
    <input type="text" name="author" id="" value="{{ old('author',$book->author ?? '') }}">
    <button type="submit">{{isset($book) ? 'Sửa':'Thêm'}}</button>
</form>