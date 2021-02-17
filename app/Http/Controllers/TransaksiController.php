<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Toko;
use App\Pesanan;
use App\DetailPesanan;
use App\Barang;
use App\Rekening;

class TransaksiController extends Controller
{
    function transaksi(){        
        return view('transaksi.transaksi');
    }

    function createTransaksi(){
        $sales = Sales::all();
        $toko = Toko::all();  
        $rekening = Rekening::all();      
        $barang = barang::all();
        $no_pesanan = null;                                
        if(!pesanan::whereNull('no_pesanan')->first()){
            $no_pesanan = pesanan::orderBy('no_pesanan', 'DESC')->get();
        }
        return view('transaksi.create_transaksi',  compact('sales', 'toko', 'rekening', 'barang', 'no_pesanan'));
    }
}
