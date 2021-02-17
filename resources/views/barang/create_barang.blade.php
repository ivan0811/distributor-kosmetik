@extends('navigation.navigation')
@section('title')
    Barang
@endsection
@section('header')
    Create Barang
@endsection
@section('content')      
<form action="{{route('store_barang')}}" id="form_barang" method="POST" class="col-sm-12">                        
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h4>Form Tambah Barang</h4>                    
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
            {{ csrf_field() }}
            <div class="container-fluid">
              <h5 class="card-title mb-4">
                Barang
              </h5>
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Nama Barang</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="stok">Kode BPOM</label> 
                    <div class="col-sm-10">
                      <input type="number" name="kode_bpom" class="form-control" placeholder="Masukkkan Kode BPOM" required>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="harga_pabrik">Harga Pabrik</label> 
                    <div class="col-sm-4">
                      <input type="number" name="harga_pabrik" class="form-control" id="harga_pabrik" placeholder="Masukkan Harga Pabrik" required>
                    </div>
                  </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="harga_jual">Harga Jual</label> 
                      <div class="col-sm-4">
                        <input type="number" name="harga_jual" class="form-control" id="harga_jual" placeholder="Masukkan Harga Jual" required>
                      </div>
                    </div>  
                                   
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="discount">Discount</label> 
                      <div class="input-group col-sm-2">
                        <input type="number" name="discount" class="form-control" id="discount" placeholder="Discount" required>
                        <div class="input-group-append">
                          <span class="input-group-text">%</span>                          
                        </div>
                      </div>                        
                    </div>
                    <h5 class="card-title mb-4 mt-4">
                      Satuan
                    </h5>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Pilih Satuan</label>
                      <div class="col-sm-4" id="satuan_box">                         
                        <select class="custom-select" name="satuan_id" size="3" id="select_satuan" required>                          
                            @foreach ($satuan as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach                                
                        </select>
                      </div>
                      <div class="col-sm-2">
                        <button class="btn btn-danger" type="button" id="delete_confirm">Hapus</button>
                      </div>
                    </div>                        
                    <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Tambah Satuan</label>
                      <div class="col-sm-4">
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Tambah Satuan Baru" id="add_satuan_input">
                          <div class="input-group-append">
                            <button class="btn btn-outline-success" type="button" id="add_satuan">Tambah</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>                    
                    
                      <div class="custom-card">
                        <div class="d-flex">
                          <div class="ml-auto">          
                            <a href="{{route('barang')}}" class="btn btn-light mr-2">Kembali</a>                
                            <button type="submit" class="btn-custom-submit">Simpan</button>      
                          </div>      
                      </div>
                    </div>                                           
                </form>  

                    <div class="modal fade" id="modal_confirm_satuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Satuan?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">              
                            Jika Menghapus Satuan akan mengosongkan atau set null yang memakai satuan <span id="confirm_satuan"></span> ?
                          </div>
                          <div class="modal-footer">              
                            <button type="button" id="delete_satuan" class="btn btn-danger">Hapus</button>
                          </div>
                        </div>
                      </div>
                    </div>                                              
     
  @endsection
  @push('scripts')
  <script type="text/javascript">
  function getValueSatuan(){
    var arrValSatuan = [];
    for (const x of $('#select_satuan > option')) {        
      var satuan_value = parseInt($(x).val());
      if(typeof satuan_value == "number" && !isNaN(satuan_value)){            
        arrValSatuan.push(satuan_value);
      }        
    }        
    return arrValSatuan.length == 0 ? 0 : Math.max(...arrValSatuan);
  }

  $('#add_satuan').click(function(){    
    if($('#add_satuan_input').val() != ''){
      var valId = getValueSatuan()+1;
      $('#select_satuan').append('<option value="'+valId+'">'+$('#add_satuan_input').val()+'</option>');            
      $('#satuan_box').append('<input class="satuan" type="hidden" name="satuan[]" value="'+$('#add_satuan_input').val()+'">')
      $('#satuan_box').append('<input class="id_satuan" type="hidden" name="id_satuan[]" value="'+valId+'">')
      $('#add_satuan_input').val('');      
    }        
  });      

  $('#delete_confirm').click(function(){                
    var satuanSelected = $('#select_satuan > option:selected');
    $('#confirm_satuan').text(satuanSelected.text());        
    var valSatuan = satuanSelected.val();
    if(valSatuan != undefined && valSatuan.match(/^\d+$/g)){
      $('#modal_confirm_satuan').modal('show');
    }                
  });

  $('#delete_satuan').click(function(){
    var getIndex = $('#select_satuan > option:selected').index();
    $('#satuan_box').append('<input type="hidden" name="id_satuan_del[]" value="'+$('#select_satuan > option:selected').val()+'">')
    $($('#satuan_box > input.satuan')[getIndex]).remove();
    $($('#satuan_box > input.id_satuan')[getIndex]).remove();    
    $('#select_satuan > option:selected').remove();    
    $('#modal_confirm_satuan').modal('hide');
  });
  </script>

  @endpush