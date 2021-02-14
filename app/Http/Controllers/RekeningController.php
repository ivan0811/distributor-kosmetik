<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekening;
use App\Bank;

class RekeningController extends MessageController
{
    function rekening(){
        $rekening = rekening::all();
        $confirmModal = $this->deleteConfirm('user', 'modal_delete', 'btn_delete');
        return view('rekening.rekening', compact('rekening','confirmModal'));
    }

    function createRekening(){
        $bank = Bank::all();
        return view('rekening.create_rekening', compact('bank'));
    }

    function storeRekening(Request $request){
        Rekening::create([
            'norek' => $request->norek,
            'kode_bank' => $request->kode_bank,
            'atas_nama' => $request->atas_nama,
        ]);
        $toast = $this->successToast('data rekening berhasil di tambahkan');                                        
        return redirect()->route('rekening')->with('status', $toast);
    }

    function editRekening($norek){
        $rekening = Rekening::where('norek', $norek)->first();        
        $confirmModal = $this->saveConfirm('rekening', route('rekening'), 'confirm_modal', 'btn_submit');        
        return view('rekening.edit_rekening', compact('rekening','confirmModal'));
    }        

    function updateRekening(Request $request){
        Rekening::where('norek', $request->norek)->update(['atas_nama'=>$request->atas_nama]);

        $toast = $this->successToast('data rekening berhasil di perbaharui');                                
        return redirect()->route('rekening')->with('status', $toast);  
    }

    function deleteRekening($norek){
        Rekening::where('norek', $norek)->delete();
        $toast = $this->successToast('data rekening berhasil di hapus');                                
        return redirect()->back()->with('status', $toast);
    }
}
