<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    function transaksi(){
        return view('transaksi.transaksi');
    }

    function createTransaksi(){
        return view('transaksi.create_transaksi');
    }
}
