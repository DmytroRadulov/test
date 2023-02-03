<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;

class ApiController extends Controller
{
    public function getGenre()
    {
        $genres = Genre::select()->paginate(3);
        return response([
            "success" => true,
            "data" => $genres
        ]);
    }

    public function getMovie()
    {
        $movies = Movie::select()->paginate(3);
        return response([
            "success" => true,
            "data" => $movies
        ]);
    }

    public function movieGenre($id)
    {
        $movies = Movie::whereRelation('genres', 'genres.id', $id)->paginate(1);
        return response(
            [
                "success" => true,
                "data" => $movies
            ]);

    }

    public function movieId($id)
    {
        $movies = Movie::find($id);
        return response(
            [
                "success" => true,
                "data" => $movies
            ]);

    }
}
