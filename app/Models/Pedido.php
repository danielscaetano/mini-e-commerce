<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'nome_cliente',
        'pago',
        'id_loja',

    ];

    public function itens()
    {
        return $this->hasMany(Item::class, 'id_pedido');
    }

    public function total(): float
    {
        $total = 0;

        foreach ($this->itens as $item) {
            $total = $total + ($item->produto->valor * $item->quantidade);
        }

        return $total;
    }
}
