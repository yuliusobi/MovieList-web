<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function MovieActor()
    {
        return $this->hasMany(MovieActor::class);
    }

    public function MovieGenre()
    {
        return $this->hasMany(MovieGenre::class);
    }

}
