<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'nome_cliente',   // Nome do cliente
        'pago',           // Status de pagamento
        'id_loja',        // ID da loja
        'id_user',        // Adicionando o id_user para permitir atribuição em massa
    ];

    public function itens()
    {
        return $this->hasMany(Item::class, 'id_pedido');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function total(): float
    {
        $total = 0;

        foreach ($this->itens as $item) {
            $total += $item->produto->valor * $item->quantidade;
        }

        return $total;
    }
}