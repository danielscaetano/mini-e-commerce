<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id("id_categoria");
            $table->timestamps();
            $table->string('nome_categoria', length: 100);

        });
        Schema::create('produtos', function (Blueprint $table) {
            $table->id("id_produto");
            $table->foreignId('id_categoria')->references('id_categoria')->on('categorias');
            $table->timestamps();
            $table->string('nome', length: 100);
            $table->float('valor',2);
        });
        Schema::create('itens', function (Blueprint $table) {
            $table->id("id_item");
            $table->foreignId('id_produto')->references('id_produto')->on('produtos');
            $table->integer("quantidade");
            $table->timestamps();
        });
        Schema::create('pedido', function (Blueprint $table) {
            $table->id("id_pedido");
            $table->foreignId('id_itens')->references('id_iten')->on('item');
            $table->timestamps();
            $table->float('valor',2);

        });
    }

    public function down(): void
    {
    }
};