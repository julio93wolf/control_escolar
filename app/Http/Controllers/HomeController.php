<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nacionalidad;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nacionalidades = Nacionalidad::get();
        foreach ($nacionalidades as $key => $nacionalidad) {
            echo 'DB::table("nacionalidades")->insert([ "id" => '.$nacionalidad->id.', "nacionalidad" => "'.$nacionalidad->nacionalidad.'" ]);<br>';
        }
        //return view('home');
    }
}
