@extends('theme.base.app')

@section('content')
<ul>
    @foreach($users as $item)
    <li><a href="{{url('messenger/'.$item->id)}}">{{$item->name}}</li>
    @endforeach
</ul>
@endsection
