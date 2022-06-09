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
        @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{ session('status') }}</strong>
            </div>
        @endif

        <div class="card">
            <div class="card-header" style="text-align: center;">
                Edit Post
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
                <form action="/posts/{{$post->id}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$post->id}}" >
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" value="{{old('name', $post->name)}}"  class="form-control" name="name" placeholder="Enter Name">
                        {{-- old input in edit form --}}

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="description" class="form-control" placeholder="Enter Description" cols="30" rows="10">{{old('description', $post->description)}}</textarea>
                    </div>

                     <div class="form-group">
                        <select name="category_id" class="form-control" id="">
                            <option value="">Select Category</option>
                            @foreach ($category as $value)
                                <option value="{{$value->id}}" {{$value->id == $post->category_id ? "selected" : " "}}>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/posts" class="btn btn-success">Back</a>
                </form>
                </div>

            </div>
        </div>
    </div>

@endsection
