<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arac;
use App\Models\Kullanıcı;
use App\Models\Plaka;
use App\Models\User;

class AracController extends Controller
{
    public function store(Request $request)
    {
        
        $odeme_tutari = $this->calculatePayment($request->input('giris_saati'), $request->input('cikis_saati'));
        
       // db.connection_string.dbo.SmartAx = 10.20.30.75.dbo.SmartAx (db injectiona izin vermez.)

        $arac = new Arac;
        $arac->kullanici_id = $request->input('kullanici_id');
        $arac->giris_tarihi = $request->input('giris_tarihi');
        $arac->cikis_tarihi = $request->input('cikis_tarihi');
        $arac->giris_saati = $request->input('giris_saati');
        $arac->cikis_saati = $request->input('cikis_saati');
       

        $giris = strtotime($request->input('giris_saati'));
        $cikis = strtotime($request->input('cikis_saati'));
        $fark_saniye = $cikis - $giris;
        $fark_dakika = $fark_saniye / 60;
        $arac->odeme_tutari = $odeme_tutari;
        $arac->kaldigi_dakika = $fark_dakika;
        
       
        
       
        $arac->plaka = $request->input('plaka');

        $arac->save();

        $plaka = new Plaka;
        $plaka->kullanici_id = $request->input('kullanici_id');
        $plaka->plaka = $request->input('plaka');
        $plaka->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Araç başarıyla eklendi',
        ]);
    }
    public function delete_arac($id){
        $arac=Arac::where('id',$id)->first();

        if(!$arac){
            return response()->json("error");
        }
        $arac->delete();
        return response()->json("basarili");
    }
    public function delete_rezervasyon($id){
        $result = User::where('id',$id)->delete();
        if($result){
            return ['result'=>'başarılı'];
        }
    }
    public function guncelle(Request $req, $id){
        $data = $req->all();
        $arac = Arac::where('id',$id);
        $arac->update($data);
        $new=Arac::where('id',$id)->first();
        return $new;
    }
    public function rezervasyon_guncelle(Request $req, $id){
        $data = $req->all();
        $user = User::where('id',$id);
        $user->update($data);
        $new=User::where('id',$id)->first();
        return $new;
    }
    public function araclar($kullanici_id){
        $kullanici = Kullanıcı::where('id',$kullanici_id)->first();
        $arac = $kullanici->arac;
        return $arac;

    }
    public function getArac()
    {
        $araclar = Arac::all();
        return $araclar;
    }
    
    public function calculatePayment($giris_saati, $cikis_saati) {
        $giris = strtotime($giris_saati);
        $cikis = strtotime($cikis_saati);
        $fark_saniye = $cikis - $giris;
        $fark_dakika = $fark_saniye / 60;
    
        if ($fark_dakika <= 59) {
            return  20;
        } elseif ($fark_dakika == 60) {
            return 22;
        } elseif ($fark_dakika > 60 && $fark_dakika <= 119) {
            return 25;
        } elseif ($fark_dakika > 120 && $fark_dakika <= 179) {
            return 30;
        } elseif ($fark_dakika > 180 && $fark_dakika <= 239) {
            return 35;
        } elseif ($fark_dakika > 240 && $fark_dakika <= 719) {
            return 40;
        } elseif ($fark_dakika > 720 && $fark_dakika <= 1439) {
            return 45;
        } elseif ($fark_dakika == 1440) {
            return 50;
        }else {
            $fark_gun = floor($fark_dakika / 1440);
            $fark_kalan_dakika = $fark_dakika % 1440;
            $ek_odenek = $fark_kalan_dakika <= 59 ? 20 : ($fark_kalan_dakika === 60 ? 22 : 25);
            return ($fark_gun * 50) + $ek_odenek;
    }
    }
    public function calculateParkingDuration($plaka)
{
    $arac = Arac::where('plaka', $plaka)->first();

    if (!$arac) {
        return response()->json([
            'error' => 'Araç bulunamadı.'
        ], 404);
    }

    $giris_saati = $arac->giris_saati;
    $cikis_saati = $arac->cikis_saati;

    $giris = strtotime($giris_saati);
    $cikis = strtotime($cikis_saati);
    $fark_saniye = $cikis - $giris;
    $fark_dakika = $fark_saniye / 60;

    $arac->kaldigi_dakika = $fark_dakika;
    $arac->save();

    return response()->json([
        'plaka' => $plaka,
        'kaldigi_dakika' => $fark_dakika
    ], 200);
}
  
    
    }
    
    
 

