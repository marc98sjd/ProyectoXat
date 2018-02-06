<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class proyectoXatController extends Controller
{
    public function getDenuncia(){
    	return view('servicios.denuncias');
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
}
