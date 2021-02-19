<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pembayaran;

class PembayaranController extends TransaksiController
{
    function pembayaran($no_pesanan){        
        $pembayaran = $this->getPembayaran($no_pesanan);
        $pesanan = $this->getPesanan()->where('no_pesanan', $no_pesanan)->first();
        $confirmModal = $this->deleteConfirm('transaksi', 'modal_delete_confirm', 'btn_delete');                
        return view('pembayaran.pembayaran', compact('pesanan','pembayaran', 'confirmModal'));            
    }    

    function createPembayaran($no_pesanan){
        $pembayaran = $this->getPembayaran($no_pesanan)->sortByDesc('created_at')->first();     
        $total_pembayaran = $this->getPembayaran($no_pesanan)->sum('jumlah_pembayaran');   
        $pesanan = $this->getPesanan()->where('no_pesanan', $no_pesanan)->first();
        $rekening = $this->getRekening();
        return view('pembayaran.create_pembayaran', compact('pesanan','pembayaran', 'rekening', 'total_pembayaran'));            
    }

    function storePembayaran(Request $request, $no_pesanan){
        $norek = $request->metode_pembayaran == 'transfer' ? $request->rekening : null;                
        $pembayaran_date = Carbon::parse($request->tanggal_pembayaran)->format('Y-m-d h:i');
        $status_pembayaran = 'LUNAS';
        if($request->status_pembayaran != 'LUNAS') $status_pembayaran = 'BELUM LUNAS';

        pembayaran::create([
            'norek' => $norek,
            'no_pesanan' => $no_pesanan,
            'jumlah_pembayaran' => $request->total_bayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $status_pembayaran            
        ]);

        $toast = $this->successToast('data Pembayaran berhasil di tambahkan');                                
        if ($status_pembayaran == 'LUNAS') {
            return redirect()->route('transaksi')->with('status', $toast);              
        }else{
            return redirect()->route('pembayaran', $no_pesanan)->with('status', $toast);          
        }        
    }    

    function deletePembayaran(Request $request, $no_pesanan){
        pembayaran::findOrFail($request->id)->delete();
        $toast = $this->successToast('data Pembayaran berhasil di tambahkan');                                
        return redirect()->back()->with('status', $toast);
    }
}
