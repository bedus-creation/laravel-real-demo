@extends('theme.base.app')

@section('content')
<laravel-echo :to_id="{{$user->id}}" :init_messages="{{$messages}}"></laravel-echo>
@endsection
