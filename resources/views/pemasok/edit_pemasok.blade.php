@extends('navigation.navigation')
@section('title')
    Pemasok
@endsection
@section('header')
    Create Pemasok
@endsection
@section('content')                         
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Tambah Pemasok</h5>                    
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
          <form action="{{route('update_pemasok')}}" id="form_pemasok" method="POST">       
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Kode Pabrik</label>
                  <div class="col-sm-10">
                    <input type="number" value="{{$pemasok->kode_pabrik}}" name="kode_pabrik" class="form-control" id="kode_pabrik" placeholder="Kode Pabrik" required>                    
                  </div>                  
                </div>                                      
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Nama Pemasok</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" value="{{$pemasok->nama}}" class="form-control" id="kode_pabrik" placeholder="Nama Pemasok" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Rekening</label> 
                  <div class="col-sm-10">
                    <select class="form-control" id="rekening" name="norek">
                      <option value="" selected>Pilih Rekening</option>       
                      @foreach ($rekening as $item) 
                      @if ($item->norek == $pemasok->norek)
                        <option value="{{$item->norek}}" selected>{{$item->norek}}</option>
                        @continue
                      @endif
                          <option value="{{$item->norek}}">{{$item->norek}}</option>
                       @endforeach                                                                       
                    </select>
                  </div>
                </div> 
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="provinsi">Provinsi</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="provinsi" name="provinsi" required>
                        <option value="" selected>Pilih Provinsi</option>       
                        @foreach ($getProvinsi as $item)
                          @if ($item->nama == $pemasok->provinsi)
                            <option data-id="{{$item->id}}" value="{{$item->nama}}" selected>{{$item->nama}}</option>
                            @continue
                          @endif
                            <option data-id="{{$item->id}}" value="{{$item->nama}}">{{$item->nama}}</option>
                         @endforeach                                                                       
                      </select>
                    </div>                    
                  </div>  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="kabupaten">Kabupaten / Kota</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="kabupaten" name="kabupaten" required>
                        <option value="" selected>Pilih Kabupaten / Kota</option>                                                       
                        <option data-id="{{$pemasok->id}}" value="{{$pemasok->kabupaten}}" selected>{{$pemasok->kabupaten}}</option>   
                      </select>
                    </div>                    
                  </div>                       
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="kecamatan">Kecamatan</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="kecamatan" name="kecamatan" required>
                        <option value="" selected>Pilih Kecamatan</option>                    
                        <option value="{{$pemasok->kecamatan}}" selected>{{$pemasok->kecamatan}}</option>   
                      </select>
                    </div>                    
                  </div>   
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="alamat" value="{{$pemasok->alamat}}" placeholder="Masukkan alamat" id="alamat" style="height: 100px"></textarea>
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
@push('scripts')
<script type="text/javascript">    
    $('#provinsi').change(function(){
        $('#kabupaten').empty();
        $('#kabupaten').append('<option selected>Pilih Kabupaten /Kota</option>');
        setKabupaten($(this).find(':selected').data('id'));
    });  

    $('#kabupaten').change(function(){
        $('#kecamatan').empty();
        $('#kecamatan').append('<option selected>Pilih Kecamatan</option>');
        setKecamatan($(this).find(':selected').data('id'));
    });  
    setKabupaten($('#provinsi').find(':selected').data('id'), '{{$pemasok->kabupaten}}');  
    function setKabupaten(id, selected = ''){      
      $.ajax({        
            'url' : '{{route('get_kabupaten')}}',
            'type' : 'POST',        
            'data' : {
                '_token' : '{{csrf_token()}}',
                'provinsi' : id
            },
            'success' : function(data){                                                 
                var item = $.parseJSON(data).kota_kabupaten;                                
                for (const x of item) {
                  if(selected == x.nama){  
                    $('#kabupaten').append('<option data-id="'+x.id+'" value="'+x.nama+'">'+x.nama+'</option>');                                      
                    continue;
                  }                    
                  $('#kabupaten').append('<option data-id="'+x.id+'" value="'+x.nama+'">'+x.nama+'</option>');                    
                }
            },
            'error' : function(data){
                console.log(data);  
            }
        });       
    }

    setKecamatan($('#kabupaten').find(':selected').data('id'), '{{$pemasok->kecamatan}}');  
    function setKecamatan(id, selected = ''){
      $.ajax({        
            'url' : '{{route('get_kecamatan')}}',
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
                  $('#kecamatan').append('<option data-id="'+x.id+'" value="'+x.nama+'">'+x.nama+'</option>');                    
                }
            },
            'error' : function(data){
                console.log(data);  
            }
        });       
    }

    $('button#btn_submit').on('click', function(){            
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

    $('#save_password').click(function(){
      var new_password = $('#password');     
      var confirmPass = confirmPassword(new_password);
      
      if(new_password.val().length < 8){
        new_password.addClass('is-invalid');
        $('#help_password').hide();
        $('#alert_password').show().text('password kurang dari 8!');          
      }else if(!confirmPass){
        console.log(true);
        new_password.removeClass('is-invalid').addClass('is-valid');        
        $('#konfirmasi_password').removeClass('is-invalid').addClass('is-valid');        
        $('#alert_password').hide();
        $('#alert_confirm_password').hide();
        $('#set_password').val(new_password.val());
        $('#reset_password').modal('hide');
      }
    });
</script>  

@endpush
