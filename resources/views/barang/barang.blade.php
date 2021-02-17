@extends('navigation.navigation')
@section('title')
    Barang    
@endsection
@section('header')
    Barang
@endsection
@section('content')
<div class="col-12">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                                  
        <h5>List Barang</h5>                                                                                                                                                                      
  </div>        
  <div class="container-fluid">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <div class="d-flex row">            
          <div class="p-2 d-inline-flex">
            <a href="{{route('create_barang')}}" class="btn-custom btn-custom-success"><span class="fa fa-plus"></span> Tambah Barang</a>                                           
          </div>                                                            
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
              <th scope="col">No</th>
              <th scope="col">Kode BPOM</th>       
              <th scope="col">Nama Barang</th>              
              <th scope="col">Stok</th>                                           
              <th scope="col">Harga Jual</th>
              <th scope="col">Harga Pabrik</th>
              <th scope="col">Satuan</th>
              <th scope="col">Discount</th>
              <th scope="col" width="170px">Aksi</th>
            </tr>
          </thead>
          <tbody class="search-table">
            @php
            $no = 1  
            @endphp
            @foreach ($barang as $key => $item)              
            <tr>                                         
                <th scope="row">{{$no++}}</th>
                <td>{{$item->kode_bpom}}</td>         
                <td>{{$item->nama}}</td>                
                <td>{{$item->stok}}</td>                
                <td>{{$item->harga_jual}}</td>
                <td>{{$item->harga_pabrik}}</td>
                <td>{{$item->satuan->nama}}</td>
                <td>{{$item->discount}}</td>                                                        
                <td>                  
                    <form action="{{route('delete_barang', $item->id)}}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE')}}                      
                      <div class="d-flex">                                                  
                      <div class="p-1">                          
                          <a href="{{route('edit_barang', $item->id)}}" class="btn-custom-manage btn-custom-warning"><span class="fa fa-pen"></span></a>
                      </div>
                      <div class="p-1">
                        <button type="submit" class="btn-custom-manage btn-custom-danger"><span class="fa fa-times"></span></button>                          
                      </div>
                    </div>                  
                    </form>                                                     
                </td>
              </tr>                                         
              @endforeach              
          </tbody>
        </table>
      </div>
      <div class="d-flex mt-2">
        <div class="align-self-center p-2">
          <p class="text-card" style="margin-bottom: 0">Total Barang Masuk : <span class="total-row"></span></p>              
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
  </div>

  
  <div class="col-12">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                                  
        <h5>List Barang Masuk</h5>                                                                                                                                                                      
  </div>        
  <div class="container-fluid">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <div class="d-flex row">            
          <div class="p-2 d-inline-flex">
            <a href="{{route('create_barang_masuk')}}" class="btn-custom btn-custom-success"><span class="fa fa-plus"></span> Tambah Barang Masuk</a>                                           
          </div>                                                            
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
              <th scope="col">No</th>                      
              <th scope="col">Kode Pabrik</th>   
              <th scope="col">Nama Barang</th>                                                                                                                                         
              <th scope="col">Tanggal</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody class="search-table">
            @php
            $no = 1  
            @endphp
            @foreach ($barangMasuk as $key => $item)              
            <tr>                                         
                <th scope="row">{{$no++}}</th>
                <td>{{$item->kode_pabrik}}</td>                                
                <td>{{$item->barang->nama}}</td>                                
                <td>{{date_format($item->created_at, "d/m/Y")}}</td>                                
                <td>{{$item->jumlah}}</td>                                
                <td>                  
                    <form action="{{route('delete_barang_masuk', $item->kode_pabrik)}}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE')}}                      
                      <div class="d-flex">                                                  
                      <div class="p-1">
                          <a href="{{route('edit_barang_masuk', $item->id)}}" class="btn-custom-manage btn-custom-warning"><span class="fa fa-pen"></span></a>
                      </div>
                      <div class="p-1">
                          <button type="button" class="btn-custom-manage btn-custom-danger" data-toggle="modal"><span class="fa fa-times"></span></button>
                      </div>
                    </div>                  
                    </form>                                                     
                </td>
              </tr>                                         
              @endforeach              
          </tbody>
        </table>
      </div>
      <div class="d-flex mt-2">
        <div class="align-self-center p-2">
          <p class="text-card" style="margin-bottom: 0">Total Barang Masuk : <span class="total-row"></span></p>              
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
  </div>
  
  
  <div class="col">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                                  
        <h5>List Barang Keluar</h5>                                                                                                                                                                      
      </div>        
      <div class="container-fluid">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="d-flex row">            
              <div class="p-2 d-inline-flex">
                <a href="{{route('create_barang_keluar')}}" class="btn-custom btn-custom-success"><span class="fa fa-plus"></span> Tambah Barang Keluar</a>                                           
              </div>                                                            
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
              <th scope="col">No</th>
              <th scope="col">Nama Barang</th>              
              <th scope="col">Jumlah</th>                                           
              <th scope="col" width="170px">Aksi</th>
            </tr>
          </thead>
          <tbody class="search-table">
            @php
            $no = 1  
            @endphp
            @foreach ($barangKeluar as $key => $item)              
            <tr>                                         
                <th scope="row">{{$no++}}</th>
                <td>{{$item->barang_id}}</td>                
                <td>{{$item->jumlah}}</td>                                                                       
                <td>                  
                    <form action="{{route('delete_barang_keluar', $item->id)}}" method="POST" id="form_delete{{$item->id}}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE')}}                      
                      <div class="d-flex">                                                  
                      <div class="p-1">
                          <a href="{{route('edit_barang_keluar', $item->id)}}" class="btn btn-custom-warning"><span class="fa fa-edit"></span></a>
                      </div>
                      <div class="p-1">
                          <button type="button" class="btn btn-custom-danger delete_confirm" data-id="{{$item->id}}" data-toggle="modal"><span class="fa fa-trash"></span></button>
                      </div>
                    </div>                  
                    </form>                                                     
                </td>
              </tr>                                         
              @endforeach              
          </tbody>
        </table>
      </div>
      <div class="d-flex mt-2">
        <div class="align-self-center p-2">
          <p class="text-card" style="margin-bottom: 0">Total Barang Keluar : <span class="total-row"></span></p>              
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
  </div>
@endsection
@push('scripts')
    <script>      
    $('.delete_confirm').click(function(){             
      $('#btn_delete').attr('data-id', $(this).data('id'))    
      $('#modal_delete').modal('show');
    });
      $('#btn_delete').click(function(){                
        $('#form_delete'+$(this).data('id')).submit();
      });
    </script>
@endpush
