<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteControlador extends Controller
{
   
    // 1ª FORMA de realizar a paginação: Enviando o objeto paginado para dentro de uma view específica
    public function index()
    {
        $clientes = Cliente::paginate(10); // paginate() = cria um objeto $clientes paginado de 10 em 10

        return view('index', compact('clientes'));  // envia o objeto para uma view específica
    }

    // 2ª FORMA de realizar a paginação: Retornando o objeto paginado para quem chamar
    public function indexjs()
    {
        return view('indexjs');
    }

    public function indexjson()
    {
        return Cliente::paginate(10); // retorna diretamente o objeto $clientes paginado de 10 em 10
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
