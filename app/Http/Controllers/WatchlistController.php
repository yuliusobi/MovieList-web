<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Watchlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WatchlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('status') == 'All'){
            $dataMovie = Watchlist::latest()->with(['Movie','User'])->where(['user_id' => auth()->user()->id])->get();
        }else{
            $dataMovie = Watchlist::latest()->filter(request(['search','status']))
             ->with(['Movie','User'])->where(['user_id' => auth()->user()->id])->get();
        }

        return view('watchlist.index',[
            'lists' => $dataMovie,
            'title' => 'My Watchlist',
            'active' => 'watchlist',
            'status' => request('status')
        ]);
    }

    public function watchlistSort(Request $request){
        $status = $request->status;

        if($status == 'All'){
            $dataMovie = Watchlist::latest()->filter(request(['search']))
            ->with(['Movie','User'])->where(['user_id' => auth()->user()->id])->get();
        }else{
            $dataMovie = Watchlist::latest()->with(['Movie','User'])
             ->where(['user_id' => auth()->user()->id,'status' => $status])->get();
        }

        return view('watchlist.index',[
            'lists' => $dataMovie,
            'title' => 'My Watchlist',
            'active' => 'watchlist',
            'status' => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie= $request->input('movie_id');
        $user = auth()->user()->id;

        $watchlist = new Watchlist;
        $watchlist->user_id = $user;
        $watchlist->movie_id = $movie;
        $watchlist->status = 'Planned';
        $watchlist->created_at = Carbon::now();
        $watchlist->updated_at = Carbon::now();
        $watchlist->save();

        return redirect('/')->with('success', 'Movie has been added to watchlist!');
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
        $status = $request->validate([
            'status' => 'required'
        ]);

        Watchlist::where('id',$id)->update($status);

        return redirect('/watchlist')->with('success', 'Status has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Watchlist::destroy($id);

        return redirect('/watchlist')->with('success', 'Movie has been deleted from watchlist!');
    }
}
