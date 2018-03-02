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

        if((Auth::user()->is_admin)==1){
            $dbquery = DB::table('denuncias')->get();
        }
        else{
            $dbquery = DB::table('denuncias')->where('id_usuario', Auth::user()->id)->get();
        }


        return view('servicios.denuncias',['arrayDenuncias' => $dbquery]);
	}

	public function getNoticias(){
        
        if((Auth::user()->is_admin)==1){
            $dbquery = DB::table('denuncias')->get();
        }
        else{
            $dbquery = DB::table('denuncias')->where('id_usuario', Auth::user()->id)->get();
        }

    	return view('servicios.noticias',['arrayNoticias' => $dbquery]);
	}

	public function getDebates(){
    	return view('servicios.debates');
	}

	public function getXat(){
        $dbquery = DB::table('sala')->get();


    	return view('servicios.xat',['salas' => $dbquery]);
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

    public function storeNoticia(Request $request)
    {
        //

        $db = new Noticias;
        $db -> titulo = $request -> input('titulo');
        $db -> descripcion = $request -> input('descripcion');
        $db -> id_usuario = Auth::user()->id;
        $ruta = 'img/';
        $unique_name = md5($request->file('imagen'). time());
        $db -> imagen = $request->file('imagen')->move($ruta,$unique_name.'.jpg');
        $db -> save();

        return redirect('servicios/noticias')->with('message', 'Noticia creada correctamente!');
    }

    public function update(Request $request)
    {
        //
        $comentario = $request->input('ultimoComentario');
        $comentario = $comentario.'/'.$request->input('comentario');

        DB::update('update denuncias set comentario = ? where id = ?', [$comentario, $request->input('id')]);

        return redirect('servicios/denuncias')->with('message', 'Comentario añadido correctamente!');
    }

    public function updateNoticia(Request $request)
    {
        //
        $comentario = $request->input('ultimoComentario');
        $comentario = $comentario.'/'.$request->input('comentario');

        DB::update('update noticias set comentario = ? where id = ?', [$comentario, $request->input('id')]);

        return redirect('servicios/noticias')->with('message', 'Comentario añadido correctamente!');
    }


}
