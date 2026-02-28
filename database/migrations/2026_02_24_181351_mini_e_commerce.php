<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id("id");
            $table->string('nome_categoria', length: 100);
            $table->timestamps();
        });

        Schema::create('produtos', function (Blueprint $table) {
            $table->id("id");
            $table->foreignId('id_categoria')->references('id')->on('categorias');
            $table->string('nome_produto', length: 50);
            $table->string('descricao', length: 255);
            $table->float('valor', 2);
            $table->timestamps();
        });

        Schema::create('pedidos', function (Blueprint $table) {
            $table->id("id");
            $table->float('valor', 2);
            $table->timestamps();
        });
        Schema::create('itens', function (Blueprint $table) {
            $table->id("id");
            $table->foreignId('id_produto')->references('id')->on('produtos');
            $table->foreignId('id_pedido')->references('id')->on('pedidos');
            $table->integer("quantidade");
            $table->timestamps();
        });


    }

    public function down(): void
    {
    }
};