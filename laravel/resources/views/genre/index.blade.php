@extends('layout')

@section('content')
    <h1>Genres</h1>
    <a href="{{route('genre.create')}}" class="btn btn-success">Add genre</a>
    <table class="table">
        <tr>
            <th>name</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        @foreach($genres as $genre)
            <tr>
                <td>{{$genre->name}}</td>
                <td>{{$genre->created_at }}</td>
                <td>{{$genre->updated_at }}</td>
                <td>
                    <a href="{{route('genre.edit',['id'=>$genre->id])}}"
                       class="btn btn-outline-primary">update</a>
                </td>
                <td><a href="/genre/{{$genre->id}}/delete"
                       class="btn btn-outline-danger">delete</a></td>
            </tr>
        @endforeach
    </table>
    <ul>
        <li>
            <a href="{{ $genres->nextPageUrl() }}">Next page</a>
        </li>
        <li>
            <a href="{{ $genres->previousPageUrl() }}">Prev page</a>
        </li>
    </ul>
@endsection


