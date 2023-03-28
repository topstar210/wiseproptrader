<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value1')->nullable();
            $table->string('value2')->nullable();
            $table->string('value3')->nullable();
            $table->string('value4')->nullable();
            $table->string('value5')->nullable();
            $table->string('value6')->nullable();
            $table->string('value7')->nullable();
            $table->string('value8')->nullable();
            $table->string('value9')->nullable();
            $table->string('value10')->nullable();
            $table->string('value11')->nullable();
            $table->string('value12')->nullable();
            $table->string('value13')->nullable();
            $table->string('value14')->nullable();
            $table->string('value15')->nullable();
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
        Schema::dropIfExists('admin_settings');
    }
}
