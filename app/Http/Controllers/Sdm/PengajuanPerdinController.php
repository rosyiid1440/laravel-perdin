<?php

namespace App\Http\Controllers\Sdm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perdin;
use Alert;
use Auth;

class PengajuanPerdinController extends Controller
{
    public function index()
    {
        $data = Perdin::with(['kotaasal'])->with(['kotatujuan'])->with(['user'])->orderBy('id','DESC')->where('status','pending')->get();
        $history = Perdin::with(['kotaasal'])->with(['kotatujuan'])->with(['user'])->orderBy('id','DESC')->where('status','!=','pending')->get();

        return view('sdm/pengajuan-perdin',compact('data','history'));
    }

    public function approve($id)
    {
        Perdin::find($id)->update([
            'status' => 'approved',
            'approval_user_id' => Auth::user()->id,
        ]);

        Alert::success("Sukses",'Data berhasil diubah !');
        return back();
    }

    public function reject($id)
    {
        Perdin::find($id)->update([
            'status' => 'rejected',
            'approval_user_id' => Auth::user()->id,
        ]);

        Alert::success("Sukses",'Data berhasil diubah !');
        return back();
    }
}