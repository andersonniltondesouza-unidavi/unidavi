<?php

namespace App\Http\Controllers;

use App\Models\avaliarSono;
use Illuminate\Http\Request;

class ResultadoSonoController extends Controller
{
    public function store()
    {
        $idade= new avaliarSono();
        $data['idade'] = $idade->calcularIdade(request('data_nascimento'));
        return view('resultado_sono' , $data);   
    }
}
