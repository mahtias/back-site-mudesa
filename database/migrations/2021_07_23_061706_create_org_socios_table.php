<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgSociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_socios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date("date_debut");
            $table->time("heure_debut");
            $table->date("date_fin");
            $table->time("heure_fin");
            $table->string("objet");
            $table->string("fichier");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('org_socios');
    }
}
