<?php

use App\Http\Controllers\Api\EstilMusicaController;
use App\Http\Controllers\Api\LocalsController;
use App\Http\Controllers\Api\MusicsController;
use App\Http\Controllers\Api\TipusLocalController;
use App\Http\Controllers\Api\UsuarisController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\RolUserController;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/locals/paginado', [LocalsController::class, 'indexPaginado']); // Para las cards
Route::get('/musics/paginado', [MusicsController::class, 'indexPaginado']); // Para las cards
Route::apiResource('locals', LocalsController::class);
Route::apiResource('musics', MusicsController::class);
Route::apiResource('usuaris', UsuarisController::class);
Route::apiResource('tipusLocal', TipusLocalController::class);
Route::apiResource('estilMusica', EstilMusicaController::class);
Route::apiResource('rol',RolUserController::class);
