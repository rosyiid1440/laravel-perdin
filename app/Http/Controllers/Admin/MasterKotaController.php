<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterKota;
use Alert;

class MasterKotaController extends Controller
{
    public function index()
    {
        $data = MasterKota::orderBy('nama_kota')->get();

        return view('admin/master-kota',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kota' => 'required|max:255',
            'provinsi' => 'required|max:255',
            'pulau' => 'required|max:255',
            'luar_negeri' => 'required|max:255',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255'
        ]);

        MasterKota::create($request->all());

        Alert::success('Sukses','Data berhasil ditambah !');
        return back();
    }

    public function destroy($id)
    {
        MasterKota::find($id)->delete();

        Alert::success('Sukses','Data berhasil dihapus !');
        return back();
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'nama_kota' => 'required|max:255',
            'provinsi' => 'required|max:255',
            'pulau' => 'required|max:255',
            'luar_negeri' => 'required|max:255',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255'
        ]);

        MasterKota::find($id)->update($request->all());

        Alert::success('Sukses','Data berhasil diubah !');
        return back();
    }
}