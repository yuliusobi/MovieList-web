<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        Movie::create($validatedData);

        $idMov = Movie::where('title',$request->title)->value('id');
        $thisTime = Carbon::now();

        foreach($request->genres as $genre){
            DB::insert('insert into movie_genres (movie_id, genre_id,created_at,updated_at) values (?, ?, ?, ?)', [$idMov, $genre,$thisTime,$thisTime]);
        }

        return redirect('/')->with('success', 'New Movie has been added!');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
