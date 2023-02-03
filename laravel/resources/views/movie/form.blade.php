@extends('layout')

@section('form')
    @if($movie->id)
        <h3>Movie update</h3>
    @else
        <h3>Creation of movies</h3>
    @endif
    <form action="@if($movie->id) {{route('movie.update')}}  @else {{route('movie.store')}}  @endif"
          method="post" enctype="multipart/form-data">
        @csrf
        @if($movie->id)
            <input type="hidden" name="id" value="{{ $movie->id }}">
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <label for="name"></label>
            <input type="text" id="name" name="name"
                   value="{{ ($movie->name && !$errors->has('name') ? $movie->name : old('name')) }}">
            @if($errors->has('name'))
                @foreach($errors->get('name') as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="genres" class="form-label">Genre:</label>
                <select name="genres[]" id="genres" multiple>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id ?? old('name')}}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div class="form-group">

                    <input type="file" id="image" name="image">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
