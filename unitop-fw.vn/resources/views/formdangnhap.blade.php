<h1>Form Đăng Nhập</h1>
{{$error ?? ''}}
<form action="{{route('login')}}" method="post">
    {{csrf_field()}}
    <input type="text" name="username" placeholder="username">
    <input type="text" name="password" placeholder="password">
    <input type="submit" name="submit">
</form>