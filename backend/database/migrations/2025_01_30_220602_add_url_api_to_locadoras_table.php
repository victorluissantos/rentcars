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
        Schema::table('locadoras', function (Blueprint $table) {
            $table->string('url_api')->nullable(); // Adicionando a coluna url_api
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('locadoras', function (Blueprint $table) {
            $table->dropColumn('url_api'); // Remover a coluna url_api, caso precise reverter a migration
        });
    }

};
