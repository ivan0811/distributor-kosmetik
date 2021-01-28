@extends('navigation.navigation')
@section('title')
    Sales
@endsection
@section('header')
    Create Sales
@endsection
@section('content')                         
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Tambah Sales</h5>                    
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
          <form action="{{route('store_sales')}}" method="POST">       
            {{ csrf_field() }}
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Nama Sales</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Sales" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="no_hp">Nomor HP</label> 
                    <div class="col-sm-10">
                      <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP Yang Aktif" required>
                    </div>                  
                  </div>                                              
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="jk">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" id="jk1" value="L" checked>
                            <label class="form-check-label" for="jk1">
                              Laki laki
                            </label>
                          </div>
                        </div>              
                        <div class="col-6">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" id="jk2" value="P">
                            <label class="form-check-label" for="jk2">
                              Perempuan
                            </label>
                          </div>
                        </div>                                  
                      </div>                     
                    </div>                    
                  </div>                                                                                                     
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                    <div class="col-sm-10">
                      <textarea name="alamat" id="" placeholder="Alamat Lengkap" class="form-control" required></textarea>
                    </div>                    
                  </div>                                                                                                         
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