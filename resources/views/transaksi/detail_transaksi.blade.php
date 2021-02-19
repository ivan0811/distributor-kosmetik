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
<form action="{{route('print_transaksi')}}" id="form_user" method="post" class="col-md-12">       
  <div class="row">
  {{ csrf_field() }}  
  <input type="hidden" id="jumlah_barang" name="jumlah_barang">  
<div class="col-md-6">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Detail Transaksi</h5>                    
      </div>                                          
      <div class="custom-card-body">                                                                            
            <div class="container-fluid">                
              <div class="form-row">                
                <div class="col-md-12 mb-3">
                  <label for="">No Pesanan</label>
                  <input type="text" id="no_pesanan" name="no_pesanan" value="{{$pesanan->no_pesanan}}" class="form-control-plaintext" id="nama" placeholder="No Pesanan" readonly>                    
                </div>
                <div class="col-md-12 mb-3">
                  <label for="">Nama Toko</label>
                  <input type="text" name="nama_toko" class="form-control-plaintext" value="{{$pesanan->toko->nama}}" placeholder="No Pesanan" readonly>                    
                </div>      
                <div class="col-md-12 mb-3">
                  <label for="">Nama Sales</label>
                  <input type="text" name="nama_sales" class="form-control-plaintext" value="{{$pesanan->sales->nama}}" readonly>                  
                </div>                          
                <div class="col-md-12 mb-3">
                  <label for="">Tanggal Transaksi</label>
                  <input type="text" name="tanggal_transaksi" class="form-control-plaintext" value="{{$pesanan->updated_at}}" id="transaction_date" readonly> 
                </div>                            
              </div>                                                                                                                                                                     
            </div>                                                                                                                                                                               
      </div>
    </div>
  </div> 
  <div class="col-md-6">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Detail Pembayaran</h5>                    
      </div>                     
      <div class="custom-card-body">                                                                            
            <div class="container-fluid">                
              <div class="form-row">                
                <div class="col-8 mb-3">
                  <label for="">Jumlah Bayar</label>
                  <input type="text" name="total_bayar" value="{{$pesanan->total_harga}}" class="form-control-plaintext" id="jumlah_bayar" placeholder="Jumlah Bayar" readonly>                    
                </div>
                
                <div class="col-4 mb-3">
                  <label for="">Total Diskon</label>
                  <div class="input-group mb-3">                        
                            <input type="text" id="total_diskon" value="{{$total_discount}}" name="total_diskon" class="form-control-plaintext" id="nama" placeholder="Total Diskon" readonly>                    
                            <div class="input-group-append">
                                <span class="input-group-text" id="inputGroup-sizing-sm">%</span>
                              </div>
                          </div>                                      
                </div>
                <div class="col-md-12 mb-3">
                  <label for="">Status Pembayaran</label>
                  <input id="status_pembayaran" name="status" type="text" value="{{$pembayaran->status_pembayaran == "LUNAS" ? "LUNAS" : "BELUM LUNAS / CICILAN"}}" class="form-control-plaintext" readonly>
                </div>   
                <div class="col-md-6 mb-3">
                  <label for="">Tanggal Pembayaran</label>
                  <input type="text" value="{{$pembayaran->updated_at}}" class="form-control-plaintext" id="pay_date" name="tanggal_pembayaran" readonly> 
                </div>   
                <div class="col-md-6 mb-3">
                  <label for="">Metode Pembayaran</label>
                  <input type="text" name="metode_pembayaran" class="form-control-plaintext" value="{{$pembayaran->metode_pembayaran}}" readonly>                  
                </div>                                   
                <div class="col-md-6 mb-3">
                  <label for="">Bayar</label>
                  <input type="number" name="jumlah_bayar" value="{{$pembayaran->jumlah_pembayaran}}" class="form-control-plaintext without-arrow" oninput="bayar(this)" readonly>                         
                </div>                                       
                <div class="col-md-6 mb-3">
                  <label for="">Kembalian</label>
                  <input name="kembalian" type="number"  id="kembalian" 
                  value="{{$pembayaran->status_pembayaran == "LUNAS" ? $pembayaran->jumlah_pembayaran - $pesanan->total_harga : 0}}" 
                  class="form-control-plaintext without-arrow" readonly>                         
                </div>                        
                @php
                    $display = $pembayaran->metode_pembayaran == "TRANSFER" ? "block" : "none";           
                    $atas_nama = '';
                    $norek = '';
                @endphp
                  <div class="col-md-6 mb-3 transfer" style="display: {{$display}};">
                    <label for="">Rekening</label>                                                                                                                                            
                    <div class="" style="display:none">
                      <select class="form-control selectpicker custom-select" id="rekening" name="rekening" data-live-search="true" >
                        <option value="">Pilih Rekening</option>
                        @foreach ($rekening as $item)
                        @if ($pembayaran->metode_pembayaran == 'TRANSFER')
                          @if ($item->norek == $pembayaran->norek)
                            <option data-tokens="{{$item->norek}}" data-nama="{{$item->atas_nama}}" value="{{$item->norek}}" selected>{{$item->norek}}</option>                                
                            @php
                              $atas_nama = $item->atas_nama;
                              $norek = $item->norek;
                            @endphp                                                                                    
                            @continue                                                                                    
                          @endif                          
                        @endif                          
                          <option  data-tokens="{{$item->norek}}" data-nama="{{$item->atas_nama}}" value="{{$item->norek}}">{{$item->norek}}</option>
                        @endforeach                                                        
                      </select>      
                    </div>  
                    <input type="text" name="nomor_rekening" value="{{$norek}}" class="form-control-plaintext" readonly>                                                                           
                  </div>                         
                  <div class="col-md-6 mb-3 transfer" style="display: {{$display}};">
                    <label for="">Atas Nama</label>
                    <input type="text" name="atas_nama" value="{{$atas_nama}}" id="atas_nama" class="form-control-plaintext without-arrow" readonly>                         
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
            </tr>
          </thead>
          <tbody class="search-table" id="fill_barang_table">                      
              @foreach ($detailPesanan as $item)              
               <tr id="data_barang{{$item->barang_id}}">                            
               <td>
                 <input type="hidden" name="id_detail[]" value="{{$item->id}}">
                 <input class="id_barang_table" type="hidden" name="barang_id[]" value="{{$item->barang_id}}">
                 <input type="hidden" name="nama_barang[]" value="{{$item->barang->nama}}">
                 {{$item->barang->nama}}
                </td>               
               <td class="harga-jual" id="harga_jual{{$item->barang_id}}">
                <input type="hidden" name="harga_satuan[]" value="{{$item->barang->harga_jual}}">
                {{$item->barang->harga_jual}}</td>               
               <td><div class="input-group input-group-sm mb-3">                       
                       <input name="jumlah[]" type="number" oninput="countJumlahSatuan(this)" class="form-control-plaintext jumlah_barang" value="{{$item->qty}}" data-key="" readonly>
                       <input type="hidden" name="satuan[]" value="{{$item->barang->satuan->nama}}" id="">
                         <div class="input-group-append">                         
                             <span class="input-group-text" id="inputGroup-sizing-sm">{{$item->barang->satuan->nama}}</span>
                           </div>
                       </div></td>
               <td>
                 <div class="input-group input-group-sm mb-3"><input type="text" value="{{$item->total_harga}}" name="total_harga[]" id="total_harga{{$item->barang_id}}" class="form-control-plaintext total-harga" readonly required></div></td>
               <td>
                 <div class="input-group input-group-sm mb-3">                       
                         <input type="number" name="diskon[]" oninput="countDiscount(this)" id="discount{{$item->barang_id}}" data-key="{{$item->barang_id}}" value="{{$item->discount * 100}}" class="form-control-plaintext discount" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
                         <div class="input-group-append">
                             <span class="input-group-text" id="inputGroup-sizing-sm">%</span>
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
        <button type="submit" class="btn-custom-submit">Cetak</button>      
      </div>      
  </div>
</div>  
</div>
</div>     
</form>                          
@endsection    
