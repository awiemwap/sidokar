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
        Schema::create('dokumenunits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis_dokumen', 100);
            $table->string('tahun', 100);
            $table->string('nomor', 100);
            $table->string('rubrik', 100);
            $table->string('unit', 100);
            $table->string('tujuan', 100);
            $table->string('perihal', 500);
            $table->string('nominal', 500);
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
        Schema::dropIfExists('dokumenunits');
    }
};
