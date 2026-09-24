<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
{
    Schema::create('alat_outdoors', function (Blueprint $table) {
        $table->id();
        $table->string('nama_alat');
        $table->integer('harga_sewa');
        $table->string('foto_alat')->nullable();
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('alat_outdoors');
    }
};
