<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('match_id');
            $table->integer('yellowCards');
            $table->integer('redCards');
            $table->integer('penalties');
            $table->integer('faults');
            $table->integer('corners');
            $table->integer('freekicks');
            $table->integer('shots');
            $table->integer('offsides');
            $table->integer('passes');
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
        Schema::dropIfExists('stats');
    }
}
