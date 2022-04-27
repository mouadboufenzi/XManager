<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('famille');
            $table->string('categorie');
            $table->string('status');
            $table->string('raison_social')->nullable('true');
            $table->string('if');
            $table->string('ice');
            $table->string('rc');
            $table->double('patente');
            $table->string('cin');
            $table->string('agent_commercial');
            $table->string('mode_paiement');
            $table->string('nom');
            $table->string('fonction');
            $table->string('email');
            $table->string('fix');
            $table->string('fax');
            $table->string('portable');
            $table->string('adresse');
            $table->string('ville');
            $table->string('pays');
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
        Schema::dropIfExists('clients');
    }
};
