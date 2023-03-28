<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_lists', function (Blueprint $table) {
            $table->id();
            $table->string('currencyId');
            $table->string('symbol');
            $table->string('fullName');
            $table->string('coinName');
            $table->string('algorithm');
            $table->string('proofType');
            $table->string('url');
            $table->string('source');
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
        Schema::dropIfExists('coin_lists');
    }
}
