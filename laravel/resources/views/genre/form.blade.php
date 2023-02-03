@extends('layout')

@section('form')
    @if($genre->id)
        <h3>Genre update</h3>
    @else
        <h3>Creation of genres</h3>
    @endif
    <form action="@if($genre->id) {{route('genre.update')}} @else {{route('genre.store')}} @endif"
          method="post" enctype="multipart/form-data">
        @csrf
        @if($genre->id)
            <input type="hidden" id="id" name="id" value="{{ $genre->id }}">
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <label for="name"></label><input type="text" id="name" name="name"
                                             value="{{ ($genre->name && !$errors->has('name') ? $genre->name : old('name')) }}">
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
                <label for="movies" class="form-label">Movie:</label>
                <select name="movies[]" id="movies" multiple>
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id ?? old('name')}}">{{ $movie->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
