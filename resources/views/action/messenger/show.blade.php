@extends('theme.base.app')

@section('content')
<h1>{{auth()->user()->name}}</h1>
<laravel-echo :auth_id="{{auth()->user()->id}}" :to_id="{{$user->id}}" :init_messages="{{$messages}}"></laravel-echo>
@endsection
