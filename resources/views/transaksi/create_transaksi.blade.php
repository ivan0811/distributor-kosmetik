@extends('navigation.navigation')
@section('title')
    Transaksi
@endsection
@section('header')
    Transaksi
@endsection
@section('content')
<div class="col-md-12">
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
          <form action="{{route('store_user')}}" id="form_user" method="POST">       
            {{ csrf_field() }}
            <div class="container-fluid">                
              <div class="form-row">                
                <div class="col-md-6 mb-3">
                  <label for="">No Pesanan</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required>                    
                </div>
                <div class="col-md-6 mb-3">
                  <label for="">Nama Toko</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nama Toko" aria-label="Recipient's username" aria-describedby="button-addon2" readonly required>
                    <div class="input-group-append">
                      <button class="btn btn-outline-accent" type="button" data-toggle="modal" data-target="#pilih_toko">PIlih Toko</button>
                   </div>
                  </div>           
                </div>                
                <div class="col-md-6 mb-3">
                  <label for="">Nama Sales</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nama Sales" aria-label="Recipient's username" aria-describedby="button-addon2" readonly required>
                    <div class="input-group-append">
                      <button class="btn btn-outline-accent" type="button" data-toggle="modal" data-target="#pilih_sales">Pilih Sales</button>
                   </div>
                  </div>
                </div>      
                <div class="col-md-6 mb-3">
                  <label for="">Tanggal Transaksi</label>
                  <input type="datetime-local" class="form-control"> 
                </div>      
              </div>                                                                                                                                                                     
                </div>                                                                                                                      
          </form>                                                
      </div>
    </div>
  </div> 

<div class="col-sm-12">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                                  
            <h5>Rincian Pesanan</h5>                                                                                                                                                                      
      </div>        
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="d-flex row">                        
            <div class="p-2">
              <nav class="pagination-table" aria-label="Page navigation example">
                <ul class="pagination">
                 
                </ul>
              </nav>
            </div>
            <div class="p-2">              
              <button class="btn btn-custom-success" data-toggle="modal" data-target="#modal_barang"><span class="fa fa-plus"></span> Tambah Barang</button>
            </div>            
            <div class="align-self-center p-2">
              <p class="text-card" style="margin-bottom: 0">Total Pesanan : <span class="total-row"></span></p>              
            </div>
            <div class="ml-auto p-2">
              <form class="form-inline">                    
                <input class="form-control search-box" type="text" placeholder="Search" aria-label="Search">                            
              </form>
            </div>                                    
          </div>                                                                                            
      </li>      
      </ul>                         
      <div class="custom-card-body-table table-responsive" style="max-height: 440px;">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Barang</th>                                                                                   
              <th scope="col">Harga Satuan</th>                      
              <th scope="col" width="120px">Jumlah</th>                 
              <th scope="col">Total Harga</th>                 
              <th scope="col" width="100px">Diskon</th>        
              <th scope="col" width="170px">Aksi</th>
            </tr>
          </thead>
          <tbody class="search-table">
            {{-- @php
                $no = 1  
              @endphp
              @foreach ($users as $key => $item)
              @if ($item->id == 1)
                @continue  
              @endif
              @if (\Auth::user()->id == $item->id)
                  @continue
              @endif --}}
            <tr>                                         
                <th scope="row"></th>
                <td></td>                
                <td></td>                
                <td>
                    <div class="input-group input-group-sm mb-3">                        
                        <input type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        <div class="input-group-append">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Box</span>
                          </div>
                      </div>
                    </td>
                <td></td>   
                <td>
                    <div class="input-group input-group-sm mb-3">                        
                        <input type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        <div class="input-group-append">
                            <span class="input-group-text" id="inputGroup-sizing-sm">%</span>
                          </div>
                      </div>    
                </td>                             
                <td>                                                                                  
                          <button type="button" class="btn btn-sm btn-custom-danger" data-id="" data-toggle="modal"><span class="fa fa-trash"></span></button>                      
                    </div>                                      
                </td>
              </tr>                                         
              {{-- @endforeach               --}}
          </tbody>
        </table>
      </div>
    </div>
  </div>  

  <div class="col-md-12">
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
          <form action="{{route('store_user')}}" id="form_user" method="POST">       
            {{ csrf_field() }}
            <div class="container-fluid">                
              <div class="form-row">                
                <div class="col-4 mb-3">
                  <label for="">Jumlah Bayar</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Jumlah Bayar" readonly>                    
                </div>
                <div class="col-2 mb-3">
                  <label for="">Total Diskon</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Total Diskon" readonly>                    
                </div>
                <div class="col-md-6 mb-3">
                  <label for="">Tanggal Pembayaran</label>
                  <input type="datetime-local" class="form-control"> 
                </div>   
                <div class="col-md-6 mb-3">
                  <label for="">Metode Pembayaran</label>
                  <select class="form-control" id="method_payment" name="status" required>                    
                    <option value="cash" selected>Cash</option>
                    <option value="transfer">Transfer</option>
                  </select>                     
                </div>      
                <div class="col-md-6 mb-3">
                  <label for="">Status Pembayaran</label>
                  <input type="text" value="BELUM LUNAS" class="form-control" readonly>
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
                        <option data-tokens="china">China</option>
                        <option data-tokens="malayasia">Malayasia</option>
                        <option data-tokens="singapore">Singapore</option>
                      </select>                                    
                  </div>                                                     
                  <div class="col-md-6 mb-3 transfer">
                    <label for="">Atas Nama</label>
                    <input type="text" class="form-control without-arrow" readonly>                         
                  </div>                              
              </div>                                                                                                                                                                     
                </div>                                                                           
              <div class="footer-card-btn">
                <div class="d-flex">
                  <a href="{{route('user')}}" class="p-2 mr-2 btn btn-light">Kembali</a>
                  <button type="button" id="btn_submit" class="mr-2 p-2 btn btn-light"><span class="fa fa-download"></span> Download</button>
                  <button type="button" id="btn_submit" class="mr-2 p-2 btn btn-light"><span class="fa fa-print"></span> Cetak</button>
                  <button type="button" id="btn_submit" class="ml-auto p-2 btn btn-primary">Simpan</button>
                </div>                
              </div>                                        
          </form>                                                
      </div>
    </div>
  </div> 

  <div class="modal fade" id="modal_barang" tabindex="-1" aria-labelledby="modal_barang" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>        
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <div class="d-flex row">                                            
                {{-- <div class="align-self-center p-2">
                  <p class="text-card" style="margin-bottom: 0">Total Pesanan : <span class="total-row"></span></p>              
                </div> --}}
                <div class="p-2 left-search">
                  <form class="form-inline custom-search-table">                    
                    <input class="form-control search-box" type="text" placeholder="Search" aria-label="Search">                            
                  </form>
                </div>   
                <div class="p-2">
                    <nav class="pagination-table" aria-label="Page navigation example">
                      <ul class="pagination">
                       
                      </ul>
                    </nav>
                  </div>                                
              </div>                                                                                                      
          </li>      
          </ul>                         
          <div class="custom-card-body-table table-responsive" style="max-height: 440px;">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Pilih</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Stok</th>
                  <th scope="col">Harga</th>                                                                                
                </tr>
              </thead>
              <tbody class="search-table">
                {{-- @php
                    $no = 1  
                  @endphp
                  @foreach ($users as $key => $item)
                  @if ($item->id == 1)
                    @continue  
                  @endif
                  @if (\Auth::user()->id == $item->id)
                      @continue
                  @endif
                <tr>                                         
                    <th scope="row">{{$no++}}</th>
                    <td>{{$item->name}}</td>                
                    <td>{{$item->email}}</td>                
                    <td>{{$item->username}}</td>
                    <td>{{$item->no_hp}}</td>   
                    <td>{{$item->role->name}}</td>                             
                    <td>                  
                        <form action="{{route('delete_user', $item->id)}}" method="POST" id="delete_user{{$item->id}}">
                          {{ csrf_field() }}
                          {{ method_field('DELETE')}}                      
                          <div class="d-flex">
                          <div class="p-1">
                            <a href="{{route('show_user', $item->id)}}" class="btn btn-info"><span class="fa fa-eye"></span></a>
                          </div>                                  
                          <div class="p-1">
                              <a href="{{route('edit_user', $item->id)}}" class="btn btn-custom-warning"><span class="fa fa-edit"></span></a>
                          </div>
                          <div class="p-1">
                              <button type="button" class="btn btn-custom-danger delete_confirm" data-id="{{$item->id}}" data-toggle="modal"><span class="fa fa-trash"></span></button>
                          </div>
                        </div>                  
                        </form>                                                     
                    </td>
                  </tr>                                         
                  @endforeach               --}}
              </tbody>
            </table>
          </div>        
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary">Tambah Barang</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="pilih_sales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sales</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <div class="d-flex row">                        
                    <div class="p-2">
                      <nav class="pagination-table" aria-label="Page navigation example">
                        <ul class="pagination">
                         
                        </ul>
                      </nav>
                    </div>                    
                    <div class="align-self-center p-2">
                      <p class="text-card" style="margin-bottom: 0">Total Sales : <span class="total-row"></span></p>              
                    </div>
                    <div class="ml-auto p-2">
                      <form class="form-inline">                    
                        <input class="form-control search-box" type="text" placeholder="Search" aria-label="Search">                            
                      </form>
                    </div>                                    
                  </div>                                                                                            
              </li>      
              </ul> 

            <div class="custom-card-body-table table-responsive" style="max-height: 440px;">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Pilih</th>
                      <th scope="col">Nama Sales</th>
                      <th scope="col">Jenis Kelamin</th>
                      <th scope="col">Kabupaten / kota</th>
                      <th scope="col">Kecamatan</th>                                                                                
                      <th scope="col">Alamat</th>                                                                                
                    </tr>
                  </thead>
                  <tbody class="search-table">
                    <tr>
                        <td>1</td>
                        <td><input type="radio"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @php
                        $no = 1  
                      @endphp
                      @foreach ($users as $key => $item)
                      @if ($item->id == 1)
                        @continue  
                      @endif
                      @if (\Auth::user()->id == $item->id)
                          @continue
                      @endif
                    <tr>                                         
                        <th scope="row">{{$no++}}</th>
                        <td>{{$item->name}}</td>                
                        <td>{{$item->email}}</td>                
                        <td>{{$item->username}}</td>
                        <td>{{$item->no_hp}}</td>   
                        <td>{{$item->role->name}}</td>                             
                        <td>                  
                            <form action="{{route('delete_user', $item->id)}}" method="POST" id="delete_user{{$item->id}}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE')}}                      
                              <div class="d-flex">
                              <div class="p-1">
                                <a href="{{route('show_user', $item->id)}}" class="btn btn-info"><span class="fa fa-eye"></span></a>
                              </div>                                  
                              <div class="p-1">
                                  <a href="{{route('edit_user', $item->id)}}" class="btn btn-custom-warning"><span class="fa fa-edit"></span></a>
                              </div>
                              <div class="p-1">
                                  <button type="button" class="btn btn-custom-danger delete_confirm" data-id="{{$item->id}}" data-toggle="modal"><span class="fa fa-trash"></span></button>
                              </div>
                            </div>                  
                            </form>                                                     
                        </td>
                      </tr>                                         
                      @endforeach               --}}
                  </tbody>
                </table>
              </div>        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary">Pilih</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="pilih_toko" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Toko</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <div class="d-flex row">                        
                    <div class="p-2">
                      <nav class="pagination-table" aria-label="Page navigation example">
                        <ul class="pagination">
                         
                        </ul>
                      </nav>
                    </div>                         
                    <div class="align-self-center p-2">
                      <p class="text-card" style="margin-bottom: 0">Total Toko : <span class="total-row"></span></p>              
                    </div>
                    <div class="ml-auto p-2">
                      <form class="form-inline">                    
                        <input class="form-control search-box" type="text" placeholder="Search" aria-label="Search">                            
                      </form>
                    </div>                                    
                  </div>                                                                                            
              </li>      
              </ul> 
              
            <div class="custom-card-body-table table-responsive" style="max-height: 440px;">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Pilih</th>
                      <th scope="col">Nama Toko</th>                      
                      <th scope="col">Nomor HP</th>
                      <th scope="col">Kabupaten / kota</th>
                      <th scope="col">Kecamatan</th>                                                                                
                      <th scope="col">Alamat</th>                                                                                                      
                    </tr>
                  </thead>
                  <tbody class="search-table">
                    <tr>
                        <td>1</td>
                        <td><input type="radio"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @php
                        $no = 1  
                      @endphp
                      @foreach ($users as $key => $item)
                      @if ($item->id == 1)
                        @continue  
                      @endif
                      @if (\Auth::user()->id == $item->id)
                          @continue
                      @endif
                    <tr>                                         
                        <th scope="row">{{$no++}}</th>
                        <td>{{$item->name}}</td>                
                        <td>{{$item->email}}</td>                
                        <td>{{$item->username}}</td>
                        <td>{{$item->no_hp}}</td>   
                        <td>{{$item->role->name}}</td>                             
                        <td>                  
                            <form action="{{route('delete_user', $item->id)}}" method="POST" id="delete_user{{$item->id}}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE')}}                      
                              <div class="d-flex">
                              <div class="p-1">
                                <a href="{{route('show_user', $item->id)}}" class="btn btn-info"><span class="fa fa-eye"></span></a>
                              </div>                                  
                              <div class="p-1">
                                  <a href="{{route('edit_user', $item->id)}}" class="btn btn-custom-warning"><span class="fa fa-edit"></span></a>
                              </div>
                              <div class="p-1">
                                  <button type="button" class="btn btn-custom-danger delete_confirm" data-id="{{$item->id}}" data-toggle="modal"><span class="fa fa-trash"></span></button>
                              </div>
                            </div>                  
                            </form>                                                     
                        </td>
                      </tr>                                         
                      @endforeach               --}}
                  </tbody>
                </table>
              </div>        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary">Pilih</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
    <script>      
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
    </script>
@endpush
