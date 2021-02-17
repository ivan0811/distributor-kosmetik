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
          <form action="{{route('update_sales')}}" id="form_sales" method="POST">       
            {{ csrf_field() }}
            {{ method_field('PATCH')}}
            <input type="hidden" name="id" value="{{$sales->id}}">
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Nama Sales</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" value="{{$sales->nama}}" class="form-control" id="nama" placeholder="Nama Sales" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="no_hp">Nomor HP</label> 
                    <div class="col-sm-10">
                      <input type="number" name="no_hp" value="{{$sales->no_hp}}" class="form-control" id="no_hp" placeholder="Nomor HP Yang Aktif" required>
                    </div>                  
                  </div>                                              
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="jk">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" id="jk1" value="L" {{ $sales->jk == 'L' ? 'checked' : ''}}>
                            <label class="form-check-label" for="jk1">
                              Laki laki
                            </label>
                          </div>
                        </div>              
                        <div class="col-6">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" id="jk2" value="P" {{ $sales->jk == 'P' ? 'checked' : ''}}>
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
                        <option value="">Pilih Kabupaten / Kota</option>       
                        @foreach ($getKabupaten as $item)
                            @if ($item->nama == $sales->kabupaten)
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
                        <option value="">Pilih Kecamatan</option>                             
                        <option value="{{$sales->kecamatan}}" selected>{{$sales->kecamatan}}</option>
                      </select>
                    </div>                    
                  </div>                                                                                          
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                    <div class="col-sm-10">
                      <textarea name="alamat" id="" placeholder="Alamat Lengkap" class="form-control" required>{{$sales->alamat}}</textarea>
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
@push('scripts')
<script type="text/javascript">      
 $('#kabupaten').change(function(){
        $('#kecamatan').empty();
        $('#kecamatan').append('<option selected>Pilih Kecamatan</option>');
        setKecamatan($(this).find(':selected').data('id'));
    });      
    setKecamatan($('#kabupaten').find(':selected').data('id'), '{{$sales->kecamatan}}');  
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
                  $('#kecamatan').append('<option value="'+x.nama+'">'+x.nama+'</option>');                    
                }
            },
            'error' : function(data){
                console.log(data);  
            }
        });       
    }    
    $('button#btn_submit').on('click', function(){            
      $('#form_sales').submit();
    });    
</script> 
@endpush