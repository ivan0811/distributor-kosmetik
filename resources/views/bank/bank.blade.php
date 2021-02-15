@extends('navigation.navigation')
@section('title')
    Bank    
@endsection
@section('header')
    Bank
@endsection
@section('content')
<div class="col-sm-12">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                                  
            <h5>Mengelola Bank</h5>                                                                                                                                                                      
      </div>        
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="d-flex row">            
            <div class="p-2">
              <a href="{{route('create_bank')}}" class="btn btn-custom-success"><span class="fa fa-plus"></span> Tambah Bank</a>                                           
            </div>            
            <div class="p-2">
              <nav class="pagination-table" aria-label="Page navigation example">
                <ulv class="pagination">
                 
                </ul>
              </nav>
            </div>
            <div class="align-self-center p-2">
              <p class="text-card" style="margin-bottom: 0">Total Bank : <span class="total-row"></span></p>              
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
              <th scope="col">Kode Bank</th>              
              <th scope="col">Nama Bank</th>                                           
              <th scope="col" width="170px">Aksi</th>
            </tr>
          </thead>
          <tbody class="search-table">
            @php
            $no = 1  
            @endphp
            @foreach ($bank as $key => $item)
            <tr>                                         
                <th scope="row">{{$no++}}</th>
                <td>{{$item->kode_bank}}</td>                
                <td>{{$item->nama_bank}}</td>                                                                  
                <td>                  
                    <form action="{{route('delete_bank', $item->kode_bank)}}" method="POST" id="form_delete{{$item->kode_bank}}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE')}}                      
                      <div class="d-flex">                                                  
                      <div class="p-1">
                          <a href="{{route('edit_bank', $item->kode_bank)}}" class="btn btn-custom-warning"><span class="fa fa-edit"></span></a>
                      </div>
                      <div class="p-1">
                          <button type="button" class="btn btn-custom-danger delete_confirm" data-id="{{$item->kode_bank}}" data-toggle="modal"><span class="fa fa-trash"></span></button>
                      </div>
                    </div>                  
                    </form>                                                     
                </td>
              </tr>                                         
              @endforeach
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
      $('#modal_delete').modal('show');
    });
      $('#btn_delete').click(function(){                
        $('#form_delete'+$(this).data('id')).submit();
      });
    </script>
@endpush
