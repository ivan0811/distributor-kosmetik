@extends('navigation.navigation')
@section('title')
    Barang Keluar
@endsection
@section('header')
    Edit Barang Keluar
@endsection
@section('content')                         
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Edit Barang Keluar</h5>                    
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
            <input type="hidden" name="id" value="{{$barangKeluar->barang_id}}">
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="barang_id">Barang Id</label>
                  <div class="col-sm-10">
                    <input type="text" name="barang_id" class="form-control" value="{{$barangKeluar->barang_id}}" id="nama" placeholder="Masukkan Id Barang" required>                    
                  </div>                  
                </div>                      
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="jumlah">Jumlah</label> 
                    <div class="col-sm-10">
                      <input type="number" name="jumlah" value="{{$barangKeluar->jumlah}}" class="form-control" id="jumlah" placeholder="Masukkan Jumlah" required>
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


@endpush