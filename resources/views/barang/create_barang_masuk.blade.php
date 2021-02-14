@extends('navigation.navigation')
@section('title')
    Barang Masuk
@endsection
@section('header')
    Create Barang Masuk
@endsection
@section('content')                         
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Tambah Barang Masuk</h5>                    
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
          <form action="{{route('store_barang_masuk')}}" id="form_barang" method="POST">       
            {{ csrf_field() }}
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="id_barang">Id Barang</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="kode_pabrik">Kode Pabrik</label> 
                    <div class="col-sm-10">
                      <input type="number" name="kode_pabrik" class="form-control" id="kode_pabrik" placeholder="Masukkan Kode Pabrik" required>
                    </div>
                  </div> 
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="harga_jual">Tanggal</label> 
                      <div class="col-sm-10">
                        <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="jumlah">Jumlah</label> 
                      <div class="col-sm-10">
                        <input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="Masukkan Jumlah" required>
                      </div>
                    </div>                                                                                                                                                                                                                                                                                                           
              <div class="footer-card-btn">
                <a href="{{route('barang')}}" class="btn btn-light">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>                                        
          </form>                                                
      </div>
    </div>
  </div>
  @endsection