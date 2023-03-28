<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrytoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('base');
            $table->string('quote');
            $table->string('type');
            $table->string('category');
            $table->string('chart_type');
            $table->string('leverage');
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
        Schema::dropIfExists('cryto_lists');
    }
}
