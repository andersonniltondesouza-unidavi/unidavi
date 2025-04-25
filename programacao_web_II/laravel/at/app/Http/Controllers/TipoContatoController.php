<?php

namespace App\Http\Controllers;

use App\Models\TipoContato;
use Illuminate\Http\Request;

class TipoContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all contacts from the database
        $tipoContatos = TipoContato::all();

        // Return the view with the contacts data
        return view('tipoContatos.index', compact('tipoContatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new contact
        return view('tipoContatos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        // Create a new contact
        $tipoContato = new TipoContato();
        $tipoContato->nome = $request->input('nome');
        $tipoContato->descricao = $request->input('descricao');
        if ($tipoContato->save()) {
            // If the contact is saved successfully, redirect to the index page
            return redirect()->route('tipoContatos.index')->with('success', 'Tipo contato criado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the contact by ID
        $tipoContato = TipoContato::findOrFail($id);

        // Return the view with the contact data
        return view('tipoContatos.show', compact('tipoContato'));
    }

 /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipoContato = TipoContato::findOrFail($id);
        return view('tipoContatos.edit', compact('tipoContato'));  
    }

   /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        // Create a new contact
        $tipoContato = TipoContato::findOrFail($id);
        $tipoContato->nome = $request->input('nome');
        $tipoContato->descricao = $request->input('descricao');
        if ($tipoContato->save()) {
            // If the contact is saved successfully, redirect to the index page
            return redirect()->route('tipoContatos.index')->with('success', 'Tipo contato atualizado com sucesso!');
        }
    }
/**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipoContato = TipoContato::FindorFail($id);
        if ($tipoContato->delete()) {
            return redirect()->route("tipoContatos.index")->with('sucess', 'Tipo de contato excluído');
        }
    }
}
