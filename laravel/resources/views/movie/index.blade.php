@extends('layout')

@section('content')
    <h1>Movies</h1>

    <a href="{{route('movie.create')}}" class="btn btn-success">Add movie</a>

    <table class="table">
        <tr>
            <th>name</th>
            <th>status</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>image</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        @foreach($movies as $movie)
            <tr>
                <td>{{$movie->name}}</td>
                <td>{{$movie->status}}
                    @if($movie->status == 'moderation')
                        <a href="{{route('movie.toggle',$movie)}}"
                           class="btn btn-outline-primary">active</a>
                    @endif
                </td>
                <td>{{$movie->created_at }}</td>
                <td>{{$movie->updated_at }}</td>
                <td>
                    <div class="col-md-1">
                        <img src="{{ url($movie->image ?? '/storage/uploads/ava.jpg') }}" class="img-fluid" width="100%"
                             alt="">
                    </div>
                </td>
                <td>
                    <a href="{{route('movie.edit',['id'=>$movie->id])}}"
                       class="btn btn-outline-primary">update</a>
                </td>
                <td><a href="/movie/{{$movie->id}}/delete"
                       class="btn btn-outline-danger">delete</a></td>
            </tr>
        @endforeach
    </table>
    <ul>
        <li>
            <a href="{{ $movies->nextPageUrl() }}">Next page</a>
        </li>
        <li>
            <a href="{{ $movies->previousPageUrl() }}">Prev page</a>
        </li>
    </ul>
@endsection

