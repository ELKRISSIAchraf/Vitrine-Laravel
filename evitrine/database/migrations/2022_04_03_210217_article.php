<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Article extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('image'); 
            $table->double('pu'); 
            $table->text('description'); 
            $table->integer('quantite'); 
            $table->unsignedbigInteger('categorie_id');
            $table->unsignedbigInteger('panier_id');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('panier_id')->references('id')->on('paniers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        
        //
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
        //
    }
}
