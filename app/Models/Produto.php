<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
        protected $fillable = [
            'nome_produto',
            'id_categoria',
            'descricao',
            'valor',
        ];
}
