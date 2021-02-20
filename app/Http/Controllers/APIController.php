<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
    NIM : 10119003
    Nama : Ivan Faathirza
    Kelas : IF1
*/

class APIController extends MessageController
{
    protected $getProvinsi;  
    protected $getKabupaten;          
    public function __construct()
    {
        
            $this->getProvinsi = collect(json_decode($this->getProvinsi()))['provinsi'];
            $this->getKabupaten = collect(json_decode($this->getKabupaten(13)))['kota_kabupaten'];        
    }

    function getProvinsi(){
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/provinsi';
        $getProvinsi = file_get_contents($url);
        return $getProvinsi;
    }    

    function getKabupaten($provinsi){                        
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi='.$provinsi;
        $getKabupaten = file_get_contents($url);                                    
        return $getKabupaten;
    }   

    function getKabupatenReq(Request $request){
        return $this->getKabupaten($request->provinsi);
    }
        
    function getKecamatan(Request $request){        
        $city = $request->kabupaten;
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota='.$city;
        $getKecamatan = file_get_contents($url);                        
        return $getKecamatan;
    }
}
