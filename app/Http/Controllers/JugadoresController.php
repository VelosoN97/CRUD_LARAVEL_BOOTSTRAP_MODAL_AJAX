<?php

namespace App\Http\Controllers;

use App\Models\Jugadores;
use Illuminate\Http\Request;
use Validator;

class JugadoresController extends Controller
{
    public function index(){
        return view('jugador.index');
    }

    public function fetchjugador(){
        $jugadores = Jugadores::all();
        return response()->json([
            'jugadores' => $jugadores
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:191',
            'email' => 'required|email|max:191',
            'fecha_nac' => 'required|date',
            'equipo' => 'required|max:191',
            'posicion' => 'required|max:191'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $jugador = new Jugadores;
            $jugador->nombre = $request->input('nombre');
            $jugador->email = $request->input('email');
            $jugador->fecha_nac = $request->input('fecha_nac');
            $jugador->equipo = $request->input('equipo');
            $jugador->posicion = $request->input('posicion');
            $jugador->save();
            return response()->json([
                'status' => 200,
                'message' => 'Jugador/a agregado correctamente'
            ]);
        }
      
    }

    public function editar($id){
        $jugador = Jugadores::find($id);
        if($jugador){
            return response()->json([
                'status' => 200,
                'jugador' => $jugador
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Jugador/a no encontrado'
            ]);
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:191',
            'email' => 'required|email|max:191',
            'fecha_nac' => 'required|date',
            'equipo' => 'required|max:191',
            'posicion' => 'required|max:191'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $jugador = Jugadores::find($id);
            if($jugador){
                $jugador->nombre = $request->input('nombre');
                $jugador->email = $request->input('email');
                $jugador->fecha_nac = $request->input('fecha_nac');
                $jugador->equipo = $request->input('equipo');
                $jugador->posicion = $request->input('posicion');
                $jugador->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Jugador/a actualizado correctamente'
                ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Jugador/a no encontrado'
            ]);
        }            
        }
    }   

    public function eliminar($id){
        $jugador = Jugadores::find($id);
        $jugador->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Jugador/a eliminado de los registros'
        ]);
    }
}
