@extends('navigation.navigation')
@section('title')
    Barang Masuk
@endsection
@section('header')
    Edit Barang Masuk
@endsection
@section('content') 
{{--
   NIM : 10119026
  Nama : Muhammad Khatami
  Kelas : IF1 
--}}                        
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Edit Barang Masuk</h5>                    
      </div>               
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif                       
      <div class="custom-card-body">                                                                  
          <form action="{{route('update_barang_masuk')}}" id="form_barang" method="POST">       
            {{ csrf_field() }}
            {{ method_field('PATCH')}}
            <input type="hidden" name="barang_id" value="{{$barangMasuk->id}}">
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="barang_id">Barang Id</label>
                  <div class="col-sm-10">
                    <input type="text" name="" class="form-control" value="{{$barangMasuk->barang->nama}}" id="nama" placeholder="Masukkan Id Barang" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="kode_pabrik">Kode Pabrik</label> 
                  <div class="col-sm-10">
                    <select name="kode_pabrik" id="" class="form-control" required>
                      <option value="" selected>Pilih Pemasok</option>
                      @foreach ($pemasok as $item)
                      @if ($item->kode_pabrik == $barangMasuk->kode_pabrik)
                        <option value="{{$item->kode_pabrik}}" selected>{{$item->kode_pabrik}}</option>
                        @continue
                      @endif
                          <option value="{{$item->kode_pabrik}}">{{$item->kode_pabrik}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>                                                        
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="jumlah">Jumlah</label> 
                    <div class="col-sm-10">
                      <input type="hidden" name="before_jumlah" value="{{$barangMasuk->jumlah}}">
                      <input type="number" name="jumlah" value="{{$barangMasuk->jumlah}}" class="form-control" id="jumlah" placeholder="Masukkan Jumlah" required>
                    </div>                  
                  </div>                                                                                                                                                                                                                                                                                               
                </div>                                                                           
                <div class="footer-card-btn">                
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#confirm_modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>                                         
          </form>                                                
      </div>
    </div>
  </div>
  
@endsection
