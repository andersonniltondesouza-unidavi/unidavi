<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class servidor extends Model
{
    public function getAtributo ($atributo) {
        return $_SERVER[$atributo];
    }
    
    public function getDatahora () {
        return date('d/m/Y H:i:s');
    }
} 
