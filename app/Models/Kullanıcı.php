<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Arac;

class Kullanıcı extends Model
{
    use HasFactory;
    protected $table = 'kullanici';
    protected $fillable = [
        'ad',
        'soyad',
        'tckn',
        'telefon_numarasi',
    ];

    public function arac(){
        return $this->hasMany(Arac::class,'kullanici_id','id');
    }

    public function plaka(){
        return $this->hasMany(Plaka::class,'kullanici_id','id');
    }
    
}