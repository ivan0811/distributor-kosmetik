<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Toko;
use App\Pesanan;
use App\DetailPesanan;
use App\Barang;
use App\Rekening;
use App\Pembayaran;
use App\BarangKeluar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends MessageController
{
    function transaksi(){        
        $sales = Sales::all();
        $toko = Toko::all();          
        $barang = barang::all();        
        $alert = collect();
        $pesanan = pesanan::all();
        if(count($sales) == 0)$alert->push('data sales masih kosong!');        
        if(count($toko) == 0)$alert->push('data toko masih kosong!');        
        if(count($barang) == 0) $alert->push('data barang masih kosong!');            
        $countBarang = DB::table('pesanan')
        ->join('detail_pesanan', 'pesanan.no_pesanan', '=', 'detail_pesanan.no_pesanan')
        ->select(DB::raw("count(detail_pesanan.no_pesanan) as count"))
        ->groupBy('pesanan.no_pesanan')
        ->get();        

        $pembayaran = DB::table('pesanan')
        ->join('pembayaran', 'pesanan.no_pesanan', '=', 'pembayaran.no_pesanan')        
        ->select(DB::raw('max(pembayaran.created_at) as max, pembayaran.status_pembayaran'))        
        ->groupBy('pesanan.no_pesanan', 'pembayaran.status_pembayaran')                                
        ->get();
        return view('transaksi.transaksi', compact('alert', 'pesanan', 'countBarang', 'pembayaran'));
    }    

    function createTransaksi(){
        $sales = Sales::all();
        $toko = Toko::all();  
        $rekening = Rekening::all();      
        $barang = barang::all();
        $no_pesanan = null;                                
        if(!pesanan::whereNull('no_pesanan')->first()){
            $no_pesanan = pesanan::orderBy('no_pesanan', 'DESC')->first();
        }          

        if(count($toko) == 0 || count($sales) == 0 || count($barang) == 0){
            $toast = $this->dangerToast('tidak bisa menambahkan transaksi, cek kembali yang data kosong!');               
            return redirect()->back()->with('status', $toast);
        }else{
            return view('transaksi.create_transaksi',  compact('sales', 'toko', 'rekening', 'barang', 'no_pesanan'));
        }                                
    }        

    function storeTransaksi(Request $request){
        $request->validate([            
            'jumlah_barang' => 'required',            
        ],
        [
            'required' => ':attribute tidak boleh kosong'                        
        ]); 

        $norek = $request->metode_pembayaran == 'transfer' ? $request->rekening : null;        
        $transaksi_date = Carbon::parse($request->tanggal_transaksi)->format('Y-m-d h:i');
        $pembayaran_date = Carbon::parse($request->tanggal_pembayaran)->format('Y-m-d h:i');
        $status_pembayaran = 'LUNAS';
        if($request->status_pembayaran != 'LUNAS') $status_pembayaran = 'BELUM LUNAS';

        pesanan::create([
            'no_pesanan' => $request->no_pesanan,
            'toko_id' => $request->toko_id,
            'sales_id' => $request->sales_id,
            'total_harga' => $request->jumlah_pembayaran,
            'created_at' => $transaksi_date
        ]);

        pembayaran::create([
            'norek' => $norek,
            'no_pesanan' => $request->no_pesanan,
            'jumlah_pembayaran' => $request->total_bayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $status_pembayaran            
        ]);

        foreach ($request->barang_id as $key => $value) {
            $detail_pesanan_id = DetailPesanan::insertGetId([
                'no_pesanan' => $request->no_pesanan,
                'barang_id' => $value,                
                'qty' => $request->jumlah[$key],                
                'total_harga' => $request->total_harga[$key],
                'discount' => $request->discount[$key] / 100
            ]);                

            BarangKeluar::create([
                'barang_id' => $value,
                'detail_pesanan_id' => $detail_pesanan_id,
                'jumlah' => $request->jumlah[$key],                
            ]);

            $barang = barang::findOrFail($value);
            $stok = $barang->stok - $request->jumlah[$key];
            $barang->stok = $stok;
            $barang->save();
        }        

        $toast = $this->successToast('data Transaksi berhasil di tambahkan');                                
        return redirect()->route('transaksi')->with('status', $toast);          
    }

    function editTransaksi($no_pesanan){
        $sales = Sales::all();    
        $rekening = Rekening::all();      
        $barang = barang::all();        
        $transaksi = pesanan::where('no_pesanan', $no_pesanan)->first();        

        return view('transaksi.edit_transaksi', compact('transaksi', 'sales', 'barang'));
    }

    function updateTransaksi(Request $request){

    }
}
