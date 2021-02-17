@extends('navigation.navigation')
@section('title')
    Transaksi
@endsection
@section('header')
    Transaksi
@endsection
@section('content')
<form action="{{route('store_user')}}" id="form_user" method="POST" class="col-md-12">       
  <div class="row">
  {{ csrf_field() }}
<div class="col-md-6">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Transaksi</h5>                    
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
              <div class="form-row">                
                <div class="col-md-12 mb-3">
                  <label for="">No Pesanan</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="No Pesanan" readonly>                    
                </div>
                <div class="col-md-12 mb-3">
                  <label for="">Nama Toko</label>
                    <select name="toko" id="" class="form-control">
                      <option value="">Pilih Toko</option>
                      @foreach ($toko as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>                        
                      @endforeach
                    </select>                  
                </div>      
                <div class="col-md-12 mb-3">
                  <label for="">Nama Sales</label>
                  <select name="toko" id="" class="form-control">
                    <option value="">Pilih Sales</option>
                    @foreach ($sales as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>                        
                      @endforeach
                  </select> 
                </div>                          
                <div class="col-md-12 mb-3">
                  <label for="">Tanggal Transaksi</label>
                  <input type="datetime-local" class="form-control" id="transaction_date"> 
                </div>                            
              </div>                                                                                                                                                                     
                </div>                                                                                                                                                                               
      </div>
    </div>
  </div> 
  <div class="col-md-6">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Pembayaran</h5>                    
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
              <div class="form-row">                
                <div class="col-8 mb-3">
                  <label for="">Jumlah Bayar</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Jumlah Bayar" readonly>                    
                </div>
                <div class="col-4 mb-3">
                  <label for="">Total Diskon</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Total Diskon" readonly>                    
                </div>
                <div class="col-md-12 mb-3">
                  <label for="">Status Pembayaran</label>
                  <input type="text" value="BELUM LUNAS" class="form-control" readonly>
                </div>   
                <div class="col-md-6 mb-3">
                  <label for="">Tanggal Pembayaran</label>
                  <input type="datetime-local" class="form-control" id="pay_date"> 
                </div>   
                <div class="col-md-6 mb-3">
                  <label for="">Metode Pembayaran</label>
                  <select class="form-control" id="method_payment" name="status" required>                    
                    <option value="cash" selected>Cash</option>
                    <option value="transfer">Transfer</option>
                  </select>                     
                </div>                                   
                <div class="col-md-6 mb-3">
                  <label for="">Bayar</label>
                  <input type="number" value="0" class="form-control without-arrow" required>                         
                </div>                                       
                <div class="col-md-6 mb-3">
                  <label for="">Kembalian</label>
                  <input type="number" value="0" class="form-control without-arrow" readonly>                         
                </div>                        
                  <div class="col-md-6 mb-3 transfer">
                    <label for="">Rekening</label>                                                          
                      <select class="form-control selectpicker custom-select" data-live-search="true">
                        @foreach ($rekening as $item)
                          <option data-tokens="{{$item->norek}}" data-nama="{{$item->atas_nama}}">{{$item->norek}}</option>
                        @endforeach                                                        
                      </select>                                    
                  </div>                                                     
                  <div class="col-md-6 mb-3 transfer">
                    <label for="">Atas Nama</label>
                    <input type="text" class="form-control without-arrow" readonly>                         
                  </div>                              
              </div>                                                                                                                                                                     
                </div>                                                                                                                                                           
      </div>
    </div>
  </div> 

<div class="col-sm-12">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                                  
            <h5>Rincian Pesanan</h5>                                                                                                                                                                      
      </div>        
      <div class="container-fluid">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="d-flex row">            
                  <div class="p-2 d-inline-flex">
                    <a href="#" class="btn-custom btn-custom-success" data-toggle="modal" data-target="#modal_barang"><span class="fa fa-plus"></span> Tambah Barang</a>
                  </div>
                  <div class="p-2 align-self-center">
                    <p class="text-card" style="margin-bottom: 0">Total Barang : <span class="total-row"></span></p>              
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
              <th scope="col">Harga Satuan</th>                      
              <th scope="col" width="120px">Jumlah</th>                 
              <th scope="col">Total Harga</th>                 
              <th scope="col" width="100px">Diskon</th>        
              <th scope="col" width="170px">Aksi</th>
            </tr>
          </thead>
          <tbody class="search-table" id="fill_barang_table">                      
                                                          
          </tbody>
        </table>
      </div>
    </div>
    </div>
    </div>    
    
  <div class="col-md-12">
  <div class="custom-card">
    <div class="d-flex">
      <div class="ml-auto">          
        <a href="{{route('barang')}}" class="btn btn-light mr-2">Kembali</a>                
        <button type="submit" class="btn-custom-submit">Simpan</button>      
      </div>      
  </div>
</div>  
</div>
</div>     
</form>                          

  <div class="modal fade" id="modal_barang" tabindex="-1" aria-labelledby="modal_barang" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Barang</h5>
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
                <th scope="col">Harga</th>                        
                <th scope="col">Discount</th>      
                <th scope="col">Satuan</th>                                                                              
              </tr>
            </thead>
            <tbody class="search-table" id="fill_barang">          
                @foreach ($barang as $key => $item)           
                @if ($item->stok == 0)
                    @continue
                @endif     
                <tr id="key_barang{{$key}}" data-key="{{$key}}">                                                                   
                  <td>
                    <div class="custom-control custom-checkbox mt-0">
                      <input type="checkbox" class="custom-control-input checkbox-barang" id="barang{{$key}}">
                      <label class="custom-control-label" for="barang{{$key}}"></label>
                    </div>
                  </td>
                  <td class="nama_barang"><input class="id_barang" type="hidden" value="{{$item->id}}">{{$item->nama}}</td>                
                  <td class="stok">{{$item->stok}}</td>                
                  <td class="harga_jual">{{$item->harga_jual}}</td>
                  <td class="discount">{{$item->discount * 100}}</td>
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
    var updateDateTransaction = true;
    var updateDatePay = true;
    var date = new Date();          
    var dataBarang = [];
    var no_pesanan = '{{$no_pesanan}}';
    
    function generateNoPesanan() {
      
    }

    $('#tambah_barang').click(function(){                               
          for (const item of $('input.checkbox-barang:checked')) {
            var getTr = $(item).parent().parent().parent();
            var id_barang = getTr.find('input.id_barang').val();
            var nama_barang = getTr.find('td.nama_barang').text()
            var stok = getTr.find('td.stok').text()
            var harga_jual = getTr.find('td.harga_jual').text()
            var discount = getTr.find('td.discount').text()
            var satuan = getTr.find('td.satuan').text()
            $('#fill_barang_table').append(
              '<tr id="data_barang'+getTr.data('key')+'">'+              
              '<td><input class="id_barang_table" type="hidden" name="id_barang[]" value="'+id_barang+'">'+nama_barang+'</td>                '+
              '<td>'+harga_jual+'</td>                '+
              '<td><div class="input-group input-group-sm mb-3">                        '+
                      '<input name="jumlah[]" type="number" class="form-control jumlah" value="0" id="jumlah'+getTr.data('key')+'">'+
                      '  <div class="input-group-append">                          '+
                      '      <span class="input-group-text" id="inputGroup-sizing-sm">'+satuan+'</span>'+
                      '    </div>'+
                      '</div></td>'+
              '<td id="total_harga'+getTr.data('key')+'"></td>'+              
              '<td>'+
                '<div class="input-group input-group-sm mb-3">                        '+
                '        <input type="number" value="'+discount+'" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">'+
                '        <div class="input-group-append">'+
                '            <span class="input-group-text" id="inputGroup-sizing-sm">%</span>'+
                '          </div>'+
                '      </div>  '+
              '</td>'            +          
              '<td>'+
              '      <div class="d-flex">'+
              '      <div class="p-1">'+
              '          <button id="delete_barang'+getTr.data('key')+'" onclick="delete_barang('+getTr.data('key')+')" type="button" class="btn-custom-manage btn-custom-danger" data-toggle="modal"><span class="fa fa-times"></span></button>'+
              '      </div>'+
                '</div>'+
              '</td>'+
              '</tr>')              
              dataBarang.push({'key' : getTr.data('key'), 'id_barang' : id_barang, 'nama_barang' : nama_barang, 'stok' : stok, 'harga_jual' : harga_jual, 'discount' : discount, 'satuan' : satuan})
              $('#key_barang'+getTr.data('key')).remove();
          }                     
        })

        function delete_barang(key){                   
          var data;
          for (const item of dataBarang) {            
            if(item['key'] == key){
              data = item;
            }
          }          

          $('#fill_barang').append(
            '<tr id="key_barang'+key+'" data-key="'+key+'">'+
            '<td>'+
            '<div class="custom-control custom-checkbox mt-0">'+
            '<input type="checkbox" class="custom-control-input checkbox-barang" id="barang'+key+'">'+
            '<label class="custom-control-label" for="barang'+key+'"></label>'+
            '</div>'+
            '</td>'+
            '<td class="nama_barang"><input class="id_barang" type="hidden" value="'+data.id_barang+'">'+data.nama_barang+'</td>                '+
            '<td class="stok">'+data.stok+'</td>'+
            '<td class="harga_jual">'+data.harga_jual+'</td>'+
            '<td class="discount">'+data.discount+'</td>'+
            '<td class="satuan">'+data.satuan+'</td>'+
            '</tr>'
          );                 
          $('#data_barang'+key).remove();          
        }
    
    updateDate(updateDateTransaction, updateDatePay);

      $(function() {
        $('.selectpicker').selectpicker();
      });          
      
      $('.transfer').hide();

      $('#method_payment').change(function(){
        $('.transfer').hide();
        if($(this).val() == "transfer"){
          $('.transfer').show();
        }
      });

      setInterval(() => {
        date = new Date();
        updateDate(updateDateTransaction, updateDatePay);
      }, 1000);      

      function updateDate(transaction, pay){
        var getDate = date.getDate().toString();        
        var getMonth = date.getMonth().toString();
        var getHours = date.getHours().toString();
        var getMinutes = date.getMinutes().toString();                
        if(getDate.length == 1) getDate = '0' + getDate;
        if(getMonth.length == 1) getMonth = '0' + getMonth;
        if(getHours.length == 1) getHours = '0' + getHours;
        if(getMinutes.length == 1) getMinutes = '0' + getMinutes;
        var dateNow = date.getFullYear() + '-' + getMonth + '-' + getDate + 'T' + getHours + ':' + getMinutes;
        if(transaction) $('#transaction_date').val(dateNow);        
        if(pay) $('#pay_date').val(dateNow);
      }

      // for (const item of $('div.modal')){
      //   $(item)
      // }
    </script>
@endpush
