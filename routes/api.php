<?php

use App\Models\Music;
use Illuminate\Http\Request;
use App\Models\TipoMultimedia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\RolUserController;
use App\Http\Controllers\Api\TipusMultimedia;
use App\Http\Controllers\Api\LocalsController;
use App\Http\Controllers\Api\MusicsController;
use App\Http\Controllers\Api\UsuarisController;
use App\Http\Controllers\Api\MultimediaController;
use App\Http\Controllers\Api\PropietariController;
use App\Http\Controllers\Api\TipusLocalController;
use App\Http\Controllers\Api\EstilMusicaController;
use App\Http\Controllers\Api\MultimediaLocalController;
use App\Http\Controllers\Api\MultimediaMusicController;

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
Route::apiResource('multimedia',MultimediaController::class);
Route::apiResource('propietari',PropietariController::class);
Route::get('propietari/local/{id_local}', [PropietariController::class, 'byLocal']);
Route::get('propietari/user/{id_user}', [PropietariController::class, 'byUser']);
Route::apiResource('multimediaMusic',MultimediaMusicController::class);
Route::apiResource('multimediaLocal',MultimediaLocalController::class);
Route::apiResource('tipusMultimedia',TipusMultimedia::class);
Route::apiResource('chat',ChatController::class);


Route::middleware('auth:sanctum')->group(function() {
    // Rutas de chat
    Route::get('/chat', [ChatController::class, 'index']); // Listar conversaciones
    Route::get('/chat/{id_interlocutor}', [ChatController::class, 'show']); // Ver mensajes con un usuario
    Route::post('/chat', [ChatController::class, 'store']); // Enviar mensaje
    Route::delete('/chat/{id_chat}', [ChatController::class, 'destroy']); // Eliminar mensaje
    Route::put('/chat/leidos/{id_propietario}/{id_music}', [ChatController::class, 'marcarComoLeidos']);
    Route::get('/chat/usuarios/disponibles', [ChatController::class, 'getUsuariosDisponibles']);
});
