<?php

namespace App\Http\Controllers;
use DB;
use Session;
use auth;
use Illuminate\Http\Request;
use App\mensaje;
use App\partida;
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
        $nombres = DB::select("SELECT name, id FROM users where id!='".Auth::user()->id."'");


        return view('servicios.xat',compact('salas','usuarios', 'nombres'));
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
                $dbquery = DB::select("SELECT m.id_sala, u.name, m.descripcion, m.created_at, u.color FROM mensajes m, users u WHERE u.id = m.id_usuario and id_sala = '$id' ORDER BY m.created_at DESC limit 20");
            } else {
                $dbquery = DB::select("SELECT m.id_sala, u.name, m.descripcion, m.created_at, u.color FROM mensajes m, users u WHERE u.id = m.id_usuario and id_sala = '$id' and TIMEDIFF(now(), m.created_at) <= '01:00:00' ORDER BY m.created_at");

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
                $dbquery = DB::select("SELECT m.id_sala, u.name, m.descripcion, m.created_at, u.color FROM mensajes m, users u WHERE u.id = m.id_usuario and id_sala = '$id' and TIMEDIFF(m.created_at, '$fecha') >= '00:00:01' ORDER BY m.created_at");
                return json_encode($dbquery);
            }
        }
    }

    public function crearPartida($id){

        DB::table('partidas')->insert(
            ['id_usu_2' => $id, 'id_usu_1' => Auth::user()->id, 'id_creador' => Auth::user()->id, 'winner' => '']
        );
        $partida = DB::select("SELECT id from partidas where id_creador = ".Auth::user()->id." and winner=''");

        $response = array(
            'status' => 'success',
            'msg' => 'usuario invitado',
            'values' => $partida,
        );

        return $response;
    }

    public function compInvi($id){
        $userid = Auth::user()->id;
        $numbers = DB::select("SELECT count(id) cantidad FROM partidas WHERE (id_usu_1 = ".Auth::user()->id." or id_usu_2 = ".Auth::user()->id.") and winner='' and id_creador!=".Auth::user()->id."");
        foreach ($numbers as $number) {
            if ($number->cantidad > 0) {
                $dbquery = DB::select("SELECT id, id_usu_1, id_usu_2 FROM partidas WHERE (id_usu_1 = ".Auth::user()->id." or id_usu_2 = ".Auth::user()->id.") and winner='' and id_creador!=".Auth::user()->id."");
                $response = array(
                    'status' => 'ok',
                    'userid' => $userid,
                    'data' => $dbquery,
                );

                return $response;
            }
        }
    }

    public function compCreada($id){
        $userid = Auth::user()->id;
        $numbers = DB::select("SELECT count(id) cantidad FROM partidas WHERE winner='' and id_creador=".Auth::user()->id."");
        foreach ($numbers as $number) {
            if ($number->cantidad > 0) {
                $dbquery = DB::select("SELECT id, id_usu_1, id_usu_2 FROM partidas WHERE winner='' and id_creador=".Auth::user()->id."");
                $response = array(
                    'status' => 'ok',
                    'userid' => $userid,
                    'data' => $dbquery,
                );

                return $response;
            }
            else{
                $response = array(
                    'status' => 'no',
                    'userid' => $userid,
                );
                return $response;

            }
        }

    }

    public function crearMov($pos, $idpartida){
        DB::table('movimientos')->insert(
            ['id_partida' => $idpartida, 'posicion' => $pos, 'id_usu' => Auth::user()->id]
        );

        $checkwin = DB::select("Select posicion from movimientos where id_partida = ".$idpartida." and id_usu = ".Auth::user()->id."");

        $response = array(
            'status' => 'success',
            'msg' => 'movimiento creado',
            'values' => $checkwin,
        );

        return $response;
    }

    public function victoria($idpartida){
        DB::update("UPDATE partidas SET winner = ".Auth::user()->id." WHERE partidas.id = ".$idpartida."");
        $response = array(
            'status' => 'success',
            'msg' => 'User '.Auth::user()->id.' win game '.$idpartida,
        );

        return $response;
    }

    public function derrota($idpartida){
        $comprueba=DB::select("Select count(id) cantidad from partidas where winner!=".Auth::user()->id." and winner!='' and id = ".$idpartida."");
        foreach ($comprueba as $number) {
            if ($number->cantidad > 0) {
                $response = array(
                    'status' => 'success',
                    'msg' => 'derrota',
                );
                return $response;
            }
        }

    }

    public function getMov($idpartida){
        $movimientos = DB::select("Select posicion, id_usu from movimientos where id_partida = ".$idpartida."");

        $response = array(
            'status' => 'success',
            'msg' => 'movimientos',
            'values' => $movimientos,
        );
        return $response;
    }

    public function compTurno($idpartida){
        $turno = DB::select("select count(id) cantidad from movimientos where id_partida = ".$idpartida."");
        foreach ($turno as $number) {
            if ($number->cantidad > 0) {
                $turnoquery = DB::select("select id_usu from movimientos where id_partida = ".$idpartida." ORDER BY id DESC LIMIT 1");
            }
            else{
                $turnoquery = DB::select("select id_creador from partidas where id = ".$idpartida."");
            }
        }
        $response = array(
            'status' => 'success',
            'msg' => 'turno',
            'values' => $turnoquery,
        );
        return $response;
    }

    public function primerMov($idpartida){
        $primer = DB::select("select count(id) cantidad from movimientos where id_partida = ".$idpartida."");
        foreach ($primer as $number) {
            if ($number->cantidad > 0) {
                $response = array(
                    'status' => 'success',
                    'msg' => 'now',
                );
                return $response;
            }
        }
    }
}
