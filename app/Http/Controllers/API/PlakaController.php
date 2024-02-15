<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plaka;



class PlakaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kullanici_id'=>'required|max:191',
            'plaka'=>'required|max:191',
            
            
            
    
        ]);

       

        $plaka = new Plaka;
        $plaka->kullanici_id = $request->input('kullanici_id');
        $plaka->plaka = $request->input('plaka');
        
        

        $plaka->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Kullanıcı başarıyla eklendi',
        ]);
    }
    public function getPlakalar()
    {
        $plakalar = Plaka::all();
        return $plakalar;
    }
   
    
}