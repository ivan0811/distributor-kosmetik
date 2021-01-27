<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends MessageController
{
    protected $getProvinsi;         
    
    public function __construct()
    {
        try {
            $this->getProvinsi = collect(json_decode($this->getProvinsi()))['kota_kabupaten'];
        } catch (\Throwable $th) {
            $this->getProvinsi = $this->dangerToast('koneksi error periksa kembali koneksi internet anda');
        }        
    }
    
    function getProvinsi(){                
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=13';
        $get_provinsi = file_get_contents($url);                                    
        return $get_provinsi;
    }

    function getKabupaten(Request $request){        
        $city = $request->kabupaten;
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota='.$city;
        $getKabupaten = file_get_contents($url);                        
        return $getKabupaten;
    }    
}
