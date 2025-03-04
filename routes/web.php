<?php

use App\Http\Controllers\UsuariController;
use Illuminate\Support\Facades\Route;

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
    return view('proves.index');
});


Route::get('/register', [UsuariController::class,'showRegister'])->name('register');
Route::post('/register', [UsuariController::class, 'register'])->name('usuari.registre');

Route::get('/login', [UsuariController::class,'showLogin'])->name('login');
Route::post('/login', [UsuariController::class, 'login']);
Route::get('/locales', [UsuariController::class, 'SobreNosotros'])->name('sobre-nosotros');
Route::get('/Home', [UsuariController::class, 'Home'])->name('Home');

Route::get('/quisom', function () {
    return view('quiSom.quisom');
});
Route::post('', [UsuariController::class,''])->name('logout');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/', function ($id) {
//         $user = Auth::user();

Route::get('/musics', function () {
    return view('musics.musics');
});

Route::get('/music', function () {
    return view('music.music');
});

Route::get('/locals', function () {
    return view('locals.locals');
});

Route::get('/local', function () {
    return view('local.local');
});

Route::get('/mapa', function () {
    return view('mapes.mapboxFooter');
});
