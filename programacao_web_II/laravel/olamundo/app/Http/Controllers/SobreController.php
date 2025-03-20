<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreController extends Controller
{
    public function sobre(){
        $framework = 'Laravel';
        $metodologia = 'MVC';
        return view('sobre',compact('framework','metodologia'));
    }
}