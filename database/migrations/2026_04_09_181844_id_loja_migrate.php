<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->foreignId('id_loja')->references('id')->on('lojas');
        });
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreignId('id_loja')->references('id')->on('lojas');
        });
        Schema::table('itens', function (Blueprint $table) {
            $table->foreignId('id_loja')->references('id')->on('lojas');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['id_loja']);
            $table->dropColumn('id_loja');
        });
        Schema::table('itens', function (Blueprint $table) {
            $table->dropForeign(['id_loja']);
            $table->dropColumn('id_loja');
        });
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['id_loja']);
            $table->dropColumn('id_loja');
        });
    }
};
