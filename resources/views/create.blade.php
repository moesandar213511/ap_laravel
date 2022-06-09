@extends('layout')

@section('css')
    <style>
        .form-error{
            border: 1px solid red;
        }
    </style>
@endsection

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
                New Post
            </div>
            <div class="card-body">
                {{-- display all errors message --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                <form action="/posts" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control{{($errors->first('name') ? " form-error" : "")}}" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                    </div>
                    {{-- https://laravel.com/docs/8.x/requests#retrieving-old-input --}}
                    {{-- @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}

                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="description" class="form-control" placeholder="Enter Description" cols="30" rows="10">{{ old('description') }}</textarea>
                    </div>
                    {{-- @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}

                    <div class="form-group">
                        <select name="category_id" class="form-control" id="">
                            <option value="">Select Category</option>
                            @foreach ($category as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/posts" class="btn btn-success">Back</a>
                </form>
                </div>

            </div>
        </div>
    </div>

@endsection
