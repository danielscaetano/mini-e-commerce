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
        Schema::create('lojas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('users');
            $table->string('nome_loja');
            $table->timestamps();
        });

        Schema::table('categorias', function (Blueprint $table) {
            $table->foreignId('id_loja')->references('id')->on('lojas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lojas');
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropForeign(['id_loja']);
            $table->dropColumn('id_loja');
        });
    }
};
