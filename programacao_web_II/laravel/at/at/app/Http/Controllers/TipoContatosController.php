<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoContato; // Import the TipoContato model

class TipoContatosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all contact types from the database
        $tipocontatos = TipoContato::all();

        // Return the view with the contact types data
        return view('tipocontatos.index', compact('tipocontatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new contact type
        return view('tipocontatos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string|max:80',
        ]);

        // Create a new contact type
        $tipocontato = new TipoContato();
        $tipocontato->nome = $request->input('nome');
        $tipocontato->descricao = $request->input('descricao');
        // Save the contact type to the database
        // Note: The 'descricao' field is optional and can be null
        if ($tipocontato->save()) {
            // If the contact type is saved successfully, redirect to the index page
            return redirect()->route('tipocontatos.index')->with('success', 'Tipo de contato criado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipocontato = TipoContato::findOrFail($id);
        return view('tipocontatos.edit', compact('tipocontato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string|max:80',
        ]);

        // Find the contact type by ID
        $tipocontato = TipoContato::findOrFail($id);

        // Update the contact type
        $tipocontato->nome = $request->input('nome');
        $tipocontato->descricao = $request->input('descricao');
        // Save the updated contact type to the database
        if ($tipocontato->save()) {
            // If the contact type is updated successfully, redirect to the index page
            return redirect()->route('tipocontatos.index')->with('success', 'Tipo de contato atualizado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the contact type by ID
        $tipocontato = TipoContato::findOrFail($id);

        // Delete the contact type from the database
        if ($tipocontato->delete()) {
            // If the contact type is deleted successfully, redirect to the index page
            return redirect()->route('tipocontatos.index')->with('success', 'Tipo de contato excluído com sucesso!');
        }
    }
}
