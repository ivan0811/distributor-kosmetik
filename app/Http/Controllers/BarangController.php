<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class BarangController extends MessageController
{
    function barang(){
        $barang = barang::all();
        $confirmModal = $this->deleteConfirm('user', 'modal_delete', 'btn_delete');
        return view('barang.barang', compact('barang', 'confirmModal'));
    }

    function createBarang(){        
        $getProvinsi = $this->getProvinsi;            
        return view('barang.create_barang', compact('getProvinsi'))->with('status', $getProvinsi);        
    }

    function storeBarang(Request $request){
        toko::create([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga_jual' => $request->harga_jual,
            'harga_pabrik' => $request->harga_pabrik,
            'discount' => $request->discount
        ]);
        $toast = $this->successToast('data barang berhasil di tambahkan');                                        
        return redirect()->route('barang')->with('status', $toast);
    }   

    function editBarang($id){
        $barang = barang::findOrFail($id);
        $getProvinsi = $this->getProvinsi;      
        $confirmModal = $this->saveConfirm('toko', route('toko'), 'confirm_modal', 'btn_submit');        
        return view('toko.edit_toko', compact('toko', 'getProvinsi', 'confirmModal'));
    }

    function updateToko(Request $request){
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
