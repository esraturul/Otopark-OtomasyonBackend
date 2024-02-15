<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kullanıcı;


class KullanıcıController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ad'=>'required|max:191',
            'soyad'=>'required|max:191',
            'tckn'=>'required|max:191',
            'telefon_numarasi'=>'required|max:191',
            


        ]);

        $kullanıcı = new Kullanıcı;
        $kullanıcı->ad = $request->input('ad');
        $kullanıcı->soyad = $request->input('soyad');
        $kullanıcı->tckn = $request->input('tckn');
        $kullanıcı->telefon_numarasi = $request->input('telefon_numarasi');
        $kullanıcı->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Kullanıcı başarıyla eklendi',
        ]);
    }

    public function delete_oge($id){
         
        $result = Kullanıcı::where('id', $id)->delete();
        if($result)
        {
          
            return ["kullanıcı başarıyla silindi"];
        }
        else{
            return ["kullanıcı silme başarısız"];
        }

    }




    public function getKullanicilar()
    {
        $kullanicilar = Kullanıcı::all();
        return $kullanicilar;
    }
   
   
  

}
