<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieActor;
use App\Models\MovieGenre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movie.create',[
            'movies' => Movie::all(),
            'genres' => Genre::all(),
            'actors' => Actor::all(),
            'title' => 'Create Movie',
            'active' => ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movie.create',[
            'movies' => Movie::all(),
            'genres' => Genre::all(),
            'actors' => Actor::all(),
            'title' => 'Create Movie',
            'active' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'desc' => 'required|min:10',
            'genres' => 'required',
            'actors' => 'required',
            'char_names' => 'required',
            'director' => 'required|max:255',
            'released_date' => 'required',
            'thumb_img' => 'image|file|max:5120',
            'bg_img' => 'image|file|max:5120'
        ]);


        if($request->file('thumb_img')){
            $validatedData['thumb_img'] = $request->file('thumb_img')->store('movie-images');
        }

        if($request->file('bg_img')){
            $validatedData['bg_img'] = $request->file('bg_img')->store('bg-images');
        }
        // insert data movie
        Movie::create($validatedData);

        // insert data genre
        $idMov = Movie::where('title',$request->title)->value('id');
        $thisTime = Carbon::now();

        foreach($request->genres as $genre){
            DB::insert('insert into movie_genres (movie_id, genre_id,created_at,updated_at) values (?, ?, ?, ?)', [$idMov, $genre,$thisTime,$thisTime]);
        }

        //insert data actor
        $i = 0;

        while($i < sizeof($request->actors)){
            DB::insert('insert into movie_actors (movie_id, actor_id,char_name,created_at,updated_at) values (?,?, ?, ?, ?)', [$idMov, $request->actors[$i],$request->char_names[$i],$thisTime,$thisTime]);
            $i++;
        }


        return redirect('/movies')->with('success', 'New Movie has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $dataGenre= DB::table('movie_genres')
                ->join('movies','movies.id','=','movie_genres.movie_id')
                ->join('genres','genres.id','=','movie_genres.genre_id')
                ->where(['movie_id' => $movie->id])
                ->get(['genres.id','genres.name']);

        $dataActor= DB::table('movie_actors')
                ->join('movies','movies.id','=','movie_actors.movie_id')
                ->join('actors','actors.id','=','movie_actors.actor_id')
                ->where(['movie_id' => $movie->id])
                ->get(['actors.id','actors.name','movie_actors.char_name']);


        return view('movie.edit',[
            'movie' => $movie,
            "genres_data" => $dataGenre,
            "actors_data" => $dataActor,
            "genres" => Genre::all(),
            "actors" => Actor::all(),
            'title' => 'Edit Movie',
            'active' => '',
            'idx' => 0
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'desc' => 'required|min:10',
            'director' => 'required|max:255',
            'released_date' => 'required',
            'thumb_img' => 'image|file|max:5120',
            'bg_img' => 'image|file|max:5120'
        ]);

        if($request->file('thumb_img')){
            if($movie->thumb_img){
                Storage::delete($movie->thumb_img);
            }
            $validatedData['thumb_img'] = $request->file('thumb_img')->store('movie-images');
        }


        if($request->file('bg_img')){
            if($movie->bg_img){
                Storage::delete($movie->bg_img);
            }
            $validatedData['bg_img'] = $request->file('bg_img')->store('bg-images');
        }

        // update data movie
        Movie::where('id',$movie->id)
             ->update($validatedData);


        $request->validate([
            'genres' => 'required',
            'actors' => 'required',
            'char_names' => 'required|max:255'
        ]);


        // Delete -> insert (refresh) data genre
        $thisTime = Carbon::now();
        $thatTime = MovieGenre::where('movie_id',$movie->id)->value('created_at');

        MovieGenre::where('movie_id',$movie->id)->delete();

        foreach($request->genres as $genre){
            DB::insert('insert into movie_genres (movie_id, genre_id,created_at,updated_at) values (?, ?, ?, ?)', [$movie->id, $genre,$thatTime,$thisTime]);
        }

        //Delete -> insert (refresh) data actor

        $thatTime2 = MovieActor::where('movie_id',$movie->id)->value('created_at');
        MovieActor::where('movie_id',$movie->id)->delete();

        $i = 0;

        while($i < sizeof($request->actors)){
            DB::insert('insert into movie_actors (movie_id, actor_id,char_name,created_at,updated_at) values (?,?, ?, ?, ?)', [$movie->id, $request->actors[$i],$request->char_names[$i],$thatTime2,$thisTime]);
            $i++;
        }


        return redirect('/movies')->with('success', 'Movie has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        if($movie->thumb_img){
            Storage::delete($movie->thumb_img);
        }
        if($movie->bg_img){
            Storage::delete($movie->bg_img);
        }

        MovieActor::where('movie_id',$movie->id)->delete();
        MovieGenre::where('movie_id',$movie->id)->delete();
        Movie::destroy($movie->id);

        return redirect('/movies')->with('success', 'Movie has been deleted!');
    }
}
