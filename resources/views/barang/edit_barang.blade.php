@extends('navigation.navigation')
@section('title')
    Barang
@endsection
@section('header')
    Edit Barang
@endsection
@section('content')                         
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Edit Barang</h5>                    
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
          <form action="{{route('update_barang')}}" id="form_barang" method="POST">       
            {{ csrf_field() }}
            {{ method_field('PATCH')}}
            <input type="hidden" name="id" value="{{$barang->id}}">
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Nama Barang</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="{{$barang->nama}}" id="nama" placeholder="Nama Barang" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="stok">Stok</label> 
                    <div class="col-sm-10">
                      <input type="number" name="stok" value="{{$barang->stok}}" class="form-control" id="stok" placeholder="Stok yang tersedia" required>
                    </div>                  
                  </div>                                                               
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="harga_jual">Harga Jual</label> 
                    <div class="col-sm-10">
                      <input type="number" name="harga_jual" value="{{$barang->harga_jual}}" class="form-control" id="harga_pabrik" placeholder="Masukkan Harga Jual" required>
                    </div>                  
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="harga_pabrik">Harga Pabrik</label> 
                    <div class="col-sm-10">
                      <input type="number" name="harga_pabrik" value="{{$barang->harga_pabrik}}" class="form-control" id="harga_pabrik" placeholder="Masukkan Harga Pabrik" required>
                    </div>                  
                  </div>                                                                                                                                                                                        
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="discount">Discount</label>
                    <div class="col-sm-10">
                      <textarea name="discount" id="" placeholder="Masukkan Discount" class="form-control" required>{{$barang->discount}}</textarea>
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
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Edit Barang Masuk</h5>                    
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
          <form action="{{route('update_barang')}}" id="form_barang" method="POST">       
            {{ csrf_field() }}
            {{ method_field('PATCH')}}
            <input type="hidden" name="id" value="{{$barang->id}}">
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Nama Barang</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="{{$barang->nama}}" id="nama" placeholder="Nama Barang" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="stok">Stok</label> 
                    <div class="col-sm-10">
                      <input type="number" name="stok" value="{{$barang->stok}}" class="form-control" id="stok" placeholder="Stok yang tersedia" required>
                    </div>                  
                  </div>                                                               
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="harga_jual">Harga Jual</label> 
                    <div class="col-sm-10">
                      <input type="number" name="harga_jual" value="{{$barang->harga_jual}}" class="form-control" id="harga_pabrik" placeholder="Masukkan Harga Jual" required>
                    </div>                  
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="harga_pabrik">Harga Pabrik</label> 
                    <div class="col-sm-10">
                      <input type="number" name="harga_pabrik" value="{{$barang->harga_pabrik}}" class="form-control" id="harga_pabrik" placeholder="Masukkan Harga Pabrik" required>
                    </div>                  
                  </div>                                                                                                                                                                                        
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="discount">Discount</label>
                    <div class="col-sm-10">
                      <textarea name="discount" id="" placeholder="Masukkan Discount" class="form-control" required>{{$barang->discount}}</textarea>
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
          <form action="{{route('update_barang')}}" id="form_barang" method="POST">       
            {{ csrf_field() }}
            {{ method_field('PATCH')}}
            <input type="hidden" name="id" value="{{$barang->id}}">
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Nama Barang</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="{{$barang->nama}}" id="nama" placeholder="Nama Barang" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="stok">Stok</label> 
                    <div class="col-sm-10">
                      <input type="number" name="stok" value="{{$barang->stok}}" class="form-control" id="stok" placeholder="Stok yang tersedia" required>
                    </div>                  
                  </div>                                                               
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="harga_jual">Harga Jual</label> 
                    <div class="col-sm-10">
                      <input type="number" name="harga_jual" value="{{$barang->harga_jual}}" class="form-control" id="harga_pabrik" placeholder="Masukkan Harga Jual" required>
                    </div>                  
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="harga_pabrik">Harga Pabrik</label> 
                    <div class="col-sm-10">
                      <input type="number" name="harga_pabrik" value="{{$barang->harga_pabrik}}" class="form-control" id="harga_pabrik" placeholder="Masukkan Harga Pabrik" required>
                    </div>                  
                  </div>                                                                                                                                                                                        
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="discount">Discount</label>
                    <div class="col-sm-10">
                      <textarea name="discount" id="" placeholder="Masukkan Discount" class="form-control" required>{{$barang->discount}}</textarea>
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
    setKecamatan($('#kabupaten').find(':selected').data('id'), '{{$toko->kecamatan}}');  
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
    $('button#btn_submit').on('click', function(){            
      $('#form_toko').submit();
    });    
</script>  

@endpush