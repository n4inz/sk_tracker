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
        Schema::create('pertanyaan_jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pertanyaans_id');
            $table->string('jawaban');

            $table->foreign('pertanyaans_id')
            ->references('id')->on('pertanyaans');
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
        Schema::dropIfExists('pertanyaan_jawabans');
    }
};
