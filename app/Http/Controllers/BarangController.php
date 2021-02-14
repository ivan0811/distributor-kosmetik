<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Satuan;

class BarangController extends MessageController
{
    function barang(){
        $barang = barang::all();
        $confirmModal = $this->deleteConfirm('user', 'modal_delete', 'btn_delete');
        return view('barang.barang', compact('barang', 'confirmModal'));
    }

    function createBarang(){ 
        $satuan = satuan::all();                  
        return view('barang.create_barang', compact('satuan'));        
    }

    function storeBarang(Request $request){
        barang::create([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga_jual' => $request->harga_jual,
            'harga_pabrik' => $request->harga_pabrik,
            'discount' => $request->discount,
        ]);
        $toast = $this->successToast('data barang berhasil di tambahkan');                                        
        return redirect()->route('barang')->with('status', $toast);
    }
       

    function editBarang($id){
        $barang = barang::findOrFail($id);
        $getProvinsi = $this->getProvinsi;      
        $confirmModal = $this->saveConfirm('barang', route('barang'), 'confirm_modal', 'btn_submit');        
        return view('barang.edit_barang', compact('barang', 'getProvinsi', 'confirmModal'));
    }

    function updateBarang(Request $request){
        $barang = barang::findOrFail($request->id);   
        $barang->nama = $request->nama;
        $barang->kabupaten = $request->kabupaten;
        $barang->kecamatan = $request->kecamatan;
        $barang->no_hp = $request->no_hp;
        $barang->alamat = $request->alamat;          
        $barang->save();

        $toast = $this->successToast('data barang berhasil di perbaharui');                                
        return redirect()->route('barang')->with('status', $toast);  
    }

    function deleteBarang($id){
        barang::findOrFail($id)->delete();
        $toast = $this->successToast('data barang berhasil di hapus');                                
        return redirect()->back()->with('status', $toast);
    }

}
