<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieGenre extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    protected $with =['genre','movie'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class,);
    }
}
