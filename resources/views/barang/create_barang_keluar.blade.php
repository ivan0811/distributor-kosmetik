@extends('navigation.navigation')
@section('title')
    Barang Masuk
@endsection
@section('header')
    Create Barang Masuk
@endsection
@section('content')
{{--
   NIM : 10119026
  Nama : Muhammad Khatami
  Kelas : IF1 
--}}      
<form action="{{route('store_barang_keluar')}}"  method="POST" class="col-md-12">                            
  {{ csrf_field() }}
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Barang Masuk</h5>                    
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
            <div class="container-fluid">                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="kode_pabrik">Kode Pabrik</label> 
                    <div class="col-sm-10">
                      <select name="kode_pabrik" id="" class="form-control" required>
                        <option value="" selected>Pilih Pemasok</option>
                        @foreach ($pemasok as $item)
                            <option value="{{$item->kode_pabrik}}">{{$item->kode_pabrik}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div> 
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="harga_jual">Tanggal</label> 
                      <div class="col-sm-10">
                        <input type="date" name="tanggal" class="form-control" id="barang_masuk_date" placeholder="" required>
                      </div>
                    </div>                                                                                  
      </div>
    </div>
  </div>
  
  <div class="custom-card">                  
    <div class="custom-card-header with-tools">                                                                  
          <h5>Barang</h5>                                                                                                                                                                      
    </div>        
    <div class="container-fluid">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="d-flex row">            
            <div class="p-2 d-inline-flex">
              <a href="#" class="btn-custom btn-custom-success" data-toggle="modal" data-target="#modal_barang"><span class="fa fa-plus"></span> Tambah Barang</a>                                           
            </div>                                                            
            <div class="ml-auto p-2">                          
                <input class="form-control search-box" type="text" placeholder="Search" aria-label="Search">                                                      
            </div>                                    
          </div>                                                                                            
      </li>      
      </ul>                        
    <div class="custom-card-body-table table-responsive">
      <table class="table table-fixed display nowrap"  id="data_table" width="100%">
        <thead>
          <tr>            
            <th scope="col">Nama Barang</th>
            <th scope="col">Stok</th>
            <th scope="col" width="100px">Jumlah</th>                   
            <th scope="col">Harga Pabrik</th>   
            <th scope="col">Satuan</th>   
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody class="search-table" id="fill_barang_table">               

        </tbody>
      </table>
    </div>
    <div class="d-flex mt-2">
      <div class="align-self-center p-2">

        <p class="text-card" style="margin-bottom: 0">Total Barang : <span class="total-row"></span></p>              
      </div>
      <div class="ml-auto p-2">
        <nav class="pagination-table" aria-label="Page navigation example">
          <ul class="pagination">
           
          </ul>
        </nav>
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

<div class="modal fade" id="modal_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">    
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="d-flex row">                                                                          
              <div class="ml-auto p-2">                          
                  <input class="form-control search-box" type="text" placeholder="Search" aria-label="Search">                                                      
              </div>                                    
            </div>                                                                                            
        </li>      
        </ul>             
        <div class="custom-card-body-table table-responsive" style="max-height: 440px;">
          <table class="table">
            <thead>
              <tr>                
                <th scope="col">Pilih</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga Pabrik</th>                                                                                
                <th scope="col">Satuan</th>                                                                                
              </tr>
            </thead>
            <tbody class="search-table" id="fill_barang">          
                @foreach ($barang as $key => $item)                
              <tr id="key_barang{{$key}}" data-key="{{$key}}">                                                                   
                  <td>
                    <div class="custom-control custom-checkbox mt-0">
                      <input type="checkbox" class="custom-control-input checkbox-barang" id="barang{{$key}}">
                      <label class="custom-control-label" for="barang{{$key}}"></label>
                    </div>
                  </td>
                  <td class="nama_barang"><input class="id_barang" type="hidden" value="{{$item->id}}">{{$item->nama}}</td>                
                  <td class="stok">{{$item->stok}}</td>                
                  <td class="harga_pabrik">{{$item->harga_pabrik}}</td>
                  <td class="satuan">{{$item->satuan->nama}}</td>                     
                </tr>                                       
                @endforeach              
            </tbody>
          </table>
        </div> 
      </div>
      <div class="modal-footer">              
        <a href="#" id="tambah_barang" class="btn-custom btn-custom-success">Tambahkan</a>
      </div>
    </div>
  </div>
</div>     
  @endsection
  @push('scripts')
      <script>                
        $('#tambah_barang').click(function(){                               
          for (const item of $('input.checkbox-barang:checked')) {
            var getTr = $(item).parent().parent().parent();
            var id_barang = getTr.find('input.id_barang').val();
            var nama_barang = getTr.find('td.nama_barang').text()
            var stok = getTr.find('td.stok').text()
            var harga_pabrik = getTr.find('td.harga_pabrik').text()
            var satuan = getTr.find('td.satuan').text()
            $('#fill_barang_table').append(
              '<tr id="data_barang'+getTr.data('key')+'">'+              
              '<td><input class="id_barang_table" type="hidden" name="id_barang[]" value="'+id_barang+'">'+nama_barang+'</td>                '+
              '<td>'+stok+'</td>                '+
              '<td><input name="jumlah[]" type="number" class="form-control" value="0"></td>     '+
              '<td>'+harga_pabrik+'</td>'+
              '<td>'+satuan+'</td>'+
              '<td>'+
              '      <div class="d-flex">'+
              '      <div class="p-1">'+
              '          <button id="delete_barang'+getTr.data('key')+'" onclick="delete_barang('+getTr.data('key')+')" type="button" class="btn-custom-manage btn-custom-danger" data-toggle="modal"><span class="fa fa-times"></span></button>'+
              '      </div>'+
                '</div>'+
              '</td>'+
              '</tr>')              
              $('#key_barang'+getTr.data('key')).remove();
          }                     
        })

        function delete_barang(count){
            var getTr = $('#data_barang'+count);
            var id_barang = getTr.find('input.id_barang_table').val();
            var nama_barang = $(getTr.find('td')[0]).text()
            var stok = $(getTr.find('td')[1]).text()
            var harga_pabrik = $(getTr.find('td')[3]).text()
            var satuan = $(getTr.find('td')[4]).text()
          $('#fill_barang').append(
            '<tr id="key_barang'+count+'" data-key="'+count+'">'+
            '      <td>'+
            '        <div class="custom-control custom-checkbox mt-0">'+
            '          <input type="checkbox" class="custom-control-input checkbox-barang" id="barang'+count+'">'+
            '          <label class="custom-control-label" for="barang'+count+'"></label>'+
            '        </div>'+
            '      </td>'+
            '      <td class="nama_barang"><input class="id_barang" type="hidden" value="'+id_barang+'">'+nama_barang+'</td>'+
            '      <td class="stok">'+stok+'</td>                '+
            '      <td class="harga_pabrik">'+harga_pabrik+'</td>'+
            '      <td class="satuan">'+satuan+'</td>                     '+
            '    </tr>'
          );                 
          $('#data_barang'+count).remove();          
        }

        var updateDateBarangMasuk = true;        
        var date = new Date();    
        updateDate(updateDateBarangMasuk);          

          // setInterval(() => {
          //   date = new Date();
          //   updateDate(updateDateTransaction, updateDatePay);
          // }, 1000);      

          function updateDate(barangMasuk){
            var getDate = date.getDate().toString();        
            var getMonth = parseInt(date.getMonth() + 1);
            getMonth = getMonth.toString();                       
            if(getDate.length == 1) getDate = '0' + getDate;
            if(getMonth.length == 1) getMonth = '0' + getMonth;            
            var dateNow = date.getFullYear() + '-' + getMonth + '-' + getDate;
            console.log(dateNow);
            if(barangMasuk) $('#barang_masuk_date').val(dateNow);                    
          }

      </script>
  @endpush