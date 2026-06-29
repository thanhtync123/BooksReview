<h1>Đăng ký</h1>
<br>
<form action="{{ route('register.store') }}" method="POST">
    @csrf
    Tên người dùng <input type="text" name="name" id="" required> <br>
    Email: <input type="email" name="email" id="" required> <br>
    Mật khẩu: <input type="password" name="password">
    <br>
    Nhập lại mật khẩu:
    <input type="password" name="password_confirmation">
    <br>
    <button type="submit">Đăng ký</button>
</form>
    @if ($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif