<?php

namespace App\Http\Controllers;
use DB;
use Session;
use auth;
use Illuminate\Http\Request;
use App\mensaje;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class xatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salas = DB::table('sala')->get();
        $usuarios = DB::table('users')->where('id', Auth::user()->id)->get();

        return view('servicios.xat',compact('salas','usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $db = new Mensaje;
        $db -> id_sala = $request -> sala;
        $db -> descripcion = $request -> descripcion;
        $db -> id_usuario = Auth::user()->id;
        $db -> save();

        $response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully',
        );
        $data= $request->sala;

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dbquery = DB::table('mensajes')
            ->join('users', function($join)
            {
                $join->on('mensajes.id_usuario', '=', 'users.id');
            })
            ->select('name', 'descripcion')
            ->where('id_sala', $id)
            ->get();
        //$dbquery = DB::select("SELECT m.id_sala, u.name, m.descripcion FROM mensajes m, users u WHERE u.id = m.id_usuario and id_sala = '$id'");

        return json_encode($dbquery);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id, str $mensaje
     * @return \Illuminate\Http\Response
     */
    public function crearMensaje($id, $mensaje)
    {
        $db = new mensaje;
        $db -> id_sala = $id;
        $db -> descripcion = $mensaje;
        $db -> id_usuario = Auth::user()->id;
        $db -> save();

        $response = array(
            'status' => 'success',
            'msg' => 'created successfully',
        );
        return $response;
    }
}
