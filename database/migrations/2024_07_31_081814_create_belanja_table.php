<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('belanjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_id')
                ->constrained('maintenances')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('belanja_bahan_bakar_minyak')->nullable();
            $table->integer('belanja_pelumas_mesin')->nullable();
            $table->integer('belanja_suku_cadang')->nullable();
            $table->integer('total_belanja')->virtualAs('IFNULL(belanja_bahan_bakar_minyak, 0) + IFNULL(belanja_pelumas_mesin, 0) + IFNULL(belanja_suku_cadang, 0)');
            $table->date('tanggal_belanja');
            $table->string('keterangan'); 
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belanjas');
    }
};
