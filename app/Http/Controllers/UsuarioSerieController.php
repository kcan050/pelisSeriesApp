<?php

namespace App\Http\Controllers;

use App\Models\UsuarioSerie;
use Illuminate\Http\Request;

class UsuarioSerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function __construct(){
         
          $this->middleware('bloquear')->only('index','create','store','show','edit','update','destroy');
         
         
     }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsuarioSerie  $usuarioSerie
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioSerie $usuarioSerie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsuarioSerie  $usuarioSerie
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuarioSerie $usuarioSerie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsuarioSerie  $usuarioSerie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsuarioSerie $usuarioSerie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsuarioSerie  $usuarioSerie
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsuarioSerie $usuarioSerie)
    {
        //
    }
}
