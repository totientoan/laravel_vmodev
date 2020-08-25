@extends('layouts.master')
@section('NoiDung')
<?php $monhoc = array('php','.net'); ?>
{{-- @if(!empty($monhoc))
    @foreach ($monhoc as $item)
        {{$item}}
    @endforeach
@else
    {{'mảng rỗng'}}
@endif --}}

@forelse ($monhoc as $item)
    {{-- @continue($item == 'php') --}}
    @break($item == '.net')
    {{$item}}   
@empty
    {{"mảng rỗng"}}
@endforelse
@endsection