<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marmitas;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
        {
            $marmitas = Marmitas::all();
            $q = null;

            return view('dashboard', compact('marmitas', 'q'));
        }

}
