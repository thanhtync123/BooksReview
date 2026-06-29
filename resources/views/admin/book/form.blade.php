<form action="{{ route('admin.books.store') }}" method="post">
    @csrf
    <input type="text" name="title" id="">
    <input type="text" name="author" id="">
    <button type="submit">Thêm</button>
</form>
