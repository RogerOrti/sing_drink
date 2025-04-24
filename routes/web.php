<?php

use App\Models\Music;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariController;
use App\Http\Controllers\Api\LocalsController;
use App\Models\Local;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('myHome.home');
});


Route::get('/register', [UsuariController::class,'showRegister'])->name('register');
Route::post('/register', [UsuariController::class, 'register'])->name('usuari.registre');

Route::get('/login', [UsuariController::class,'showLogin'])->name('login');
Route::post('/login', [UsuariController::class, 'login']);
Route::get('/quisom', [UsuariController::class, 'SobreNosotros'])->name('sobre-nosotros');
Route::get('/Home', [UsuariController::class, 'Home'])->name('Home');

Route::get('/quisom', function () {
    return view('quiSom.quisom');
});
Route::get('/logout', [UsuariController::class,'logout'])->name('logout');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/', function ($id) {
//         $user = Auth::user();

Route::get('/musics', function () {
    return view('musics.musics');
})->name('musics.musics');

Route::get('/musics{id}', function ($id, $nom) {
    return view('musics.musics', ['id' => $id, 'nom' => $nom]);
});

Route::get('/music', function () {
    return view('music.music');
});

// Route::get('/music/{id}', function () {

//     $musics = Music::with(['user', 'multimedia'])->get();

//     return view('music.music');
// });

Route::get('/music/{id}', function ($id) {
    $music = Music::with(['user', 'multimedia_music'])->findOrFail($id);
    return view('music.music', compact('music'));
});

Route::get('/locals', function () {
    return view('locals.locals');
})->name('locals.locals');

Route::get('/gestion_usuario', function () {
    return view('gestion.gestionUsuarios');
})->name('gestion.gestionUsuarios');


Route::get('/local/{id}', function ($id) {
    $local = Local::with(['multimedia_local'])->findOrFail($id);
    return view('local.local', ['id' => $id], compact('local'));
});

Route::get('/mapa', function () {
    return view('mapes.mapboxFooter');
});
