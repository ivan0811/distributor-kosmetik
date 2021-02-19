@extends('navigation.navigation')
@section('title')
    Transaksi
@endsection
@section('header')
    Transaksi
@endsection
@section('content')
@if ($errors->any())
<div class="col-12">
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        </div>
      @endif        
<form action="{{route('store_transaksi')}}" id="form_user" method="POST" class="col-md-12">       
  <div class="row">
  {{ csrf_field() }}  
  <input type="hidden" id="jumlah_barang" name="jumlah_barang">  
<div class="col-md-6">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Transaksi</h5>                    
      </div>                                          
      <div class="custom-card-body">                                                                            
            <div class="container-fluid">                
              <div class="form-row">                
                <div class="col-md-12 mb-3">
                  <label for="">No Pesanan</label>
                  <input type="text" id="no_pesanan" name="no_pesanan" value="" class="form-control" id="nama" placeholder="No Pesanan" readonly>                    
                </div>
                <div class="col-md-12 mb-3">
                  <label for="">Nama Toko</label>
                  <input type="hidden" name="toko_id" value="{{$pesanan->toko_id}}">
                  <input type="text" class="form-control" value="{{$pesanan->toko->nama}}" placeholder="No Pesanan" readonly>                    
                </div>      
                <div class="col-md-12 mb-3">
                  <label for="">Nama Sales</label>
                  <select name="sales_id" id="" class="form-control" required>
                    <option value="">Pilih Sales</option>                    
                    @foreach ($sales as $item)
                      @if ($pesanan->sales_id == $item->id)
                        <option value="{{$item->id}}" selected>{{$item->nama}}</option>                        
                        @continue;
                      @endif
                        <option value="{{$item->id}}">{{$item->nama}}</option>                        
                      @endforeach
                  </select> 
                </div>                          
                <div class="col-md-12 mb-3">
                  <label for="">Tanggal Transaksi</label>
                  <input type="datetime-local" class="form-control" name="tanggal_transaksi" id="transaction_date"> 
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
      <div class="custom-card-body">                                                                            
            <div class="container-fluid">                
              <div class="form-row">                
                <div class="col-8 mb-3">
                  <label for="">Jumlah Bayar</label>
                  <input type="text" name="jumlah_pembayaran" value="" class="form-control" id="jumlah_bayar" placeholder="Jumlah Bayar" readonly>                    
                </div>
                
                <div class="col-4 mb-3">
                  <label for="">Total Diskon</label>
                  <div class="input-group mb-3">                        
                            <input type="text" id="total_diskon" value="{{$total_discount}}" name="total_discount" class="form-control" id="nama" placeholder="Total Diskon" readonly>                    
                            <div class="input-group-append">
                                <span class="input-group-text" id="inputGroup-sizing-sm">%</span>
                              </div>
                          </div>                                      
                </div>
                <div class="col-md-12 mb-3">
                  <label for="">Status Pembayaran</label>
                  <input id="status_pembayaran" type="text" value="BELUM LUNAS / CICILAN" class="form-control" readonly>
                </div>   
                <div class="col-md-6 mb-3">
                  <label for="">Tanggal Pembayaran</label>
                  <input type="datetime-local" class="form-control" id="pay_date" name="tanggal_pembayaran"> 
                </div>   
                <div class="col-md-6 mb-3">
                  <label for="">Metode Pembayaran</label>
                  <select class="form-control" id="method_payment" name="metode_pembayaran" required>                                        
                      <option value="cash" {{$pembayaran->metode_pembayaran == "CASH" ? "selected" : ""}}>Cash</option>
                      <option value="transfer" {{$pembayaran->metode_pembayaran == "TRANSFER" ? "selected" : ""}}>Transfer</option>                    
                  </select>                     
                </div>                                   
                <div class="col-md-6 mb-3">
                  <label for="">Bayar</label>
                  <input type="number" name="total_bayar" value="" class="form-control without-arrow" oninput="bayar(this)" required>                         
                </div>                                       
                <div class="col-md-6 mb-3">
                  <label for="">Kembalian</label>
                  <input type="number" id="kembalian" 
                  value="{{$pembayaran->status_pembayaran == "LUNAS" ? $pembayaran->jumlah_pembayaran - $pesanan->total_harga : 0}}" 
                  class="form-control without-arrow" readonly>                         
                </div>                        
                @php
                    $display = $pembayaran->metode_pembayaran == "TRANSFER" ? "block" : "none";           
                    $atas_nama = '';
                @endphp
                  <div class="col-md-6 mb-3 transfer" style="display: {{$display}};">
                    <label for="">Rekening</label>                                                          
                      <select class="form-control selectpicker custom-select" id="rekening" name="rekening" data-live-search="true">
                        <option value="">Pilih Rekening</option>
                        @foreach ($rekening as $item)
                        @if ($pembayaran->metode_pembayaran == 'TRANSFER')
                          @if ($item->norek == $pembayaran->norek)
                            <option data-tokens="{{$item->norek}}" data-nama="{{$item->atas_nama}}" value="{{$item->norek}}" selected>{{$item->norek}}</option>                                
                            @php
                              $atas_nama = $item->atas_nama;
                            @endphp                                                                                    
                            @continue                                                                                    
                          @endif                          
                        @endif                          
                          <option  data-tokens="{{$item->norek}}" data-nama="{{$item->atas_nama}}" value="{{$item->norek}}">{{$item->norek}}</option>
                        @endforeach                                                        
                      </select>                                    
                  </div>                                                     
                  <div class="col-md-6 mb-3 transfer" style="display: {{$display}};">
                    <label for="">Atas Nama</label>
                    <input type="text" value="{{$atas_nama}}" id="atas_nama" class="form-control without-arrow" readonly>                         
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
                    <p class="text-card" id="total_barang" style="margin-bottom: 0">Total Barang : <span class="total-row"></span></p>              
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
              <th scope="col" width="120px">Total Harga</th>                 
              <th scope="col" width="120px">Diskon</th>        
              <th scope="col" width="170px">Aksi</th>
            </tr>
          </thead>
          <tbody class="search-table" id="fill_barang_table">                      
              @foreach ($detailPesanan as $item)              
              @if ($item->barang->stok == 0)
                  @continue
              @endif
               <tr id="data_barang{{$item->barang_id}}">                            
               <td>
                 <input type="hidden" name="id_detail[]" value="{{$item->id}}">
                 <input class="id_barang_table" type="hidden" name="barang_id[]" value="{{$item->barang_id}}">
                {{$item->barang->nama}}
                </td>               
               <td class="harga-jual" id="harga_jual{{$item->barang_id}}">{{$item->barang->harga_jual}}</td>               
               <td><div class="input-group input-group-sm mb-3">                       
                       <input name="jumlah[]" type="number" oninput="countJumlahSatuan(this)" class="form-control jumlah_barang" value="0" data-key="{{$item->barang_id}}">
                         <div class="input-group-append">                         
                             <span class="input-group-text" id="inputGroup-sizing-sm">{{$item->barang->satuan->nama}}</span>
                           </div>
                       </div></td>
               <td>
                 <div class="input-group input-group-sm mb-3"><input type="text" value="" name="total_harga[]" id="total_harga{{$item->barang_id}}" class="form-control total-harga" readonly required></div></td>
               <td>
                 <div class="input-group input-group-sm mb-3">                       
                         <input type="number" name="discount[]" oninput="countDiscount(this)" id="discount{{$item->barang_id}}" data-key="{{$item->barang_id}}" value="{{$item->discount * 100}}" class="form-control discount" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                         <div class="input-group-append">
                             <span class="input-group-text" id="inputGroup-sizing-sm">%</span>
                           </div>
                       </div> 
               </td>
               <td>
                     <div class="d-flex">
                     <div class="p-1">
                         <button id="delete_barang{{$item->barang_id}}" onclick="delete_barang({{$item->barang_id}})" type="button" class="btn-custom-manage btn-custom-danger" data-toggle="modal"><span class="fa fa-times"></span></button>
                     </div>
                 </div>
               </td>
               </tr>
              @endforeach         
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
        <a href="{{route('transaksi')}}" class="btn btn-light mr-2">Kembali</a>                
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
        <div class="custom-card-body-table table-responsive">
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
                <tr id="key_barang{{$item->id}}" data-key="{{$item->id}}">                                                                   
                  <td>
                    <div class="custom-control custom-checkbox mt-0">
                      <input type="checkbox" class="custom-control-input checkbox-barang" id="barang{{$item->id}}">
                      <label class="custom-control-label" for="barang{{$item->id}}"></label>
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
    var dataBarang = $.parseJSON('{!! $dataBarang !!}');  
    var total_harga = 0;         

    generateNoPesanan();
    function generateNoPesanan() {
      var year = date.getFullYear().toString(), month = date.getMonth().toString() + 1, day = date.getDate().toString();      
      if(day.length == 1) day = '0' + day;
      if(month.length == 1) month = '0' + month;
      var generateDate = day + month + year;
      var result = generateDate + '001';      
      var no_pesanan = '{{$no_pesanan}}';
      if(no_pesanan != 0)
        if(no_pesanan.match(/\d{2,8}/g)[0] == day+month+year)
          result = generateDate + '00' + (parseInt(no_pesanan.match(/\d{2,8}/g)[1]) + 1);            
      $('#no_pesanan').val(result);      
    }

    function countJumlahBayar(){
      var result = 0;
      for (const item of $('input.total-harga')) {
          result += parseInt($(item).val());
      }
      $('#jumlah_bayar').val(result);
    }

    function countTotalDiscount(key){
      var result = 0;
      var total_harga = parseInt($('#total_harga'+key).val());
      var discount = parseInt($('#discount'+key).val());      
      discount /= 100;      
      if($('#total_harga'+key).val() != 0 || $('#total_harga'+key).val() != '')
        $('#total_harga'+key).val(total_harga - (discount * total_harga));
    }
    
    function countJumlahSatuan(e){       
      var data, key = $(e).data('key');          
      for (const item of dataBarang) {            
        if(item['key'] == key){
          data = item;              
          console.log(item);
        }
      }             
      
      if($(e).val() >= parseInt(data.stok)) $(e).val(data.stok);      

        if($(e).val() > 0 && $(e).val() != '' && $(e).val() != 0){                        
          $('#total_harga'+key).val($(e).val() * parseInt(data.harga_jual));                                           
          setDisableDiscount(key, false);                                                          
        }else if($(e).val() < 0){
          $(e).val(0);        
        }else{
          $('#total_harga'+key).val('');                                           
        }                             

        countTotalDiscount(key);
        countJumlahBayar();                      
    }        

    checkBarang()
    function checkBarang(){
      if($('#total_barang').find('span.total-row').text() > 0){
        $('#jumlah_barang').val($('#total_barang').find('span.total-row').text());
      }else{
        $('#jumlah_barang').val('');
      }        
    }

    function countDiscount(e){
      var key = $(e).data('key');      
      if($(e).val() >= 0){          
        countTotalDiscount(key);      
        setTotalDiscount();        
      }else{
        $(e).val(0);
      }                        
    }

    function setDisableDiscount(key, isEnable){
      $('#discount'+key).prop('disabled', isEnable);
    }

    function setTotalDiscount(){
      var result = 0;
      for (const item of $('input.discount')) {
        result += parseInt($(item).val());
      }      
      $('#total_diskon').val(result);
    }

    function bayar(e){      
      var jumlahBayar = parseInt($('#jumlah_bayar').val());
      if($(e).val() >= jumlahBayar){
        $('#kembalian').val($(e).val() - jumlahBayar);
        $('#status_pembayaran').val('LUNAS');
      }else if($(e).val() < jumlahBayar){
        $('#kembalian').val(0);
        $('#status_pembayaran').val('BELUM LUNAS / CICILAN');
      }else{
        $(e).val(0);
        $('#status_pembayaran').val('BELUM LUNAS / CICILAN');
      }
    }    

    // function setAtasNama(e){
    //   console.log(true);
    //   $('#atas_nama').val($(e).find('option:selected').data('nama'));
    // }

    $('#rekening').on('changed.bs.select', function(){
        console.log(true);
      $('#atas_nama').val($(this).find('option:selected').data('nama'));
    })

    $('#tambah_barang').click(function(){                                 
          for (const item of $('input.checkbox-barang:checked')) {
            var getTr = $(item).parent().parent().parent();
            var id_barang = getTr.find('input.id_barang').val();
            var nama_barang = getTr.find('td.nama_barang').text()
            var stok = getTr.find('td.stok').text()
            var harga_jual = getTr.find('td.harga_jual').text()
            var discount = parseInt(getTr.find('td.discount').text())
            var satuan = getTr.find('td.satuan').text()
            $('#fill_barang_table').append(
              '<tr id="data_barang'+getTr.data('key')+'">'+              
              '<td><input class="id_barang_table" type="hidden" name="barang_id[]" value="'+id_barang+'">'+nama_barang+'</td>                '+
              '<td class="harga-jual" id="harga_jual'+getTr.data('key')+'">'+harga_jual+'</td>                '+
              '<td><div class="input-group input-group-sm mb-3">                        '+
                      '<input name="jumlah[]" type="number" oninput="countJumlahSatuan(this)" class="form-control jumlah_barang" value="0" data-key='+getTr.data('key')+'>'+
                      '  <div class="input-group-append">                          '+
                      '      <span class="input-group-text" id="inputGroup-sizing-sm">'+satuan+'</span>'+
                      '    </div>'+
                      '</div></td>'+
              '<td>'+
                '<div class="input-group input-group-sm mb-3"><input type="text" name="total_harga[]" id="total_harga'+getTr.data('key')+'" class="form-control total-harga" readonly required></div></td>'+              
              '<td>'+
                '<div class="input-group input-group-sm mb-3">                        '+
                '        <input type="number" name="discount[]" oninput="countDiscount(this)" id="discount'+getTr.data('key')+'" data-key="'+getTr.data('key')+'" value="'+discount+'" class="form-control discount" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled="true">'+
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
          setTotalDiscount();     
          countRowLength();               
          checkBarang();
        })

        function delete_barang(key){                   
          var data;
          var index = 0;
          for (const item of dataBarang) {            
            if(item['key'] == key){
              data = item;     
              break;
            }
            index++;
          }     

          console.log(index);

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
            '<td class="discount">'+data.discount * 100+'</td>'+
            '<td class="satuan">'+data.satuan+'</td>'+
            '</tr>'
          );                                   
          dataBarang.splice(index, 1);          
          $('#data_barang'+key).remove();      
          countJumlahBayar();
          setTotalDiscount();
          countRowLength();          
          checkBarang();
        }
    
    updateDate(updateDateTransaction, updateDatePay);

      $(function() {
        $('.selectpicker').selectpicker();
      });                      

      $('#method_payment').change(function(){
        $('.transfer').hide();
        $('#rekening').prop('required', false);
        if($(this).val() == "transfer"){
          $('.transfer').show();
          $('#rekening').prop('required', true);
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
    </script>
@endpush
