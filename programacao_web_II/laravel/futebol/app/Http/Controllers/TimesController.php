<?php

namespace App\Http\Controllers;

use App\Models\Times;
use App\Models\Jogadores;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;

class TimesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $times = Times::all();
        $q = null;
        
        return view('times.index', compact('times','q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('times.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string|max:255',
            'sigla' => 'required|string|max:5',
            'estado' => 'required|string|max:255',
        ]);

        // Create a new team
        $time = new Times();
        $time->nome = $request->input('nome');
        $time->sigla = $request->input('sigla');
        $time->estado = $request->input('estado');
        if ($time->save()) {
            // If the team is saved successfully, redirect to the index page
            return redirect()->route('times.index')->with('success', 'Time adicionado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $time = Times::findOrFail($id);

        return view('times.show', compact('time'));
    }

    public function search(Request $request)
    {
        $q=$request->input('q');
        // Search for contacts based on the search input
        $times = Times::where('nome', 'like', '%' . $request->input('q') . '%')
            ->orWhere('sigla', 'like', '%' . $request->input('q') . '%')
            ->get();

        // Return the view with the search results
        return view('times.index', compact('times', 'q'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $time = Times::findOrFail($id);
        $jogadores = Jogadores::all();
        return view('times.edit', compact('time','jogadores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string|max:255',
            'sigla' => 'required|string|max:5',
            'estado' => 'required|string|max:255',
        ]);

        // Create a new contact
        $time = Times::findOrFail($id);
        // Update the team with the request data
        $time->nome = $request->input('nome');
        $time->sigla = $request->input('sigla');
        $time->estado = $request->input('estado');
        if ($time->save()) {
            // If the team is saved successfully, redirect to the index page
            return redirect()->route('times.index')->with('success', 'Time atualizado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $time = Times::FindorFail($id);
        if ($time->delete()) {
            return redirect()->route("times.index")->with('sucess', 'Time excluído');
        }
    }
}
