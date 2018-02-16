<?php

namespace App\Http\Controllers;
use Session;
use Auth;
use DB;
use App\denuncias;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;





class proyectoXatController extends Controller
{
    public function getDenuncia(){
        $dbquery = DB::table('denuncias')->where('id_usuario', Auth::user()->id)->get();

        return view('servicios.denuncias',['arrayDenuncias' => $dbquery]);
	}

	public function getNoticias(){
    	return view('servicios.noticias');
	}

	public function getDebates(){
    	return view('servicios.debates');
	}

	public function getXat(){
    	return view('servicios.xat');
	}

    public function store(Request $request)
    {
        //

        $db = new Denuncias;
        $db -> titulo = $request -> input('titulo');
        $db -> descripcion = $request -> input('descripcion');
        $db -> id_usuario = Auth::user()->id;
        $db -> ubicacion = "N/A";
        $ruta = 'img/';
        $unique_name = md5($request->file('imagen'). time());
        $db -> imagen = $request->file('imagen')->move($ruta,$unique_name.'.jpg');
        $db -> save();





        return redirect('servicios/denuncias')->with('message', 'Denuncia creada correctamente!');
    }
    public function update(Request $request)
    {
        //
        DB::table('denuncias')
            ->where('id', $request->input('id'))
            ->update(['comentario' => $request->input('comentario')]);


        return redirect('servicios/denuncias')->with('message', 'Comentario añadido correctamente!');
    }
}
