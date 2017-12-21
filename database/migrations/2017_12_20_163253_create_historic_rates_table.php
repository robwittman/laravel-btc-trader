<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historic_rates', function (Blueprint $table) {
            $table->integer('time');
            $table->decimal('low', 8, 2);
            $table->decimal('high', 8, 2);
            $table->decimal('open', 8, 2);
            $table->decimal('close', 8, 2);
            $table->decimal('volume', 8, 2);
            $table->primary('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historic_rates');
    }
}
