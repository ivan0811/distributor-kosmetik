@extends('navigation.navigation')
@section('title')
    Rekening
@endsection
@section('header')
    Create Rekening
@endsection
@section('content')    
                     
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Tambah Rekening</h5>                    
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
          <form action="{{route('store_rekening')}}" method="POST">       
            {{ csrf_field() }}
            <div class="container-fluid">
             <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="norek">No Rekening</label> 
                    <div class="col-sm-10">
                      <input type="number" name="norek" class="form-control" id="no rekening" placeholder="No Rekening" required>
                    </div>                  
                  </div>                                              
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="kode_bank">Kode Bank</label> 
                    <div class="col-sm-10">
                        <select class="form-control" id="kode_bank" name="kode_bank" required>
                            <option value="" selected>Pilih Kode Bank</option>       
                            @foreach ($bank as $item) --}}
                                <option value="{{$item->kode_bank}}">{{$item->nama_bank}}</option>
                            @endforeach                                                                       
                        </select>
                    </div>                  
                  </div>                                              
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="Atas Nama">Atas Nama</label>
                  <div class="col-sm-10">
                    <input type="text" name="atas_nama" class="form-control" id="atas_nama" placeholder="Atas Nama" required>                    
                </div>                                                                                                                                                                               
              <div class="footer-card-btn">
                <a href="{{route('rekening')}}" class="btn btn-light">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>                                        
          </form>                                                
      </div>
    </div>
  </div>        
@endsection