<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVerifySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_verify_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('verify_name');
            $table->string('verify_surname');
            $table->string('verify_kind');
            $table->string('verify_image');
            $table->string('verify_approved');
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
        Schema::dropIfExists('user_verify_settings');
    }
}
