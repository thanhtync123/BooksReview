
    <form action="/login" method="post">
        @csrf
        Tên đăng nhập: <input type="email" name="email" id="">
        <br>
        Mật khẩu: <input type="text" name="password" id="">
        <br>
        <button type="submit">Đăng nhập</button>
    </form>
    <a href="{{ route('register') }}">Đăng ký</a>
    @if ($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif
