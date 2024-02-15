<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arac extends Model
{
    use HasFactory;
    protected $table = 'arac_giris';
    
    public function kullanici()
{
    return $this->belongsTo(Kullanıcı::class, 'kullanici_id');
}


}
