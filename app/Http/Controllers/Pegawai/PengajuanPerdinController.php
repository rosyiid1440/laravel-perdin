<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perdin;
use App\Models\MasterKota;
use App\Models\UangSaku;
use Alert;
use Auth;

class PengajuanPerdinController extends Controller
{
    function distance($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $kilometers = $miles * 1.609344;
        return $kilometers;
    }

    public function index()
    {
        $kota = MasterKota::orderBy('nama_kota')->get();
        $data = Perdin::with(['kotaasal'])->with(['kotatujuan'])->with(['user'])->orderBy('id','DESC')->where('user_id',Auth::user()->id)->get();

        return view('pegawai/pengajuan-perdin',compact('data','kota'));
    }

    public function store(Request $request)
    {
        $kotaasal = MasterKota::find($request->kota_asal);
        $kotatujuan = MasterKota::find($request->kota_tujuan);
        $jarak = round($this->distance($kotaasal->latitude,$kotaasal->longitude,$kotatujuan->latitude,$kotatujuan->longitude));

        if($kotaasal->provinsi == $kotatujuan->provinsi){
            $provinsi = "0";
        }else{
            $provinsi = "1";
        }

        if($kotaasal->pulau == $kotatujuan->pulau){
            $pulau = "0";
        }else{
            $pulau = "1";
        }

        if($kotaasal->luar_negeri == $kotatujuan->luar_negeri){
            $luar_negeri = "0";
        }else{
            $luar_negeri = "1";
        }

        $uangsaku = UangSaku::where('awal',"<",$jarak)
        ->where(function ($query) use ($jarak) {
            $query->where('akhir', '>=', $jarak);
            $query->orWhere('akhir','=',0);
        })
        ->where('provinsi',$provinsi)
        ->where('pulau',$pulau)
        ->where('luar_negeri',$luar_negeri)
        ->first();

        $request->validate([
            'kota_asal' => 'required|max:255',
            'kota_tujuan' => 'required|max:255',
            'tanggal_awal' => 'required|max:255|date_format:Y-m-d',
            'tanggal_akhir' => 'required|max:255|date_format:Y-m-d',
            'keterangan' => 'required'
        ]);

        $perdin = new Perdin;
        $perdin->kota_asal = $request->kota_asal;
        $perdin->kota_tujuan = $request->kota_tujuan;
        $perdin->tanggal_awal = $request->tanggal_awal;
        $perdin->tanggal_akhir = $request->tanggal_akhir;
        $perdin->keterangan = $request->keterangan;
        $perdin->user_id = Auth::user()->id;
        $perdin->jarak = $jarak;
        $perdin->nominal = $uangsaku->nominal;
        $perdin->satuan = $uangsaku->satuan;
        $perdin->save();

        Alert::success('Sukses','Data berhasil ditambah !');
        return back();
    }
}