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
        $pesanan = pesanan::where('no_pesanan', $no_pesanan)->first();
        $detailPesanan = DetailPesanan::where('no_pesanan', $no_pesanan)->get();        
        $barang = barang::whereNotIn('id', $detailPesanan->pluck('barang_id')->all())->get();        
        $dataBarang = DetailPesanan::where('no_pesanan', $no_pesanan)
                    ->join('barang', 'barang.id', '=', 'detail_pesanan.barang_id')
                    ->join('satuan', 'barang.satuan_id', '=', 'satuan.id')
                    ->select('barang.id as key', 'barang.id as barang_id', 'barang.nama as nama_barang', 'barang.stok', 'barang.harga_jual', 'barang.discount', 'satuan.nama as satuan')
                    ->get();
        $pembayaran = Pembayaran::where('no_pesanan', $no_pesanan)->latest()->first();
        $dataBarang = json_encode($dataBarang);              
        
        $total_discount = DetailPesanan::select(DB::raw('sum(discount) as result'))->where('no_pesanan', $no_pesanan)->get();
        $total_discount = json_decode($total_discount[0]->result) * 100;        
        
        return view('transaksi.edit_transaksi', compact('transaksi', 'sales', 'barang', 'pesanan', 'detailPesanan', 'rekening', 'dataBarang', 'pembayaran', 'total_discount'));
    }

    function updateTransaksi(Request $request){
        $request->validate([            
            'jumlah_barang' => 'required',            
        ],
        [
            'required' => ':attribute tidak boleh kosong'                        
        ]); 
        $transaksi_date = Carbon::parse($request->tanggal_transaksi)->format('Y-m-d h:i');
        $pembayaran_date = Carbon::parse($request->tanggal_pembayaran)->format('Y-m-d h:i');

        $transaksi_date = Carbon::parse($request->tanggal_transaksi)->format('Y-m-d h:i');
        $pembayaran_date = Carbon::parse($request->tanggal_pembayaran)->format('Y-m-d h:i');
        pesanan::where('no_pesanan', $request->no_pesanan)
                ->update([
                    'sales_id' => $request->sales_id,
                    'total_harga' => $request->no_pesanan,                              
                    'updated_at' => $transaksi_date
                ]);
        $norek = $request->metode_pembayaran == 'transfer' ? $request->rekening : null;                
        $status_pembayaran = 'LUNAS';
        if($request->status_pembayaran != 'LUNAS') $status_pembayaran = 'BELUM LUNAS';
        pembayaran::where('no_pesanan', $request->no_pesanan)
                    ->update([
                        'norek' => $norek,
                        'jumlah_pembayaran' => $request->total_bayar,
                        'metode_pembayaran' => $request->metode_pembayaran,
                        'status_pembayaran' => $status_pembayaran,
                        'updated_at' => $pembayaran_date
                    ]);        
        $id_detail_pesanan = [];

        foreach ($request->barang_id as $key => $value) {                           
            $barang = barang::findOrFail($value);
            $stok = $barang->stok;            
            $detailpesanan = detailPesanan::where('barang_id', $value)->get();
            if($detailpesanan->count() != 0){
                //update
                $detail = detailPesanan::findOrFail($request->id_detail[$key]); 
                $jumlahAwal = $detail->qty;
                $jumlah = $request->jumlah[$key];
                if($jumlahAwal > $jumlah){
                    $stok -= $jumlah;
                }else if($jumlahAwal < $jumlah){
                    $stok += $jumlah * 1;
                }
                $detail->qty = $jumlah;
                $detail->total_harga = $request->total_harga[$key];
                $detail->discount = $request->discount;
                $detail->save();
                
                BarangKeluar::where('detail_pesanan_id', $request->$id_detail[$key])
                ->update([
                    'jumlah' => $request->jumlah[$key],
                    'updated_at' => $transaksi_date
                ]); 
                $id_detail_pesanan[] = $request->id_detail[$key];
            }else{
                //create                
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
                    'created_at' => $transaksi_date
                ]);

                $id_detail_pesanan[] = $detail_pesanan_id;
                $stok -= $request->jumlah[$key];
            }
            $barang->stok = $stok;
            $barang->save();
            print_r($stok.'<br>');
        }

        //delete        
        $detail_pesanan = detailPesanan::where('no_pesanan', $request->no_pesanan)->get()->whereNotIn('id', $id_detail_pesanan)->all();        
        foreach ($detail_pesanan as $key => $value) {
            $barang = barang::findOrFail($value->barang_id);
            $stok = $value->qty + $barang->stok * 1;                
            $barang->stok = $stok;
            $barang->save();
            barangKeluar::where('detail_pesanan_id', $value->id)->delete();
            detailPesanan::findOrFail($value->id)->delete();            
        }        
    }
}
