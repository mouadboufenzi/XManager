<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_commande');
            $table->string('code_fournisseur');
            $table->foreignId('id_vehicule')->nullable(true)->constrained('vehicules')->onDelete('cascade');
            $table->foreignId('id_fournisseur')->constrained('fournisseurs')->onDelete('cascade');
            $table->date('date');
            $table->string('portable');
            $table->string('email');
            $table->string('adresse');
            $table->double('remise');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commnades');
    }
};
