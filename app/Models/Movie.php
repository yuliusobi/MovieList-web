<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function scopeFilter($query, array $filters)
    {
        // if(isset($filters['search']) ? $filters['search'] : false ){
        //     return $query->where('title','like','%' . $filters['search'].'%')
        //         ->orWhere('body','like','%' . $filters['search'].'%');
        // }

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });

        $query->when($filters['sortby'] ?? false, function($query, $sortby) {
            if($sortby == 'latest') {
                return $query->orderBy('created_at','desc');
            }else if($sortby == 'asc') {
                return $query->orderBy('title','asc');
            }else if($sortby == 'desc') {
                return $query->orderBy('title','desc');
            }
        });

        // $query->when($filters['genre'] ?? false, function($query, $genre) {
        //     return $query->join('movie_genres','movie_genres.movie_id','=',$query->id)
        //     ->where
        //     where('title', 'like', '%' . $genre . '%');
        // });
    }

    public function MovieActor()
    {
        return $this->hasMany(MovieActor::class);
    }

    public function MovieGenre()
    {
        return $this->hasMany(MovieGenre::class);
    }

    public function Watchlist(){
        return $this->hasMany(Watchlist::class);
    }

}
