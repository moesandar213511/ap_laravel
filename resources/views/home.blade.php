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
        <div class="card">
            <div class="card-header" style="text-align: center;">
                Contents
            </div>
            <div class="card-body">
                @foreach ($data as $row)
                <div>
                    <h5 class="card-title">{{$row->name}}</h5>
                    <p class="card-text">{{$row->description}}</p>
                    <a href="#" class="btn btn-primary">View</a>
                </div><hr>
                @endforeach

            </div>
        </div>
    </div>

@endsection
