@extends('navigation.navigation')
@section('title')
    User
@endsection
@section('header')
    Menampilkan User
@endsection
@section('content')                         
<div class="col-lg-12">
    <div class="custom-card">                  
      <div class="custom-card-header">
        <h5>Profile User</h5>                    
      </div>                                      
      <div class="custom-card-body">                    
            <div class="row">                
                <div class="col-md-2 text-center">  
                  <div class="row">
                    <div class="col-12">
                      <div class="img-profile">   
                          <label for="upload_user_image">
                            <span class="fa fa-camera"></span>
                            @if ($user->foto == null)
                                <img src="{{asset('template/img/user1.svg')}}" alt="" class="upload-image-user img-fluid" id="user_pic">                                       
                            @else
                                <img src="{{asset('storage/profile/'.$user->foto)}}" alt="" class="show-image-user img-fluid" id="user_pic">                                       
                            @endif                            
                          </label>                                                                                                                                                           
                      </div>     
                    </div>
                    <div class="col-12">
                      <h5 class="card-title">{{$user->username}}</h5>
                    </div>
                  </div>                              
                                              
                </div>                   
                <div class="col-md-10">                                        
                    <div class="container-fluid">                            
                  <div class="form-group row">                                  
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{$user->name}}" class="form-control-plaintext" readonly>
                    </div>                                  
                  </div>                  
                    <div class="form-group row">                                  
                      <label class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" value="{{$user->email}}" class="form-control-plaintext" readonly>
                      </div>                                  
                    </div>
                    <div class="form-group row">                                  
                        <label class="col-sm-2 col-form-label">Nomor HP</label>
                        <div class="col-sm-10">
                          <input type="email" value="{{$user->no_hp}}" class="form-control-plaintext" readonly>
                        </div>                                  
                      </div>
                    <div class="form-group row">                                  
                      <label class="col-sm-2 col-form-label">Status</label>
                      <div class="col-sm-10">
                        <input type="text" value="Petugas" class="form-control-plaintext" readonly>
                      </div>                                  
                    </div>     
                    <div class="form-group row">                                  
                      <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                      <div class="col-sm-10">
                          @php
                              $jk = (($user->jk == "L") ? "Laki-laki" : (($user->jk == "P") ? "Perempuan": ''));                                
                          @endphp
                        <input type="text" value="{{$jk}}" class="form-control-plaintext" readonly>                        
                      </div>                                  
                    </div>                   
                    <div class="form-group row">                                  
                        <label class="col-sm-2 col-form-label">Kabupaten</label>
                        <div class="col-sm-10">
                          <input type="text" value="{{$user->kabupaten}}" class="form-control-plaintext" readonly>
                        </div>                                  
                      </div>     
                      <div class="form-group row">                                  
                        <label class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-10">
                          <input type="text" value="{{$user->kecamatan}}" class="form-control-plaintext" readonly>
                        </div>                                  
                      </div>     
                    <div class="form-group row">                                  
                      <label class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea name="" id="" class="form-control-plaintext">{{$user->alamat}}</textarea>
                      </div>                                  
                    </div>     
                </div>                       
                    <div class="footer-card-btn">
                        <a href="{{route('user')}}" class="btn btn-light">Kembali</a>                
                      </div>                                
                  </div>                                                     
                </div>                                                                                                                                
      </div>
    </div>
  </div>  
@endsection