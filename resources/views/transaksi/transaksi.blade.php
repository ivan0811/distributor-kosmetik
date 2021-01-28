@extends('navigation.navigation')
@section('title')
    Transaksi
@endsection
@section('header')
    Transaksi
@endsection
@section('content')
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
          <form action="{{route('store_user')}}" id="form_user" method="POST">       
            {{ csrf_field() }}
            <div class="container-fluid">
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required>                    
                  </div>                  
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="username">Username</label>
                  <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>                    
                  </div>                  
                </div>                               
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="no_hp">Nomor HP</label> 
                  <div class="col-sm-10">
                    <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP Yang Aktif" required>
                  </div>                  
                </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="status">Status Level</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="status" name="status" required>
                        <option value="" selected>Pilih Status Level</option>       
                        <option value="1">Admin</option>
                        <option value="2">Petugas</option>
                      </select>
                    </div>                    
                  </div>                                                                                                                                                                                                                                
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                    <div class="col-sm-10">
                      <textarea name="alamat" id="" placeholder="Alamat Lengkap" class="form-control" required></textarea>
                    </div>                    
                  </div>                                                                                             
                                
                </div>                                                                           
              <div class="footer-card-btn">
                <a href="{{route('user')}}" class="btn btn-light">Kembali</a>
                <button type="button" id="btn_submit" class="btn btn-primary">Simpan</button>
              </div>                                        
          </form>                                                
      </div>
    </div>
  </div> 
<div class="col-sm-6">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                                  
            <h5>Barang</h5>                                                                                                                                                                      
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
              <th scope="col">Nama Barang</th>
              <th scope="col">Stok</th>
              <th scope="col">Harga</th>                                                              
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
            <div class="align-self-center p-2">
              <p class="text-card" style="margin-bottom: 0">Total Pesanan : <span class="total-row"></span></p>              
            </div>
            <div class="ml-auto p-2">
              <form class="form-inline custom-search-table">                    
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
              <th scope="col">Jumlah Pembelian</th>                 
              <th scope="col">Total Harga</th>                 
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
  </div>  
@endsection
@push('scripts')
    <script>      
    $('.delete_confirm').click(function(){             
      $('#btn_delete').attr('data-id', $(this).data('id'))    
      $('#modal_delete_user').modal('show');
    });
      $('#btn_delete').click(function(){                
        $('#delete_user'+$(this).data('id')).submit();
      });
    </script>
@endpush
