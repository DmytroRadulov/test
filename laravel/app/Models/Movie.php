<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    const STATUS_PUBLISHED = 'published';
    const STATUS_MODERATION = 'moderation';

    protected $fillable = [
        'name',
        'status',
        'image',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function getMovieId()
    {
        return Movie::where('movie_id')->count();
    }

}
