<?php

namespace App\Http\Controllers;

use App\Models\Jogadores;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Jogador;
use App\Models\Times;
use finfo;

class JogadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jogadores = Jogadores::all();
        $q = null;
        
        return view('jogadores.index', compact('jogadores','q',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $times = Times::all();
        $jogadores = new Jogadores();
        return view('jogadores.create', compact('times','jogadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'id' => 'required|string|max:14|unique:jogadores,id', 
        'nome' => 'required|string|max:255',
        'data_nascimento' => 'required|date',
        'posicao' => 'required|string|max:30',
        'time_id' => 'required|exists:times,id', 
    ]);

    // Insert a new player
    $jogadores = new Jogadores();
    $jogadores->id = $request->input('id');
    $jogadores->nome = $request->input('nome');
    $jogadores->data_nascimento = $request->input('data_nascimento');
    $jogadores->posicao = $request->input('posicao');
    $jogadores->time_id = $request->input('time_id');

    if ($jogadores->save()) {
        return redirect()->route('jogadores.index')->with('success', 'Jogador adicionado com sucesso!');
    } else {
        return back()->with('error', 'Erro ao salvar jogador.')->withInput();
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jogadores = Jogadores::findOrFail($id);
        return view('jogadores.show', compact('jogadores'));
    }

    public function search(Request $request)
    {
        $q=$request->input('q');
        // Search for contacts based on the search input
        $jogadores = Jogadores::where('nome', 'like', '%' . $request->input('q') . '%')
            ->orWhere('posicao', 'like', '%' . $request->input('q') . '%')
            ->orWhere('id', 'like', '%' . $request->input('q') . '%')
            ->get();

        // Return the view with the search results
        return view('jogadores.index', compact('jogadores', 'q'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jogadores = Jogadores::findOrFail($id);
        $times = Times::all();
        return view('jogadores.edit', compact('jogadores','times'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {([
        'id' => 'required|string|max:14|unique:jogadores,id', 
        'nome' => 'required|string|max:255',
        'data_nascimento' => 'required|date',
        'posicao' => 'required|string|max:30',
        'time_id' => 'required|exists:times,id', 
    ]);

    // Insert a new player
    $jogadores = Jogadores::findOrFail($id); 
    $jogadores->id = $request->input('id');
    $jogadores->nome = $request->input('nome');
    $jogadores->data_nascimento = $request->input('data_nascimento');
    $jogadores->posicao = $request->input('posicao');
    $jogadores->time_id = $request->input('time_id');

    if ($jogadores->save()) {
        return redirect()->route('jogadores.index')->with('success', 'Jogador adicionado com sucesso!');
    } else {
        return back()->with('error', 'Erro ao salvar jogador.')->withInput();
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jogador = Jogadores::FindorFail($id);
        if ($jogador->delete()) {
            return redirect()->route("jogadores.index")->with('sucess', 'Jogador excluído');
        }
    }
}
