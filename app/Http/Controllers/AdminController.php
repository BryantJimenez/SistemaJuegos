<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $uso=Product::where('estado_fisico', 'En uso')->count();
        $danadoUso=Product::where('estado_fisico', 'Dañado en uso')->count();
        $danadoDesuso=Product::where('estado_fisico', 'Dañado en desuso')->count();
        $abandonado=Product::where('estado_fisico', 'Abandonado')->count();
        return view('admin.home', compact('uso', 'danadoUso', 'danadoDesuso', 'abandonado'));
    }
}
