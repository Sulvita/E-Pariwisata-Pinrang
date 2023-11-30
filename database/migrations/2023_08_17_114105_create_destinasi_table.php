<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('HargaTiket')->nullable();
            $table->string('FasilitasDestinasi')->nullable();
            $table->string('JamBuka')->nullable();
            $table->text('Deskripsi')->nullable();
            $table->text('Sejarah')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->float('latitude', 10, 6);
            $table->float('longitude', 10, 6);
            $table->string('MenuKuliner')->nullable();
            $table->text('sampul')->nullable();
            $table->text('gambar')->nullable(); 
            $table->string('kategori');
            $table->float('latitudepenginapan', 10, 6)->nullable();
            $table->float('longitudepenginapan', 10, 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi');
    }
};
