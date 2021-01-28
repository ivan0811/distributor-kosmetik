<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;

class SalesController extends MessageController
{
    function sales(){
        $sales = Sales::all();
        $confirmModal = $this->deleteConfirm('sales', 'modal_delete', 'btn_delete');
        return view('sales.sales', compact('sales', 'confirmModal'));
    }
    
    function createSales(){
        return view('sales.create_sales');
    }

    function storeSales(Request $request){
        Sales::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'jk' => $request->jk,
            'alamat' => $request->alamat
        ]);
        $toast = $this->successToast('data sales berhasil di tambahkan');                                        
        return redirect()->route('sales')->with('status', $toast);
    }

    function editSales($id){
        $sales = Sales::findOrFail($id);        
        $confirmModal = $this->saveConfirm('sales', route('sales'), 'confirm_modal', 'btn_submit');        
        return view('sales.edit_sales', compact('sales', 'getProvinsi', 'confirmModal'));
    }

    function updateSales(Request $request){
        $sales = Sales::findOrFail($request->id);   
        $sales->nama = $request->nama;
        $sales->no_hp = $request->no_hp;
        $sales->jk = $request->jk;
        $sales->alamat = $request->alamat;        
        $sales->save();

        $toast = $this->successToast('data sales berhasil di perbaharui');                                
        return redirect()->route('sales')->with('status', $toast);  
    }
    
    function deleteSales($id){
        Sales::findOrFail($id)->delete();
        $toast = $this->successToast('data sales berhasil di hapus');                                
        return redirect()->back()->with('status', $toast);
    }
}
