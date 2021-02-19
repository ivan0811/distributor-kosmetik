<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pemasok;
use App\Rekening;

class PemasokController extends APIController
{
    function pemasok(){
        $pemasok = pemasok::all();
        $confirmModal = $this->deleteConfirm('user', 'modal_delete', 'btn_delete');
        return view('pemasok.pemasok', compact('pemasok', 'confirmModal'));
    }

    function createPemasok(){ 
        $getProvinsi = $this->getProvinsi;          
        $rekening = rekening::all();        
        return view('pemasok.create_pemasok', compact('getProvinsi', 'rekening'));        
    }

    function storePemasok(Request $request){
        pemasok::create([
            'kode_pabrik' => $request->kode_pabrik,     
            'nama' => $request->nama,
            'norek' => $request->norek,       
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
        $rekening = rekening::all();        
        $confirmModal = $this->saveConfirm('pemasok', route('pemasok'), 'confirm_modal', 'btn_submit');        
        return view('pemasok.edit_pemasok', compact('pemasok', 'getProvinsi', 'confirmModal'));
    }

    function updatePemasok(Request $request){
        pemasok::where('kode_pabrik',$request->kode_pabrik)->update([
            'nama' => $request->nama,
            'norek' => $request->norek,
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
