<?php
namespace App\Http\Controllers\Api;

use App\Models\Chat;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    /**
     * Obtener todas las conversaciones del usuario autenticado
     */
        public function index()
        {
            $chats = Chat::with(['propietari', 'music'])->get();
            return response()->json($chats);
        }


        public function show($id_propietari, $id_music)
        {
            $conversacion = Chat::where(function($query) use ($id_propietari, $id_music) {
                                $query->where('id_propietari', $id_propietari)
                                    ->where('id_music', $id_music);
                            })
                            ->orWhere(function($query) use ($id_propietari, $id_music) {
                                $query->where('id_propietari', $id_music)
                                    ->where('id_music', $id_propietari);
                            })
                            ->with(['propietari', 'music'])
                            ->get();

                            return response()->json($conversacion);

        }


        public function store(Request $request)
        {
            // Log para verificar los datos recibidos
            Log::info('Datos recibidos para almacenar mensaje:', $request->all());
        
            try {
                // Crear el mensaje en el modelo Chat
                $chat = Chat::create([
                    'id_propietari' => $request->id_propietari,
                    'id_music' => $request->id_music,
                    'missatge' => $request->missatge,
                    'enviat' => true,
                ]);
        
                Log::info('Mensaje creado correctamente:', $chat->toArray());
        
                // Devolver el mensaje con los datos relacionados
                return response()->json(new ChatResource($chat->load(['propietari', 'music'])), 201);
            } catch (\Exception $e) {
                // Manejo de errores con un registro en los logs
                Log::error('Error al crear mensaje:', ['error' => $e->getMessage()]);
        
                return response()->json([
                    'success' => false,
                    'message' => 'Error al almacenar el mensaje',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
        
    /**
     * Eliminar un mensaje
     */
    public function destroy($id_chat)
    {
        try {
            $user = Auth::user();
            $chat = Chat::findOrFail($id_chat);

            // Verificar que el usuario es el propietario del mensaje
            if ($chat->id_propietari != $user->id_user) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autorizado para eliminar este mensaje'
                ], 403);
            }

            $chat->delete();

            return response()->json([
                'success' => true,
                'message' => 'Mensaje eliminado correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar mensaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener usuarios disponibles para chatear
     */
    public function getUsuariosDisponibles()
    {
        try {
            $user = Auth::user();

            if ($user->id_rol == 3) { // 1 = propietario
                $usuarios = Usuari::where('id_rol', 2) // 2 = músico
                    ->where('id_user', '!=', $user->id_user)
                    ->get();
            } else {
                $usuarios = Usuari::where('id_rol', 1)
                    ->where('id_user', '!=', $user->id_user)
                    ->get();
            }

            return response()->json([
                'success' => true,
                'data' => $usuarios
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener usuarios disponibles',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
