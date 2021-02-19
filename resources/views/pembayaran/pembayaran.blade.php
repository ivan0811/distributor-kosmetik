@extends('navigation.navigation')
@section('title')
    Pembayaran
@endsection
@section('header')
    Pembayaran
@endsection
@section('content')
<div class="col-sm-12">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                     
            <h5>Daftar Pembayaran</h5>                                                                                                                                                                      
      </div>              
      <div class="container-fluid">                                                          
        <ul class="list-group list-group-flush mt-2">
            <li class="list-group-item">                                                             
                <div class="form-group row">                                                                         
                    <label class="col-sm-2 col-form-label">Nama Toko</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{$pesanan->toko->nama}}" class="form-control-plaintext" readonly>
                    </div>                                  
                </div> 
                <div class="form-group row">                                                                         
                    <label class="col-sm-2 col-form-label">Total Harga</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{$pesanan->total_harga}}" class="form-control-plaintext" readonly>
                    </div>                                  
                </div>                                  
            </li>      
          <li class="list-group-item">              
            <div class="d-flex row">                                             
                <div class="p-2">
                    <a href="{{route('create_pembayaran', Request::segment(3))}}" class="btn btn-custom-success"><span class="fa fa-plus"></span> Tambah Pembayaran</a>                                           
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
              <th scope="col">No</th>                              
              <th scope="col">Jumlah Bayar</th>   
              <th scope="col">Tanggal Bayar</th>           
              <th scope="col">Status Pembayaran</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody class="search-table">
            @php
                $no = 1  
              @endphp
              @foreach ($pembayaran->sortByDesc('created_at')->all() as $key => $item)                                                    
            <tr>                                         
                <th scope="row">{{$no++}}</th>                                
                <td>{{$item->jumlah_pembayaran}}</td>   
                <td>{{$item->created_at}}</td>
                <td>{{$item->status_pembayaran}}</td>                             
                <td>                                                       
                    <form action="{{route('delete_pembayaran', $item->no_pesanan)}}" method="POST" id="delete_user{{$item->id}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}         
                        <input type="hidden" value="{{$item->id}}" name="id">             
                        <div class="d-flex">                                                                                                                                                                      
                          @if ($pembayaran->count() > 1)
                          <div class="p-1">
                            <button type="button" class="btn-custom-manage btn-custom-danger delete_confirm" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal_delete_confirm"><span class="fa fa-times"></span></button>
                        </div>                     
                          @endif                                                          
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
            <a href="{{route('transaksi')}}" class="btn btn-light">Kembali</a>
          </div>                     
        <div class="align-self-center p-2">
          <p class="text-card" style="margin-bottom: 0">Total Pembayaran : <span class="total-row"></span></p>              
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
      $('#modal_delete_user').modal('show');
    });
      $('#btn_delete').click(function(){                
        $('#delete_user'+$(this).data('id')).submit();
      });
    </script>
@endpush
