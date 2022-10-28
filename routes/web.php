<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;
use App\Models\Movie;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index']);


Route::get('/register',[RegisterController::class,'index'])->middleware('guest');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);

Route::get('/movie/{movie:title}',[HomeController::class,'show']);

// route ke navbar -> movie yang isinya list movie
Route::get('/movies',function(){
    return view('movie.index',[
        'title' => 'Movies',
        'active' => 'movies',
        'movies' => Movie::all()
    ]);
});

// route buat admin aja buat add,edit,delete movie
Route::resource('/admin/movie',MovieController::class)->middleware('admin');


// route ke page actors list
Route::resource('/actors',ActorController::class);
