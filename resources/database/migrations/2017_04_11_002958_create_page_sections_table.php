<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('form_element_name');
            $table->string('form_element_label');
            $table->smallInteger('delta');
            $table->binary('data')->nullable();
            $table->Integer('pages_id')->unsigned();
            $table->timestamps();

            $table->foreign('pages_id')->references('id')->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_sections');
    }
}
