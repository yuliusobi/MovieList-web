<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\MovieActor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('actor.create',[
            'actors' => Actor::all(),
            'title' => 'Create Actor',
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
        return view('actor.create',[
            'actors' => Actor::all(),
            'title' => 'Create Actor',
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
            'name' => 'required|max:255',
            'gender' => 'required',
            'bio' => 'required',
            'dob' => 'required',
            'place_of_birth' => 'required',
            'img' => 'image|file|max:3060',
            'popularity' => 'required'
        ]);

        if($request->file('img')){
            $validatedData['img'] = $request->file('img')->store('actor-images');
        }

        Actor::create($validatedData);

        return redirect('/actors')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        $ActorMovie= DB::table('movie_actors')
            ->join('movies','movies.id','=','movie_actors.movie_id')
            ->join('actors','actors.id','=','movie_actors.actor_id')
            ->where(['actor_id' => $actor->id])
            ->get(['movies.title','movies.thumb_img']);

        return view('actor.detail',[
            'actor' => $actor,
            'movies' => $ActorMovie,
            'title' => $actor->name,
            'active' => ''
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Actor $actor)
    {
        return view('actor.edit',[
            'actor' => $actor,
            'title' => 'Edit Actor',
            'active' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actor $actor)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'gender' => 'required',
            'bio' => 'required',
            'dob' => 'required',
            'place_of_birth' => 'required',
            'img' => 'image|file|max:3060',
            'popularity' => 'required'
        ]);


        if($request->file('img')){
            if($actor->img){
                Storage::delete($actor->img);
            }
            $validatedData['img'] = $request->file('img')->store('actor-images');
        }


        Actor::where('id',$actor->id)->update($validatedData);

        return redirect('/actors')->with('success', 'Actor has been updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        if($actor->img){
            Storage::delete($actor->img);
        }

        MovieActor::where('actor_id',$actor->id)->delete();
        Actor::destroy($actor->id);

        return redirect('/actors')->with('success', 'actor has been deleted!');
    }
}
