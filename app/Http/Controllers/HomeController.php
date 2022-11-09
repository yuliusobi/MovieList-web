<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('index',[
            'title' => 'Home',
            'active' => 'home',
            "movies" => Movie::all()
        ]);
    }

    // controller yang terhubung ke page detail movie
    public function showMovie(Movie $movie){

        $dataGenre= DB::table('movie_genres')
                ->join('movies','movies.id','=','movie_genres.movie_id')
                ->join('genres','genres.id','=','movie_genres.genre_id')
                ->where(['movie_id' => $movie->id])
                ->get(['movies.title','genres.name']);

        $dataActor= DB::table('movie_actors')
                ->join('movies','movies.id','=','movie_actors.movie_id')
                ->join('actors','actors.id','=','movie_actors.actor_id')
                ->where(['movie_id' => $movie->id])
                ->get(['movies.title','actors.img','actors.name','movie_actors.char_name']);

        return view('movie.detail',[
            'title' => $movie->title,
            'active' => 'movies',
            "movie" => $movie,
            "genres" => $dataGenre,
            "actors" => $dataActor
        ]);
    }
}
