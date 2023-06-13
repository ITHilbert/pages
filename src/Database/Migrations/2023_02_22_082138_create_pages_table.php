<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('url',255)->unique();
            $table->string('category', 20)->default('article'); //main, law, excel, access, usw.
            $table->string('group', 20)->default('main');


            $table->string('layout_view', 255)->default('layouts.app');      //Welche Layout View
            $table->longText('content')->nullable();                                    //Der Inhalt der Seite als HTML Code

            $table->boolean('sitemap_show')->default(true);                         //Soll diese Seite im Index Erscheinen
            $table->float('sitemap_priority')->default(0.6);                        //Sitemap Priorität
            $table->string('sitemap_changefreq', 20)->default('monthly');

            $table->string('meta_title', 255)->nullable();
            $table->string('meta_discription', 255)->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->string('robots', 50)->default('all');

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
        Schema::dropIfExists('pages');
    }
}
