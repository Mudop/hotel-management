<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Página de inicio
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home', ['title' => 'Página de Inicio']);
    }

    /**
     * Panel principal del usuario autenticado
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('dashboard', ['title' => 'Panel de Usuario']);
    }
}
