@extends('navigation.navigation')
@section('title')
    Transaksi
@endsection
@section('header')
    Transaksi
@endsection
@section('content')
<div class="col-sm-12">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                                  
            <h5>Mengelola Transaksi</h5>                                                                                                                                                                      
      </div>        
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="d-flex row">            
            <div class="p-2">
              <a href="{{route('create_user')}}" class="btn btn-custom-success"><span class="fa fa-plus"></span> Tambah Transaksi</a>                                           
            </div>            
            <div class="p-2">
              <form action="">
                <button type="submit" class="btn btn-custom-danger"><span class="fa fa-trash"></span> Hapus Semua Transaksi</button>
              </form>
            </div>            
            <div class="p-2">
              <form action="">
                <button type="submit" class="btn btn-info"><span class="fa fa-file-csv"></span> Export CSV Transaksi</button>
              </form>
            </div>            
            <div class="p-2">
              <nav class="pagination-table" aria-label="Page navigation example">
                <ul class="pagination">
                 
                </ul>
              </nav>
            </div>
            <div class="align-self-center p-2">
              <p class="text-card" style="margin-bottom: 0">Total Transaksi : <span class="total-row"></span></p>              
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
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Username</th>                 
              <th scope="col">Nomor HP</th>   
              <th scope="col">Akses</th>           
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
                <td></td>
                <td></td>   
                <td></td>                             
                <td>                  
                    <form action="" method="POST" id="delete_user">
                      {{ csrf_field() }}
                      {{ method_field('DELETE')}}                      
                      <div class="d-flex">
                        <div class="p-1">
                          <a href="" class="btn btn-success"><span class="fa fa-copy"></span></a>
                        </div>                                  
                      <div class="p-1">
                        <a href="" class="btn btn-info"><span class="fa fa-eye"></span></a>
                      </div>                                  
                      <div class="p-1">
                          <a href="" class="btn btn-custom-warning"><span class="fa fa-edit"></span></a>
                      </div>
                      <div class="p-1">
                          <button type="button" class="btn btn-custom-danger delete_confirm" data-id="" data-toggle="modal"><span class="fa fa-trash"></span></button>
                      </div>
                    </div>                  
                    </form>                                                     
                </td>
              </tr>                                         
              {{-- @endforeach               --}}
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
