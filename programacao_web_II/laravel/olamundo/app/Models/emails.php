<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class emails extends Model
{
    public function getEmails(){
        return ['sandro@unidavi.edu.br','sandro@arealocal.com.br','sandroaf@gmail.com'];
    }
}