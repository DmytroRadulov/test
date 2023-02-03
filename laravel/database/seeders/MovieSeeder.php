<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = Genre::all();
                Movie::factory(25)->make()->each(function ($movie) use ($genres) {
            $movie->save();
            $movie->genres()->attach($genres->random(rand(0,1))->pluck('id'));
        });

    }
}
