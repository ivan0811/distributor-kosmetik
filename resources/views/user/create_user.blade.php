@extends('navigation.navigation')
@section('title')
    User
@endsection
@section('header')
    Create User
@endsection
@section('content')                         
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Tambah User</h5>                    
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
          <form action="{{route('store_user')}}" id="form_user" method="POST">       
            {{ csrf_field() }}
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required>                    
                  </div>                  
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="username">Username</label>
                  <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>                    
                  </div>                  
                </div>                               
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="no_hp">Nomor HP</label> 
                  <div class="col-sm-10">
                    <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP Yang Aktif" required>
                  </div>                  
                </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="status">Status Level</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="status" name="status" required>
                        <option value="" selected>Pilih Status Level</option>       
                        <option value="1">Admin</option>
                        <option value="2">Petugas</option>
                      </select>
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
                    <label class="col-sm-2 col-form-label" for="kabupaten">Kabupaten / Kota</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="kabupaten" name="kabupaten" required>
                        <option value="" selected>Pilih Kabupaten / Kota</option>       
                        @foreach ($getProvinsi as $item) --}}
                            <option data-id="{{$item->id}}" value="{{$item->nama}}">{{$item->nama}}</option>
                         @endforeach                                                                       
                      </select>
                    </div>                    
                  </div>                                                               
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="kecamatan">Kecamatan</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="kecamatan" name="kecamatan" required>
                        <option value="" selected>Pilih Kecamatan</option>                    
                      </select>
                    </div>                    
                  </div>                                                                   
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                    <div class="col-sm-10">
                      <textarea name="alamat" id="" placeholder="Alamat Lengkap" class="form-control" required></textarea>
                    </div>                    
                  </div>                                                                           
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                      
                    </div>                    
                  </div>                                                                               
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="password">Password Baru</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Password Baru" required>                                        
                      <small id="help_password" class="form-text text-muted">
                        Password Harus Berjumlah 8 atau lebih
                      </small>
                      <div id="alert_password" class="invalid-feedback"></div>
                    </div>                    
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="konfirmasi_password">Konfirmasi Password</label>
                    <div class="col-sm-10">
                      <input type="password" id="konfirmasi_password" class="form-control" id="password" placeholder="Konfirmasi Password" required>                                        
                      <small id="help_confirm_password" class="form-text text-muted">
                        Konfirmasi Password harus sesuai dengan Password
                      </small>
                      <div id="alert_confirm_password" class="invalid-feedback">Konfirmasi Password Tidak Sesuai</div>
                    </div>                    
                  </div>                 
                </div>                                                                           
              <div class="footer-card-btn">
                <a href="{{route('user')}}" class="btn btn-light">Kembali</a>
                <button type="button" id="btn_submit" class="btn btn-primary">Simpan</button>
              </div>                                        
          </form>                                                
      </div>
    </div>
  </div>        
@endsection
@push('scripts')
<script type="text/javascript">    
    $('#kabupaten').change(function(){
        $('#kecamatan').empty();
        $('#kecamatan').append('<option value="" selected>Pilih Kecamatan</option>');
        $.ajax({        
            'url' : '{{route('get_kabupaten')}}',
            'type' : 'POST',        
            'data' : {
                '_token' : '{{csrf_token()}}',
                'kabupaten' : $(this).find(':selected').data('id')
            },
            'success' : function(data){                
                var item = $.parseJSON(data).kecamatan;                         
                for (const x of item) {
                    $('#kecamatan').append('<option value="'+x.nama+'">'+x.nama+'</option>');                    
                }
            },
            'error' : function(data){
                console.log(data);
            }
        });        
    });  
    
    var confirmPassword = (new_password) =>{      
      if(new_password.val() != $('#konfirmasi_password').val()){
        $('#konfirmasi_password').addClass('is-invalid');
        $('#help_confirm_password').hide();
        $('#alert_confirm_password').show().text('konfirmasi Password tidak sesuai!');          
      }   
      return new_password.val() != $('#konfirmasi_password').val();
    }

    $('#btn_submit').on('click', function(){
      var new_password = $('#password');     
      var confirmPass = confirmPassword(new_password);
      
      if(new_password.val().length < 8){
        new_password.addClass('is-invalid');
        $('#help_password').hide();
        $('#alert_password').show().text('password kurang dari 8!');          
      }else if(!confirmPass){        
        new_password.removeClass('is-invalid').addClass('is-valid');        
        $('#konfirmasi_password').removeClass('is-invalid').addClass('is-valid');        
        $('#alert_password').hide();
        $('#alert_confirm_password').hide();        
        $('#reset_password').modal('hide');
        $('#form_user').submit();
      }
    });            
</script>  

@endpush