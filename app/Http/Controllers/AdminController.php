<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Mostrar el panel principal del administrador.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard', ['title' => 'Panel de Administrador']);
    }
}
