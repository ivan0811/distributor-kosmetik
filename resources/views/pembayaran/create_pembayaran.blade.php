@extends('navigation.navigation')
@section('title')
    Pembayaran
@endsection
@section('header')
    Create Pembayaran
@endsection
@section('content')      
{{--
   NIM : 10119003
  Nama : Ivan Faathirza
  Kelas : IF1 
--}}
<div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Detail Transaksi</h5>                    
      </div>                                          
      <div class="custom-card-body">                                                                            
            <div class="container-fluid">   
                <div class="form-row">
                <div class="col-3 form-group">                
                  <label for="">No Pesanan</label>                  
                    <input type="text" id="no_pesanan" name="no_pesanan" value="{{$pesanan->no_pesanan}}" class="form-control-plaintext" id="nama" placeholder="No Pesanan" readonly>                                      
                </div>
                <div class="col-3 form-group">
                  <label for="">Nama Toko</label>
                  <input type="text" name="nama_toko" class="form-control-plaintext" value="{{$pesanan->toko->nama}}" placeholder="No Pesanan" readonly>                    
                </div>      
                <div class="col-3 form-group">
                  <label for="">Nama Sales</label>
                  <input type="text" name="nama_sales" class="form-control-plaintext" value="{{$pesanan->sales->nama}}" readonly>                  
                </div>                          
                <div class="col-3 form-group">
                  <label for="">Tanggal Transaksi</label>
                  <input type="text" name="tanggal_transaksi" class="form-control-plaintext" value="{{$pesanan->updated_at}}" id="transaction_date" readonly> 
                </div>                                  
                <div class="col-3 form-group">
                    <label for="">Total Harga</label>
                    <input type="text" name="tanggal_transaksi" class="form-control-plaintext" value="{{$pesanan->total_harga}}" id="transaction_date" readonly> 
                  </div>                       
                  <div class="col-3 form-group">
                    <label for="">Total Telah Dibayar</label>
                    <input type="text" name="tanggal_transaksi" class="form-control-plaintext" value="{{$total_pembayaran}}" id="transaction_date" readonly> 
                  </div>                            
                  <div class="col-3 form-group">
                    <label for="">Tanggal Pembayran Terakhir</label>
                    <input type="text" name="tanggal_transaksi" class="form-control-plaintext" value="{{$pembayaran->created_at}}" id="transaction_date" readonly> 
                  </div>                            
              </div>            
            </div>                                                                                                                                                                                                                                                                                                                                                                           
      </div>
    </div>
  </div>
<form action="{{route('store_pembayaran',  Request::segment(3))}}"  method="POST" class="col-md-12">                            
  {{ csrf_field() }}
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
            <div class="col-12 mb-3">
              <label for="">Jumlah Bayar</label>
              <input type="text" name="jumlah_pembayaran" class="form-control" value="{{$pesanan->total_harga - $total_pembayaran}}" id="jumlah_bayar" placeholder="Jumlah Bayar" readonly>                    
            </div>
                        
            <div class="col-md-12 mb-3">
              <label for="">Status Pembayaran</label>
              <input id="status_pembayaran" name="status_pembayaran" value="{{$pembayaran->status_pembayaran}}" type="text" value="BELUM LUNAS / CICILAN" class="form-control" readonly>
            </div>   
            <div class="col-md-6 mb-3">
              <label for="">Tanggal Pembayaran</label>
              <input type="datetime-local" class="form-control" id="pay_date" name="tanggal_pembayaran"> 
            </div>   
            <div class="col-md-6 mb-3">
              <label for="">Metode Pembayaran</label>
              <select class="form-control" id="method_payment" name="metode_pembayaran" required>                    
                <option value="cash" selected>Cash</option>
                <option value="transfer">Transfer</option>
              </select>                     
            </div>                                   
            <div class="col-md-6 mb-3">
              <label for="">Bayar</label>
              <input type="number" name="total_bayar" value="0" class="form-control without-arrow" oninput="bayar(this)" required>                         
            </div>                                       
            <div class="col-md-6 mb-3">
              <label for="">Kembalian</label>
              <input type="number" id="kembalian" value="0" class="form-control without-arrow" readonly>                         
            </div>                        
              <div class="col-md-6 mb-3 transfer">
                <label for="">Rekening</label>                                                          
                  <select class="form-control selectpicker custom-select" id="rekening" name="rekening" data-live-search="true">
                    <option value="">Pilih Rekening</option>
                    @foreach ($rekening as $item)
                      <option data-tokens="{{$item->norek}}" data-nama="{{$item->atas_nama}}" value="{{$item->norek}}">{{$item->norek}}</option>
                    @endforeach                                                        
                  </select>                                    
              </div>                                                     
              <div class="col-md-6 mb-3 transfer">
                <label for="">Atas Nama</label>
                <input type="text" value="" id="atas_nama" class="form-control without-arrow" readonly>                         
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
  @endsection  

  @push('scripts')
      <script>
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

    $('.transfer').hide();
          $('#method_payment').change(function(){
        $('.transfer').hide();
        $('#rekening').prop('required', false);
        if($(this).val() == "transfer"){
          $('.transfer').show();
          $('#rekening').prop('required', true);
        }
      });

      date = new Date();
      setInterval(() => {
        date = new Date();
        updateDate(true);
      }, 1000);      

      updateDate(true);

      function updateDate(pay){
        var getDate = date.getDate().toString();        
        var getMonth = date.getMonth().toString();
        var getHours = date.getHours().toString();
        var getMinutes = date.getMinutes().toString();                
        if(getDate.length == 1) getDate = '0' + getDate;
        if(getMonth.length == 1) getMonth = '0' + getMonth;
        if(getHours.length == 1) getHours = '0' + getHours;
        if(getMinutes.length == 1) getMinutes = '0' + getMinutes;
        var dateNow = date.getFullYear() + '-' + getMonth + '-' + getDate + 'T' + getHours + ':' + getMinutes;        
        if(pay) $('#pay_date').val(dateNow);
      }      

      $('#rekening').on('changed.bs.select', function(){
        console.log(true);
      $('#atas_nama').val($(this).find('option:selected').data('nama'));
    })
        </script>
  @endpush