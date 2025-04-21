<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato; // Import the Contato model

class ContatosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all contacts from the database
        $contatos = Contato::all();

        // Return the view with the contacts data
        return view('contatos.index', compact('contatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new contact
        return view('contatos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ]);

        // Create a new contact
        $contato = new Contato();
        $contato->nome = $request->input('nome');
        $contato->email = $request->input('email');
        $contato->telefone = $request->input('telefone');
        $contato->cidade = $request->input('cidade');
        $contato->estado = $request->input('estado');
        if ($contato->save()) {
            // If the contact is saved successfully, redirect to the index page
            return redirect()->route('contatos.index')->with('success', 'Contato criado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the contact by ID
        $contato = Contato::findOrFail($id);

        // Return the view with the contact data
        return view('contatos.show', compact('contato'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contato = Contato::findOrFail($id);
        return view('contatos.edit', compact('contato'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ]);

        // Create a new contact
        $contato = Contato::findOrFail($id);
        $contato->nome = $request->input('nome');
        $contato->email = $request->input('email');
        $contato->telefone = $request->input('telefone');
        $contato->cidade = $request->input('cidade');
        $contato->estado = $request->input('estado');
        if ($contato->save()) {
            // If the contact is saved successfully, redirect to the index page
            return redirect()->route('contatos.index')->with('success', 'Contato criado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contato = Contato::FindorFail($id);
        if ($contato->delete()) {
            return redirect()->route("contatos.index")->with('sucess', 'Contato excluído');
        }
    }
}
