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
        Schema::create('article_commande', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('commande_id')->nullable(true)->constrained('commandes')->onDelete('cascade');
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade');
		    $table->string('designation');
            $table->double('pa');
            $table->double('remise');
            $table->integer('quantite');
            $table->double('remise_utilisateur');
            $table->double('prix_net');
            $table->double('total');
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
        Schema::dropIfExists('article_commande');
    }
};
