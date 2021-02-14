@extends('navigation.navigation')
@section('title')
    Barang
@endsection
@section('header')
    Create Barang
@endsection
@section('content')                         
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Tambah Barang</h5>                    
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
          <form action="{{route('store_barang')}}" id="form_barang" method="POST">       
            {{ csrf_field() }}
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Nama Barang</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang" required>                    
                  </div>                  
                </div>                      
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="stok">Stok</label> 
                    <div class="col-sm-10">
                      <input type="number" name="stok" class="form-control" id="stok" placeholder="Stok Yang Tersedia" required>
                    </div>
                  </div> 
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="harga_jual">Harga Jual</label> 
                      <div class="col-sm-10">
                        <input type="number" name="harga_jual" class="form-control" id="harga_jual" placeholder="Masukkan Harga Jual" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="harga_pabrik">Harga Pabrik</label> 
                      <div class="col-sm-10">
                        <input type="number" name="harga_pabrik" class="form-control" id="harga_pabrik" placeholder="Masukkan Harga Pabrik" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="discount">Discount</label> 
                      <div class="col-sm-10">
                        <input type="number" name="discount" class="form-control" id="discount" placeholder="Masukkan Discount" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Satuan</label>
                      <div class="col-sm-6">
                        <select class="custom-select" size="3" id="select_satuan">
                          <option selected>Pilih Satuan</option>
                          <option value="1">PCS</option>                              
                          <option value="2">LSN</option>                              
                        </select>
                      </div>
                      <div class="col-sm-2">
                        <button class="btn btn-danger" type="button" id="delete_confirm">Hapus</button>
                      </div>
                    </div>                        
                    <div class="form-group row">
                      <label for="" class="col-sm-4 col-form-label">Tambah Satuan</label>
                      <div class="col-sm-8">
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Tambah Satuan Baru" id="add_satuan_input">
                          <div class="input-group-append">
                            <button class="btn btn-outline-success" type="button" id="add_satuan">Tambah</button>
                          </div>
                        </div>
                      </div>
                    </div>
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
  function getValueSatuan(){
    var arrValSatuan = [];
    for (const x of $('#select_satuan > option')) {        
      var satuan_value = parseInt($(x).val());
      if(typeof satuan_value == "number" && !isNaN(satuan_value)){            
        arrValSatuan.push(satuan_value);
      }        
    }        
    return Math.max(...arrValSatuan);
  }

  $('#add_satuan').click(function(){
    $('#select_satuan').append('<option value="'+(getValueSatuan()+1)+'">'+$('#add_satuan_input').val()+'</option>');
    $('#add_satuan_input').val('');
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
    $('#select_satuan > option:selected').remove();
    $('#modal_confirm_satuan').modal('hide');
  });
  </script>

  @endpush