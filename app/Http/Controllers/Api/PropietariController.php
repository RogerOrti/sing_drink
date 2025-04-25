<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PropietariResource;
use App\Models\MultimediaLocal;
use App\Models\Propietari;
use App\Models\Local;
use App\Models\Usuari;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PropietariController extends Controller
{


    public function index()
    {
        $propietaris = Propietari::with(['usuari', 'local'])->get();
        return PropietariResource::collection($propietaris);
    }

    public function byLocal($id_local)
    {
        $propietaris = Propietari::with('usuari')
                        ->where('id_local', $id_local)
                        ->get();

        return $propietaris->isEmpty()
            ? response()->json(['message' => 'No se encontraron propietarios para este local'], 404)
            : PropietariResource::collection($propietaris);
    }

    public function byUser($id_user)
    {
        $propietaris = Propietari::with('local')
                        ->where('id_user', $id_user)
                        ->get();

        return $propietaris->isEmpty()
            ? response()->json(['message' => 'Usuario no es propietario de ningún local'], 404)
            : PropietariResource::collection($propietaris);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:user,id_user',
            'id_local' => 'required|exists:local,id_local'
        ]);

        $propietari = Propietari::create($validated);

        return response()->json([
            'message' => 'Propietario creado exitosamente',
            'data' => new PropietariResource($propietari)
        ], 201);
    }

    /**
     * Display the specified propietari
     */
    public function show($id_user, $id_local)
    {
        try {
            $propietari = Propietari::with(['usuari', 'local.tipoLocal', 'local.multimedia'])
                ->where('id_user', $id_user)
                ->where('id_local', $id_local)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $propietari
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Propietario no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified propietari in storage
     */
    public function update(Request $request, $id_user, $id_local)
    {

    }

    /**
     * Remove the specified propietari from storage
     */
    public function destroy($id_user, $id_local)
    {
        DB::beginTransaction();

        try {
            $propietari = Propietari::where('id_user', $id_user)
                ->where('id_local', $id_local)
                ->firstOrFail();

            MultimediaLocal::where('id_local', $id_local)->delete();

            $propietari->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Propietario eliminado correctamente'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el propietario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
