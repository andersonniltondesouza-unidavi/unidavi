<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servidor;
use App\Models\emails;

class ContatoController extends Controller
{
    public function index()
    {
        $servidor = new servidor();
        $emails = new emails();
        $data['emails'] = $emails->getEmails();
        $data['script'] = $servidor->getAtributo('SCRIPT_NAME');
        $data['datahora'] = $servidor->getDatahora();
        return view('contato',$data);
    }
}