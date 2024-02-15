<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arac;

class GirisController extends Controller
{
    
    public function getTotalDistinctPlakaCount()
    {
        $totalDistinctPlakaCount = Arac::distinct('plaka')->count('plaka');

        return response()->json(['totalDistinctPlakaCount' => $totalDistinctPlakaCount]);
    }
    public function getTotalVehicleCount()
    {
        $updatedCount = 8; 
        
        $totalDistinctPlakaCount = Arac::distinct('plaka')->count('plaka');
        $totalVehicleCount = $totalDistinctPlakaCount + $updatedCount;

        return response()->json(['totalVehicleCount' => $totalVehicleCount]);
    }
    
}
