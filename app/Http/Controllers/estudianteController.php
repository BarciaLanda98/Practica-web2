<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estudiante;
use Illuminate\Support\Facades\Log;

class estudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     /**
      * @OA\Get(
        *     path="/api/estudiantes",
        *     summary="Lista de estudiantes",
        *     @OA\Response(
        *         response=200,
        *         description="Lista obtenida correctamente"
        *     )
        * )

      */


    public function index()
    {
        $estudiantes = estudiante::with('paralelo')->get();

        $resultado = $estudiantes->map(function ($est) {
            return [
                'id' => $est->id,
                'nombre' => $est->nombre,
                'cedula' => $est->cedula,
                'correo' => $est->correo,
                'paralelo' => $est->paralelo->nombre ?? null,
            ];
        });

        return response()->json($resultado);
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * @OA\Post(
     *     path="/api/estudiantes",
     *     summary="Crear estudiante",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "cedula", "correo", "paralelo_id"},
     *             @OA\Property(property="nombre", type="string", example="Juan Perez"),
     *             @OA\Property(property="cedula", type="string", example="1234567890"),
     *             @OA\Property(property="correo", type="string", example="juan.perez@example.com"),
     *             @OA\Property(property="paralelo_id", type="integer", example=1),
     *         ),
     *     ),
     *     @OA\Parameter(
     *         name="Accept",
     *         in="header",
     *         required=true,
     *         @OA\Schema(type="string", example="application/json"),
     *         description="Indica que se espera una respuesta en formato JSON"
     *     ),
     *    @OA\Response(response=201, description="Estudiante creado exitosamente"),
     *    @OA\Response(response=422, description="Errores de validación")
     * )
     */

    public function store(Request $request)
    {
        Log::info('Intentando crear estudiante', $request->all());
        $request->validate([
            'nombre' => 'required|string|max:100',
            'cedula' => 'required|string|max:10|unique:estudiantes',
            'correo' => 'required|email|max:100',
            'paralelo_id' => 'required|exists:paralelos,id',
        ]);
        $estudiante = estudiante::create($request->all());
        Log::info('Estudiante creado con ID: ' . $estudiante->id);
        return response()->json([
            'mensaje' => 'Estudiante creado exitosamente',
            'estudiante' => $estudiante
        ], 201);
    }


    /**
     * @OA\Get(
     *     path="/api/estudiantes/{id}",
     *     summary="Mostrar estudiante es especifico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del estudiante"
     *     ),
     *     @OA\Response(response=200, description="Estudiante encontrado"),
     *     @OA\Response(response=404, description="Estudiante no encontrado")
     * )
     */
    public function show($id){ 
        $estudiante = estudiante::with('paralelo')->find($id);

        if (!$estudiante) {
            return response()->json(['mensaje' => 'Estudiante no encontrado'], 404);
        }

        return response()->json([
            'id' => $estudiante->id,
            'nombre' => $estudiante->nombre,
            'cedula' => $estudiante->cedula,
            'correo' => $estudiante->correo,
            'paralelo' => $estudiante->paralelo->nombre ?? null,
        ]);
    }


    /**
     * @OA\Put(
     *     path="/api/estudiantes/{id}",
     *     summary="Actualizar estudiante",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del estudiante"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "cedula", "correo", "paralelo_id"},
     *             @OA\Property(property="nombre", type="string", example="Juan Perez"),
     *             @OA\Property(property="cedula", type="string", example="1234567890"),
     *             @OA\Property(property="correo", type="string", example="juan.perez@example.com"),
     *             @OA\Property(property="paralelo_id", type="integer", example=1),
     *         ),
     *     ),
     *     @OA\Response(response=200, description="Estudiante actualizado exitosamente"),
     *     @OA\Response(response=404, description="Estudiante no encontrado"),
     *     @OA\Response(response=422, description="Errores de validación")
     * )
     */
    public function update(Request $request, $id)
    {
        $estudiante = estudiante::find($id);
        if (!$estudiante) {
            return response()->json(['mensaje' => 'Estudiante no encontrado'], 404);
        }
        $request->validate([
            'nombre' => 'required|string|max:100',
            'cedula' => 'required|string|max:10|unique:estudiantes,cedula,' . $estudiante->id,
            'correo' => 'required|email|max:100',
            'paralelo_id' => 'required|exists:paralelos,id',
        ]);
        $estudiante->update($request->all());
        
        return response()->json([
            'mensaje' => 'Estudiante actualizado exitosamente',
            'estudiante' => $estudiante
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/estudiantes/{id}",
     *     summary="Eliminar estudiante",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del estudiante"
     *     ),
     *     @OA\Response(response=200, description="Estudiante eliminado exitosamente"),
     *     @OA\Response(response=404, description="Estudiante no encontrado")
     * )
     */
    public function destroy($id)
    {
        $estudiante = estudiante::find($id);
        if (!$estudiante) {
            return response()->json(['mensaje' => 'Estudiante no encontrado'], 404);
        }
        $estudiante->delete();
        return response()->json(['mensaje' => 'Estudiante eliminado exitosamente']);
    }
}