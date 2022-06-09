@extends('layout')

@section('content')
    {{-- <?php
        foreach ($data as $key => $value) {
            echo $key." => ".$value."<br>";
        }
    ?> --}}
    {{-- laravel blade looping --}}
    {{-- @foreach ($data as $key => $value)
        {{$key.' => '.$value}}
    @endforeach --}}

    {{-- ====================================================== --}}
    <div class="container">
        <div>
            <a href="posts/create" class="btn btn-success">New Post</a>
            <a href="/logout" class="btn btn-warning">Logout</a>
            <h4 style="float:right;">Welcome to {{Auth::user()->name}}</h4>
            {{-- Auth:: => Auth facades/ login ၀◌င်ထားတဲ့ user ရဲ့ data ရဖို့ laravel ရဲ့ Auth class ကို တန်း access လုပ်လို့ရ။ --}}

            <a href="{{route('root')}}" class="btn btn-default">Test for named routing</a>

        </div><br>

        <div class="card">
            <div class="card-header" style="text-align: center;">
                Contents
            </div>

            {{-- display the flashed message from the session --}}
            {{-- @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif --}}

            {{-- bootstrap alert with close --}}
            @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{ session('status') }}</strong>
            </div>
            @endif 

            <div class="card-body">
                @foreach ($data as $row)
                <div>
                    <h5 class="card-title">{{$row->name}}</h5>
                    <p class="card-text">{{$row->description}}</p>
                    <a href="/posts/{{$row->id}}" class="btn btn-primary">View</a>
                    <a href="/posts/{{$row->id}}/edit" class="btn btn-warning">Edit</a>
                    <form action="/posts/{{$row->id}}" method="post" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div><hr>
                @endforeach

            </div>
        </div>
    </div>

@endsection
