<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Toko;
use App\Pesanan;
use App\DetailPesanan;

class TransaksiController extends Controller
{
    function transaksi(){        
        return view('transaksi.transaksi');
    }

    function createTransaksi(){
        $sales = Sales::all();
        $toko = Toko::all();        
        return view('transaksi.create_transaksi',  compact('sales', 'toko'));
    }
}
