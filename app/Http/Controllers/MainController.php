<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;  
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Pembayaran;

class MainController extends Controller
{            
   function dashboard(){
       $bulan = collect();
       $belumLunas = pembayaran::where('status_pembayaran', 'BELUM LUNAS')->get();
       for ($i=1; $i <= 12; $i++) { 
        $bulan->push(DB::table('pesanan')->whereMonth('updated_at', $i)->get()->count());
       }              

       $bulan = json_encode($bulan);
       return view('dashboard', compact('bulan', 'belumLunas'));
   }
}
