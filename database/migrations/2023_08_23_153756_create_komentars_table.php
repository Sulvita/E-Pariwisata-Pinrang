<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 2023_07_30_093314_create_komentars_table.php

class CreateKomentarsTable extends Migration
{
    public function up()
    {
        Schema::create('komentars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destinasi_id')->nullable();
            $table->string('nama');
            $table->text('isi_komentar')->nullable();
            $table->integer('rating')->nullable();
            $table->timestamps();

             $table->foreign('destinasi_id')
                ->references('id')
                ->on('destinasi')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('komentars');
    }
}

