<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produto', function (Blueprint $table) {
		$table->id();
		$table->string('nome', 50);
		$table->text('descricao')->nullable();
		$table->decimal('preco', 10, 2);
		$table->date('data_validade');
		$table->string('imagem')->unique();
		$table->unsignedBigInteger('categoria_id');
		$table->timestamps();
		$table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto');
    }
};
