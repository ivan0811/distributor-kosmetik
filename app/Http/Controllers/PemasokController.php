<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pemasok;

class PemasokController extends APIController
{
    function pemasok(){
        $pemasok = pemasok::all();
        $confirmModal = $this->deleteConfirm('user', 'modal_delete', 'btn_delete');
        return view('pemasok.pemasok', compact('pemasok', 'confirmModal'));
    }

    function createPemasok(){ 
        $getProvinsi = $this->getProvinsi;                  
        return view('pemasok.create_pemasok', compact('getProvinsi'));        
    }

    function storePemasok(Request $request){
        pemasok::create([
            'kode_pabrik' => $request->kode_pabrik,            
            'provinsi'=> $request->provinsi,            
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'alamat' => $request->alamat
        ]);
        $toast = $this->successToast('data pemasok berhasil di tambahkan');                                        
        return redirect()->route('pemasok')->with('status', $toast);
    }   

    function editPemasok($kode_pabrik){
        $pemasok = pemasok::where('kode_pabrik', $kode_pabrik);
        $getProvinsi = $this->getProvinsi;      
        $confirmModal = $this->saveConfirm('pemasok', route('pemasok'), 'confirm_modal', 'btn_submit');        
        return view('pemasok.edit_pemasok', compact('pemasok', 'getProvinsi', 'confirmModal'));
    }

    function updatePemasok(Request $request){
        pemasok::where('kode_pabrik',$request->kode_pabrik)->update([
            'provinsi'=> $request->provinsi,            
            'kabupaten'=> $request->kabupaten,
            'kecamatan'=> $request->kecamatan,
            'alamat'=> $request->alamat,
        ]);   

        $toast = $this->successToast('data pemasok berhasil di perbaharui');                                
        return redirect()->route('pemasok')->with('status', $toast);  
    }

    function deletePemasok($kode_pabrik){
        pemasok::where('kode_pabrik', $kode_pabrik)->delete();
        $toast = $this->successToast('data pemasok berhasil di hapus');                                
        return redirect()->back()->with('status', $toast);
    }
}
