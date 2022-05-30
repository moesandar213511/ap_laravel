@extends('layout')

@section('content')
    <h3>About Page</h3>
    {{-- laravel blade looping --}}
    @foreach ($data as $key => $value)
        {{$key.' => '.$value}}
    @endforeach
@endsection
