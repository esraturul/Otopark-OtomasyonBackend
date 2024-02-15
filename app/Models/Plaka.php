<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaka extends Model
{
    protected $table = 'plakas';

    public function arac()
    {
        return $this->hasOne(Arac::class,'plaka','plaka');
    }
 


   
}
