<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with(['genres'])->paginate(5);
        return view('movie/index', compact('movies'));
    }

    public function create()
    {
        $movie = new Movie();
        $genres = Genre::all();
        return view('movie/form', compact('movie', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
            ],
            'image' => ['required', 'image'],
            'genres' => ['required', 'exists:genres,id'],
        ]);

        $movie = Movie::create($request->all());
        $movie->genres()->attach($request->input('genres'));
        $movie->image = $this->uploadImage($request);
        return redirect()->route('movie');
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        $genres = Genre::all();
        return view('movie/form', compact('movie', 'genres'));
    }

    public function update(Request $request)
    {
        $movie = Movie::find($request->input('id'));
        $request->validate([
            'name' => [
                'required',
                Rule::unique('movies', 'name')->ignore($movie->id),
            ],
            'image' => ['required', 'image'],
            'genres' => ['required', 'exists:genres,id'],
        ]);
        $movie->update([
            'name' => $request->input('name'),
            'image' => $this->uploadImage($request),
            'status' => Movie::STATUS_MODERATION
        ]);
        $movie->genres()->sync($request->input('genres'));
        return redirect()->route('movie');
    }

    private function uploadImage(Request $request)
    {

        if (!$request->file('image')) {
            return '';
        }
        $path = $request->file('image')->store('uploads', 'public');
        return Storage::url($path);
    }

    public function toggleStatus($id)
    {
        $movie = Movie::find($id);
        $movie->update([
            'status' => Movie::STATUS_PUBLISHED
        ]);
        return redirect()->route('movie');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movie');
    }

}
