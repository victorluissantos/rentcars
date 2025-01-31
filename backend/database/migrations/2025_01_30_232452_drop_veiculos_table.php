<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('veiculos');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('categoria', ['Econômico', 'Sedan', 'Hatch', 'SUV']);
            $table->decimal('preco', 8, 2); // 2 casas decimais
            $table->foreignId('locadora_id')->constrained('locadoras'); // FK para locadoras
            $table->timestamps();
        });
    }
};
