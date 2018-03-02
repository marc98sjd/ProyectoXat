<?php

namespace App\Http\Controllers;
use DB;
use Session;
use auth;
use Illuminate\Http\Request;
use App\mensaje;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

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
        /**$dbquery = DB::table('mensajes')
            ->join('users', function($join)
            {
                $join->on('mensajes.id_usuario', '=', 'users.id');
            })
            ->select('name', 'descripcion', 'created_at')   SELECT * FROM `mensajes` WHERE now()-3600 > created_at
            ->where('id_sala', $id)   DESC limit 20
            ->get();**/

        $numbers = DB::select("SELECT count(id) cantidad FROM mensajes WHERE id_sala = '$id' and TIMEDIFF(now(), created_at) <= '01:00:00'");
        foreach ($numbers as $number) {
            if ($number->cantidad == 0) {
                $dbquery = DB::select("SELECT m.id_sala, u.name, m.descripcion, m.created_at FROM mensajes m, users u WHERE u.id = m.id_usuario and id_sala = '$id' ORDER BY m.created_at DESC limit 20");
            } else {
                $dbquery = DB::select("SELECT m.id_sala, u.name, m.descripcion, m.created_at FROM mensajes m, users u WHERE u.id = m.id_usuario and id_sala = '$id' and TIMEDIFF(now(), m.created_at) <= '01:00:00' ORDER BY m.created_at");

            }
        }

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
        $time = Carbon::now()->toDateTimeString();
        $db = new mensaje;
        $db -> id_sala = $id;
        $db -> descripcion = $mensaje;
        $db -> id_usuario = Auth::user()->id;
        $db -> created_at =Carbon::now()->toDateTimeString();
        $db -> save();

        $response = array(
            'status' => 'success',
            'msg' => 'created successfully',
        );
        return $response;
    }

    public function comprobarMensajes($id, $fecha)
    {
        $numbers = DB::select("SELECT count(id) cantidad FROM mensajes WHERE id_sala = '$id' and TIMEDIFF(created_at, '$fecha') >= '00:00:01'");
        foreach ($numbers as $number) {
            if ($number->cantidad > 0) {
                $dbquery = DB::select("SELECT m.id_sala, u.name, m.descripcion, m.created_at FROM mensajes m, users u WHERE u.id = m.id_usuario and id_sala = '$id' and TIMEDIFF(m.created_at, '$fecha') >= '00:00:01' ORDER BY m.created_at");
                return json_encode($dbquery);
            }
        }
    }
}
