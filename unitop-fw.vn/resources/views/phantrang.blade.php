@foreach ($sanpham as $item)
    {{$item['ten']}}<br>
@endforeach
{!!$sanpham->links()!!}