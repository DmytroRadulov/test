<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Movie;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::with(['movies'])->paginate(5);
        return view('genre/index', compact('genres'));
    }

    public function create()
    {
        $genre = new Genre();
        $movies = Movie::all();

        return view('genre/form', compact('genre', 'movies'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
            ],
        ]);

        $genre = Genre::create($request->all());
        $genre->movies()->attach($request->input('movies'));

        return redirect()->route('genre');
    }

    public function edit($id)
    {
        $genre = Genre::find($id);
        $movies = Movie::all();
        return view('genre/form', compact('genre', 'movies'));
    }

    public function update(Request $request)
    {
        $genre = Genre::find($request->input('id'));
        $request->validate([
            'name' => [
                'required',
                Rule::unique('genres', 'name')->ignore($genre->id),
            ],
            'movies' => ['required', 'exists:movies,id'],
        ]);
        $genre->update($request->all());
        $genre->movies()->sync($request->input('movies'));
        return redirect()->route('genre');
    }


    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genre');
    }

}
