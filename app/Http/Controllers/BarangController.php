<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\BarangMasuk;
use App\BarangKeluar;
use App\Satuan;
use App\Pemasok;
use Auth;
use Carbon\Carbon;

class BarangController extends MessageController
{
    // barang
    function barang(){
        $barang = barang::all();
        $barangMasuk = barangMasuk::all();
        $barangKeluar = barangKeluar::all();
        $satuan = Satuan::all();
        $alert = collect();
        if(count(Pemasok::all()) == 0) $alert->push('data pemasok masih kosong');
        if(count(Barang::all()) == 0) $alert->push('data barang masih kosong');
                
        return view('barang.barang', compact('barang', 'barangMasuk', 'barangKeluar', 'alert', 'satuan'));
    }

    function createBarang(){ 
        $satuan = satuan::all();                  
        return view('barang.create_barang', compact('satuan'));        
    }

    private function updateSatuan($id_satuan_del, $id_satuan, $satuan, $satuan_id){        
        if(isset($id_satuan_del)){
            foreach ($id_satuan_del as $value) {             
                $skip = false;
                if(isset($id_satuan)){
                    foreach ($id_satuan as $item) {
                        if($value == $item){
                            $skip = true;
                        }
                    }   
                }    
                if($skip)continue;
                try {
                    Satuan::findOrFail($value)->delete();                                    
                } catch (\Throwable $th) {
                    
                }                
            }
        }    
        if(isset($id_satuan)){
            foreach ($id_satuan as $key => $value) {            
                if(Satuan::where('nama', strtoupper($value))->first() != null){
                    continue;
                }      
                try {
                    Satuan::create([
                        'id' => $value,
                        'nama' => strtoupper($satuan[$key])
                    ]);
                    // if($satuan == $satuan_id){
                    //     $satuan_id = $satuan;
                    // }                                   
                } catch (\Throwable $th) {
                    //throw $th;                        
                }                       
            }
        }
        return $satuan_id; 
    }


    function storeBarang(Request $request){                    
        $satuan = collect();
        if($request->satuan){
            foreach ($request->satuan as $key => $value) {
                $satuan->push($value);
            }
        }        
        $satuan_id = $this->updateSatuan($request->id_satuan_del, $request->id_satuan, $request->satuan, $request->satuan_id);        
        barang::create([
            'user_id' => Auth::id(),
            'satuan_id' => $satuan_id,
            'kode_bpom' => $request->kode_bpom,
            'nama' => $request->nama,
            'stok' => 0,
            'harga_jual' => $request->harga_jual,
            'harga_pabrik' => $request->harga_pabrik,
            'discount' => $request->discount/100
        ]);
        $toast = $this->successToast('data barang berhasil di tambahkan');                                        
        return redirect()->route('barang')->with('status', $toast);
    }
       

    function editBarang($id){
        $barang = barang::findOrFail($id);                                             
        $confirmModal = $this->saveConfirm('barang', route('barang'), 'confirm_modal', 'btn_submit');        
        return view('barang.edit_barang', compact('barang', 'satuan', 'confirmModal'));
    }

    function updateBarang(Request $request){
        $satuan = collect();
        if($request->satuan){
            foreach ($request->satuan as $key => $value) {
                $satuan->push($value);
            }
        }          
        $satuan_id = $this->updateSatuan($request->id_satuan_del, $request->id_satuan, $satuan, $request->satuan_id);
        $barang = barang::findOrFail($request->id);           
        $barang->satuan_id = $satuan_id;
        $barang->kode_bpom = $request->kode_bpom;
        $barang->nama = $request->nama;        
        $barang->harga_jual = $request->harga_jual;
        $barang->harga_pabrik = $request->harga_pabrik;
        $barang->stok = $request->stok;
        $barang->discount = $request->discount / 100;          
        $barang->save();

        $toast = $this->successToast('data barang berhasil di perbaharui');                                
        return redirect()->route('barang')->with('status', $toast);  
    }

    function deleteBarang($id){
        barang::findOrFail($id)->delete();
        $toast = $this->successToast('data barang berhasil di hapus');                                
        return redirect()->back()->with('status', $toast);
    }


    // barang Masuk
    function createBarangMasuk(){ 
        $barangMasuk = barangMasuk::all();                  
        $barang = barang::all();
        $pemasok = pemasok::all();

        if(count($pemasok) == 0|| count($barang) == 0){
            $toast = $this->dangerToast('tidak bisa menambahkan barang masuk, cek kembali yang data kosong!');                                
            return redirect()->back()->with('status', $toast);
        }        

        return view('barang.create_barang_masuk', compact('barangMasuk', 'barang', 'pemasok'));        
    }
    
    function storeBarangMasuk(Request $request){
        $tanggal = Carbon::parse($request->tanggal)->format('Y-m-d');
        foreach ($request->id_barang as $key => $value) {            
            BarangMasuk::create([
                'barang_id' => $value,
                'kode_pabrik' => $request->kode_pabrik,                
                'jumlah' => $request->jumlah[$key],
                'created_at' => $tanggal,                
            ]);   

            $barang = barang::findOrFail($value);
            $barang->stok = $barang->stok + $request->jumlah[$key];
            $barang->save();
        }
                           
        
        $toast = $this->successToast('data barang berhasil di tambahkan');                                        
        return redirect()->route('barang')->with('status', $toast);
    }

        function editBarangMasuk($id){
            $barangMasuk = barangMasuk::findOrFail($id);      
            $pemasok = pemasok::all();
            $confirmModal = $this->saveConfirm('barang', route('barang'), 'confirm_modal', 'btn_submit');        
            return view('barang.edit_barang_masuk', compact('barangMasuk', 'confirmModal', 'pemasok'));
        }

        function updateBarangMasuk(Request $request){            
            $barangMasuk = barangMasuk::findOrFail($request->barang_id);              
            $barangMasuk->kode_pabrik = $request->kode_pabrik;
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


    // barang keluar
    function createBarangKeluar(){ 
        $barangKeluar = barangKeluar::all();     
        $barang = barang::all();
        if(count($barang) == 0){
            $toast = $this->dangerToast('tidak bisa menambahkan barang keluar, cek kembali yang data kosong!');                                
            return redirect()->back()->with('status', $toast);
        }                     
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
