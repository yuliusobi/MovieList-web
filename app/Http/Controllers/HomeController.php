<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdmin;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // popular
        $idCollection = Watchlist::groupBy('movie_id')->selectRaw('count(*) as total,movie_id')
        ->orderBy('total','desc')->pluck('movie_id')->toArray();

        $filtered = Movie::whereIn('id', $idCollection)->get();

        $movies = Movie::latest()->filter(request(['search','sortby','genre']))->paginate();

        if(request('genre')){
            $movies= DB::table('movie_genres')
            ->join('movies','movies.id','=','movie_genres.movie_id')
            ->join('genres','genres.id','=','movie_genres.genre_id')
            ->where(['genres.name' => request('genre')])
            ->get();
        }

        if(Auth::check() && auth()->user()->is_admin == 0){
            $dataMovie = Watchlist::latest()->with(['Movie','User'])->where(['user_id' => auth()->user()->id])->get();

            return view('index',[
                'title' => 'Home',
                'active' => 'home',
                "movies" => $movies,
                "moviesPopular" => $filtered,
                "genres" => Genre::all(),
                "watchlists" => $dataMovie,
                "flag" => 1
            ]);
        }else{
            return view('index',[
                'title' => 'Home',
                'active' => 'home',
                "movies" => $movies,
                "moviesPopular" => $filtered,
                "genres" => Genre::all(),
                "flag" => 1
            ]);

        }


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
