<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\BarangMasuk;
use App\BarangKeluar;
use App\Satuan;
use Auth;

class BarangController extends MessageController
{
    // barang
    function barang(){
        $barang = barang::all();
        $barangMasuk = barangMasuk::all();
        $confirmModal = $this->deleteConfirm('user', 'modal_delete', 'btn_delete');
        return view('barang.barang', compact('barang', 'confirmModal'));
    }

    function createBarang(){ 
        $satuan = satuan::all();                  
        return view('barang.create_barang', compact('satuan'));        
    }


    function storeBarang(Request $request){
        
        barang::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga_jual' => $request->harga_jual,
            'harga_pabrik' => $request->harga_pabrik,
            'discount' => 100/$request->discount                        
        ]);
        $toast = $this->successToast('data barang berhasil di tambahkan');                                        
        return redirect()->route('barang')->with('status', $toast);
    }
       

    function editBarang($nama){
        $barang = barang::findOrFail($nama);      
        $confirmModal = $this->saveConfirm('barang', route('barang'), 'confirm_modal', 'btn_submit');        
        return view('barang.edit_barang', compact('barang', 'getProvinsi', 'confirmModal'));
    }

    function updateBarang(Request $request){
        $barang = barang::findOrFail($request->id);   
        $barang->nama = $request->nama;
        $barang->stok = $request->stok;
        $barang->harga_jual = $request->harga_jual;
        $barang->harga_pabrik = $request->harga_pabrik;
        $barang->discount = $request->discount;          
        $barang->save();

        $toast = $this->successToast('data barang berhasil di perbaharui');                                
        return redirect()->route('barang')->with('status', $toast);  
    }

    function deleteBarang($nama){
        barang::findOrFail($nama)->delete();
        $toast = $this->successToast('data barang berhasil di hapus');                                
        return redirect()->back()->with('status', $toast);
    }


    // barang Masuk
    function createBarangMasuk(){ 
        $barangMasuk = barangMasuk::all();                  
        return view('barang.create_barang_masuk', compact('barangMasuk'));        
    }

    function storeBarangMasuk(Request $request){
        barang::create([
            'barang_id' => $request->barang_id,
            'kode_pabrik' => $request->kode_pabrik,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah
        ]);
        $toast = $this->successToast('data barang berhasil di tambahkan');                                        
        return redirect()->route('barang')->with('status', $toast);


        function editBarangMasuk($barang_id){
            $barangMasuk = barangMasuk::findOrFail($barang_id);      
            $confirmModal = $this->saveConfirm('barang', route('barang'), 'confirm_modal', 'btn_submit');        
            return view('barang.edit_barang_masuk', compact('barang', 'confirmModal'));
        }

        function updateBarangMasuk(Request $request){
            $barangMasuk = barangMasuk::findOrFail($request->kode_pabrik);   
            $barangMasuk->barang_id = $request->barang_id;
            $barangMasuk->kode_pabrik = $request->kode_pabrik;
            $barangMasuk->tanggal = $request->tanggal;
            $barangMasuk->jumlah = $request->jumlah;          
            $barangMasuk->save();
    
            $toast = $this->successToast('data barang berhasil di perbaharui');                                
            return redirect()->route('barang')->with('status', $toast);  
        }

        function deleteBarangMasuk($kode_pabrik){
            barangMasuk::findOrFail($kode_pabrik)->delete();
            $toast = $this->successToast('data barang masuk berhasil di hapus');                                
            return redirect()->back()->with('status', $toast);
        }
    }


    // barang keluar
    function createBarangKeluar(){ 
        $barangKeluar = barangKeluar::all();                  
        return view('barang.create_barang_keluar', compact('barangKeluar'));        
    }

    function storeBarangKeluar(Request $request){
        barang::create([
            'id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah
        ]);
        $toast = $this->successToast('data barang berhasil di tambahkan');                                        
        return redirect()->route('barang')->with('status', $toast);
    }

    function editBarangKeluar($id){
        $barangKeluar = barangKeluar::findOrFail($id);      
        $confirmModal = $this->saveConfirm('barang', route('barang'), 'confirm_modal', 'btn_submit');        
        return view('barang.edit_barang_keluar', compact('barang', 'confirmModal'));
    }

    function updateBarangKeluar(Request $request){
        $barangKeluar = barangKeluar::findOrFail($request->id);   
        $barangKeluar->barang_id = $request->barang_id;
        $barangKeluar->jumlah = $request->jumlah;          
        $barangMasuk->save();

        $toast = $this->successToast('data barang berhasil di perbaharui');                                
        return redirect()->route('barang')->with('status', $toast);  
    }

    function deleteBarangKeluar($id){
        barangKeluar::findOrFail($id)->delete();
        $toast = $this->successToast('data barang keluar masuk berhasil di hapus');                                
        return redirect()->back()->with('status', $toast);
    }

}
