<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugrequests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('projectName');
            $table->string('ItemName');
            $table->string('quantity');
            $table->string('unit');
            $table->string('Category');
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
        Schema::dropIfExists('drugrequests');
    }
}
