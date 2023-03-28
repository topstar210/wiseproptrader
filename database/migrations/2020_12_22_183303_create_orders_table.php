<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('kind');
            $table->string('ticket');
            $table->string('base_symbol');
            $table->float('trade_amount');
            $table->string('quote_symbol');
            $table->decimal('open_rate', 11, 5);
            $table->decimal('close_rate', 11, 5);
            $table->decimal('pro_loss', 11, 5);
            $table->string('status');
            $table->string('open_time');
            $table->string('close_time');
            $table->string('type');
            $table->float('profit');
            $table->float('loss');
            $table->integer('profit_switch');
            $table->integer('loss_switch');
            $table->integer('leverage');
            $table->decimal('fee', 10, 5);
            $table->integer('is_daily_loss_pass')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
