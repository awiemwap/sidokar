<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor', 100);
            $table->string('rubrik', 100);
            $table->string('unit', 100);
            $table->string('tujuan', 100);
            $table->string('perihal', 500);
            $table->string('status', 100);
            $table->string('user', 100);
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
        Schema::dropIfExists('surats');
    }
};
