<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{   
    protected $table = 'itens';
    protected $fillable = [
        'id_produto',
        'id_pedido',
    ];

    public function id_produto()
    {
        return $this->belongsTo(Categoria::class, 'id_produto');
    }

    public function id_pedido()
    {
        return $this->belongsTo(Categoria::class, 'id_pedido');
    }
}