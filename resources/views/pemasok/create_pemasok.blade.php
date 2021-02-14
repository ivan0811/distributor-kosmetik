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
          <form action="{{route('store_pemasok')}}" id="form_pemasok" method="POST">       
            {{ csrf_field() }}
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Kode Pabrik</label>
                  <div class="col-sm-10">
                    <input type="number" name="kode_pabrik" class="form-control" id="kode_pabrik" placeholder="Kode Pabrik" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="kode_bpom">Kode BPOM</label> 
                    <div class="col-sm-10">
                      <input type="number" name="kode_bpom" class="form-control" id="kode_bpom" placeholder="Kode BPOM" required>
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
                        <textarea class="form-control" placeholder="Masukkan alamat" id="alamat" name="alamat" style="height: 100px"></textarea>
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
    $('#kabupaten').change(function(){
      $('#kecamatan').empty();
      $('#kecamatan').append('<option selected>Pilih Kecamatan</option>');
      $.ajax({        
          'url' : '{{route('get_kabupaten')}}',
          'type' : 'POST',        
          'data' : {
              '_token' : '{{csrf_token()}}',
              'kabupaten' : $(this).find(':selected').data('id')
          },
          'success' : function(data){
              // console.log(data);                
              var item = $.parseJSON(data).kecamatan;
              // console.log(item.nama);                
              for (const x of item) {
                  $('#kecamatan').append('<option value="'+x.nama+'">'+x.nama+'</option>');                    
              }
          },
          'error' : function(data){
              console.log(data);
          }
      });        
  });  
</script>

@endpush
