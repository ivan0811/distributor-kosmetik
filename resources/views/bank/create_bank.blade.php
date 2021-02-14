@extends('navigation.navigation')
@section('title')
    Bank
@endsection
@section('header')
    Create Bank
@endsection
@section('content')                         
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Tambah Bank</h5>                    
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
          <form action="{{route('store_bank')}}" method="POST">       
            {{ csrf_field() }}
            <div class="container-fluid">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="kode_bank">Kode Bank</label> 
                    <div class="col-sm-10">
                      <input type="number" name="kode_bank" class="form-control" id="kode bank" placeholder="Kode Bank" required>
                    </div>                  
                  </div>                                              
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="Nama Bank">Nama Bank</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_bank" class="form-control" id="nama_bank" placeholder="Nama Bank" required>                    
                </div>                                                                                                                                                                               
              <div class="footer-card-btn">
                <a href="{{route('toko')}}" class="btn btn-light">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>                                        
          </form>                                                
      </div>
    </div>
  </div>        
@endsection