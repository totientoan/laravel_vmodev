@if(Auth::check())
<h1>Đăng nhập thành công</h1>
@if(isset($user)){
    {{"Tên : ".$user->name}}
    <br>
    {{"email : ".$user->email}}

    <a href="{{url('logout')}}" title="logout">logout</a>
}
@endif
@else{
    <h1>bạn chưa đăng nhập</h1>
}
@endif
