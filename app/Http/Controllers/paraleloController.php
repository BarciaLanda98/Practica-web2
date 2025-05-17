<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paralelo;
use Illuminate\Support\Facades\Log;

class paraleloController extends Controller
{
    //metodos
    //metodo para obtener todos los registros de la tabla
    public function index(){
        return paralelo::all();
    }

    //metodo para almacenar registros en la tabla
    public function store(Request $request){
        Log::info('Datos que llegan en la peticion:',$request->all());
        $request->validate([
            'nombre'=>'required|string|max:100|unique:paralelos'
        ]);

        $paralelo=paralelo::create($request->all());
        Log::info('Paralelo creado con ID:'. $paralelo->id);
        return response()->json([
            'mensaje' => 'Paralelo creado exitosamente',
            'paralelo' => $paralelo  
        ], 201);

    }

    //Mostrar paralelo en especifico

    public function show($id)
    {
        $paralelo = paralelo::find($id);

        if(!$paralelo){
            return response()->json(['mensaje' => 'Paralelo no encontrado'], 420);
        }
        return $paralelo;
    }

    //Actualizar

    public function update(Request $request, $id)
    {
        $paralelo = paralelo::find($id);

        if(!$paralelo){
            return response()->json(['mensaje'=>'Paralelo no encontrado'],420);
        }

        $request->validate([
            'nombre'=>'required|string|max:100|unique:paralelos,nombre,'.$id
        ]);
        
        

        //$paralelo = paralelo::update($request->all());
        $paralelo->update($request->all());


        return response()->json([
            'mensaje' => 'Paralelo actualizado exitosamente',
            'paralelo' => $paralelo
        ]);
    }

    public function destroy($id)
    {
        $paralelo = paralelo::find($id);

        if(!$paralelo){
            return response()->json(['mensaje'=>'Paralelo no encontrado'],404);
        }

        $paralelo->delete();

        return response()->json(['mensaje'=>'Paralelo eliminado exitosamente'],200);
    }


}
