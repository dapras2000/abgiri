<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->string('id');
            $table->string('title');
            $table->string('slug');
            $table->longtext('description');
            $table->string('image')->nullable();
            $table->string('category');
            $table->string('status');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('category')->references('id')->on('categories')->onDelete('restrict');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
