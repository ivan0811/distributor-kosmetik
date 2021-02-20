@extends('navigation.navigation')
@section('title')
    User
@endsection
@section('header')
    Menampilkan User
@endsection
@section('content')    
{{--
   NIM : 10119003
  Nama : Ivan Faathirza
  Kelas : IF1 
--}}                     
<div class="col-lg-12">
    <div class="custom-card">                  
      <div class="custom-card-header">
        <h5>Profile User</h5>                    
      </div>                                              
      @if ($errors->any() || session('error'))
          <div class="alert alert-danger">            
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach                
                  <li>{!! session('error') !!}</li>  
              </ul>
          </div>
      @endif         
      <div class="custom-card-body">                            
          <form action="{{route('update_profile')}}" id="form_user" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH')}}
            <div class="row">                
                <div class="col-md-2 text-center">  
                  <div class="row">
                    <div class="col-12">                                                                                        
                        @if (\Auth::user()->id == 1)
                        <div class="btn-upload-img-profile">   
                          <label for="upload_user_image">
                            <span class="fa fa-camera"></span>                            
                            <img src="{{asset('template/img/user1.svg')}}" alt="" class="upload-image-user img-fluid" id="user_pic">
                          </label>                                                                                                                                                           
                        </div>      
                        @else
                        <div class="btn-upload-img-profile">   
                        <label for="upload_user_image">
                          <span class="fa fa-camera"></span>                                               
                          @if ($user->foto == null)
                              <img src="{{asset('template/img/user1.svg')}}" alt="" class="upload-image-user img-fluid" id="user_pic">                                       
                          @else
                              <img src="{{asset('storage/profile/'.\Auth::user()->foto)}}" alt="" class="upload-image-user img-fluid" id="user_pic">                                       
                          @endif      
                          <input type="file" name="profile_image" id="upload_user_image">
                        </label>                        
                      </div>                                                                                                                                        
                        @endif                                                
                    </div>
                    <div class="col-12">
                      <h5 class="card-title">{{$user->username}}</h5>
                    </div>
                  </div>                              
                                              
                </div>                   
                <div class="col-md-10">                                        
                    <div class="container-fluid">   
                    <h5 class="card-title">
                        Informasi User
                        </h5>                            
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
                    @if (\Auth::user()->id != 1)
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
                        <label class="col-sm-2 col-form-label">Nomor HP</label>
                        <div class="col-sm-10">
                          <input type="text" name="no_hp" value="{{$user->no_hp}}" class="form-control" required>
                        </div>                                  
                      </div>                
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="kabupaten">Kabupaten / Kota</label>
                        <div class="col-sm-10">
                          <select class="form-control" id="kabupaten" name="kabupaten" required>
                            <option>Pilih Kabupaten / Kota</option>       
                            @foreach ($getProvinsi as $item)
                                @if ($item->nama == $user->kabupaten)
                                  <option data-id="{{$item->id}}" value="{{$item->nama}}" selected>{{$item->nama}}</option>
                                  @continue    
                                @endif                        
                                  <option data-id="{{$item->id}}" value="{{$item->nama}}">{{$item->nama}}</option>
                             @endforeach                                                                       
                          </select>
                        </div>                    
                      </div>                                                               
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="kecamatan">Kecamatan</label>
                        <div class="col-sm-10">
                          <select class="form-control" id="kecamatan" name="kecamatan" required>
                            <option>Pilih Kecamatan</option>                             
                            <option value="{{$user->kecamatan}}" selected>{{$user->kecamatan}}</option>
                          </select>
                        </div>                    
                      </div>                              
                    <div class="form-group row">                                  
                      <label class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea name="alamat" id="" class="form-control" required>{{$user->alamat}}</textarea>
                      </div>                                  
                    </div> 
                    @endif                                                 
                    <h5 class="card-title">
                        Password
                      </h5>                  
                      <div class="form-group row">                                  
                        <label class="col-sm-2 col-form-label">Password lama</label>
                        <div class="col-sm-10">
                          <input type="password" value="password" id="old_password" class="form-control" placeholder="Konfirmasi Password Lama">
                        </div>                                  
                      </div>                   
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="password">Password Baru</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="password" name="new_password" placeholder="Password Baru" required>                                        
                          <small id="help_password" class="form-text text-muted">
                            Password Harus Berjumlah 8 atau lebih, kosongkan jika tidak ganti password
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
                  </div>                                                     
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
        $('#kecamatan').append('<option selected>Pilih Kecamatan</option>');
        setKecamatan($(this).find(':selected').data('id'));
    });      
    setKecamatan($('#kabupaten').find(':selected').data('id'), '{{$user->kecamatan}}');  
    function setKecamatan(id, selected = ''){
      $.ajax({        
            'url' : '{{route('get_kabupaten')}}',
            'type' : 'POST',        
            'data' : {
                '_token' : '{{csrf_token()}}',
                'kabupaten' : id
            },
            'success' : function(data){                       
                var item = $.parseJSON(data).kecamatan;                
                for (const x of item) {
                  if(selected == x.nama){                    
                    continue;
                  }                    
                  $('#kecamatan').append('<option value="'+x.nama+'">'+x.nama+'</option>');                    
                }
            },
            'error' : function(data){
                console.log(data);  
            }
        });       
    }

    $('button.btn_submit').on('click', function(){            
      $('#form_user').submit();
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
      
      if(new_password.val().length < 8 && new_password.val() != ''){
        new_password.addClass('is-invalid');
        $('#help_password').hide();
        $('#alert_password').show().text('password kurang dari 8!');          
      }else if(!confirmPass){        
        if(new_password.val() != '' && $('#konfirmasi_password').val() != ''){
          new_password.removeClass('is-invalid').addClass('is-valid');        
          $('#konfirmasi_password').removeClass('is-invalid').addClass('is-valid');        
          $('#alert_password').hide();
          $('#alert_confirm_password').hide();        
        }                
        $('#form_user').submit();
      }
    });   

    function readProfile(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();          
          reader.onload = function(e) {
            $('#user_pic').attr('src', e.target.result);
            $('#user_pic').css('opacity', 'unset');
            $('.btn-upload-img-profile > label > span').css('opacity', '0');
          }          
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }      
      
      $("#upload_user_image").change(function() {                
        readProfile(this);
      });

      $('#old_password').val('');
        
</script>  
@endpush