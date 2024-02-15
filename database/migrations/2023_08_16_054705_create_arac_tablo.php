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
        Schema::create('arac_giris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kullanici_id');
            $table->date('giris_tarihi');
            $table->date('cikis_tarihi'); 
            $table->time('giris_saati');
            $table->time('cikis_saati');
            $table->integer('odeme_tutari');
            $table->integer('kaldigi_dakika');
            
           
            
            $table->string('plaka'); 
            $table->timestamps();
            //$table->foreign('kullanici_id')->references('id')->on('kullanici')->onDelete('cascade');
            $table->foreign('kullanici_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arac_giris');
    }
};
