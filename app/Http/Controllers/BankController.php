<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;

class BankController extends MessageController
{
    function bank(){
        $bank = bank::all();
        $confirmModal = $this->deleteConfirm('user', 'modal_delete', 'btn_delete');
        return view('bank.bank', compact('bank','confirmModal'));
    }

    function createBank(){
        return view('bank.create_bank');
    }    

    function storeBank(Request $request){
        Bank::create([
            'kode_bank' => $request->kode_bank,
            'nama_bank' => $request->nama_bank,
        ]);
        $toast = $this->successToast('data bank berhasil di tambahkan');                                        
        return redirect()->route('bank')->with('status', $toast);
    }

    function editBank($kode_bank){
        $bank = Bank::where('kode_bank', $kode_bank)->first();        
        $confirmModal = $this->saveConfirm('bank', route('bank'), 'confirm_modal', 'btn_submit');        
        return view('bank.edit_bank', compact('bank','confirmModal'));
    }        

    function updateBank(Request $request){
        Bank::where('kode_bank', $request->kode_bank)->update(['nama_bank'=>$request->nama_bank]);

        $toast = $this->successToast('data bank berhasil di perbaharui');                                
        return redirect()->route('bank')->with('status', $toast);  
    }

    function deleteBank($kode_bank){
        Bank::where('kode_bank', $kode_bank)->delete();
        $toast = $this->successToast('data bank berhasil di hapus');                                
        return redirect()->back()->with('status', $toast);
    }
}