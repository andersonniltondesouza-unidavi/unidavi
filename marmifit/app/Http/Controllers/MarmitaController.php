<?php

namespace App\Http\Controllers;
use App\Models\Marmitas;

use Illuminate\Http\Request;

class MarmitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $marmitas = Marmitas::all();
        $q = null;

        return view('marmitas.index', compact('marmitas','q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marmitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'tamanho' => 'required|string|max:50',
            'imagem' => 'required|image|max:2048',
        ]);

        // Create a new marmita
        $marmita = new Marmitas();
        $marmita->nome = $request->input('nome');
        $marmita->descricao = $request->input('descricao');
        $marmita->preco = $request->input('preco');
        $marmita->tamanho = $request->input('tamanho');
        $marmita->save();

        if ($request->hasFile('imagem')) {
            $filename = 'marmita_' . $marmita->id . '.' . $request->file('imagem')->getClientOriginalExtension();
            $request->file('imagem')->move(public_path('images/marmitas'), $filename);
            }

        if ($marmita->save()) {
            return redirect()->route('marmitas.index')->with('success', 'Marmita adicionada com sucesso!');
        }
    }
}
