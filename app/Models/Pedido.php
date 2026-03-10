<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'nome_cliente', 'pago',
    ];

    public function itens()
    {
        return $this->hasMany(Item::class, 'id_pedido');
    }
}
