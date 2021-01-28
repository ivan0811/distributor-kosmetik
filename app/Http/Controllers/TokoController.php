<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Toko;

class TokoController extends APIController
{
    function toko(){
        $toko = Toko::all();
        $confirmModal = $this->deleteConfirm('user', 'modal_delete', 'btn_delete');
        return view('toko.toko', compact('toko', 'confirmModal'));
    }

    function createToko(){        
        $getProvinsi = $this->getProvinsi;            
        return view('toko.create_toko', compact('getProvinsi'))->with('status', $getProvinsi);        
    }

    function storeToko(Request $request){
        toko::create([
            'nama' => $request->nama,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);
        $toast = $this->successToast('data toko berhasil di tambahkan');                                        
        return redirect()->route('toko')->with('status', $toast);
    }   

    function editToko($id){
        $toko = Toko::findOrFail($id);
        $getProvinsi = $this->getProvinsi;      
        $confirmModal = $this->saveConfirm('toko', route('toko'), 'confirm_modal', 'btn_submit');        
        return view('toko.edit_toko', compact('toko', 'getProvinsi', 'confirmModal'));
    }

    function updateToko(Request $request){
        $toko = Toko::findOrFail($request->id);   
        $toko->nama = $request->nama;
        $toko->kabupaten = $request->kabupaten;
        $toko->kecamatan = $request->kecamatan;
        $toko->no_hp = $request->no_hp;
        $toko->alamat = $request->alamat;          
        $toko->save();

        $toast = $this->successToast('data toko berhasil di perbaharui');                                
        return redirect()->route('toko')->with('status', $toast);  
    }

    function deleteToko($id){
        toko::findOrFail($id)->delete();
        $toast = $this->successToast('data toko berhasil di hapus');                                
        return redirect()->back()->with('status', $toast);
    }
}
