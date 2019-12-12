<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums_pictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('picture_id');
            $table->unsignedBigInteger('album_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('cascade');;
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');;
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
        Schema::dropIfExists('albums_pictures');
    }
}
