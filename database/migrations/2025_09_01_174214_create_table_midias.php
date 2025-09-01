<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('midias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('categoria', ['Filme', 'Serie']);
            $table->text('descricao')->nullable();
            $table->boolean('assistido')->default(false);
            $table->boolean('baixado')->default(false);
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('midias');
    }
};