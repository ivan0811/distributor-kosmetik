@extends('navigation.navigation')
@section('title')
    Toko    
@endsection
@section('header')
    Toko
@endsection
@section('content')
<div class="col-sm-12">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                                  
        <h5>Mengelola Toko</h5>                                                                                                                                                                      
      </div>  
      <div class="container-fluid">       
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="d-flex row">            
            <div class="p-2 d-inline-flex">
              <a href="{{route('create_toko')}}" class="btn-custom btn-custom-success"><span class="fa fa-plus"></span> Tambah Toko</a>                                           
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
              <th scope="col">#</th>
              <th scope="col">Nama Toko</th>              
              <th scope="col">Nomor HP</th>       
              <th scope="col">Kabupaten / Kota</th>                                                         
              <th scope="col">kecamatan</th>       
              <th scope="col">Alamat</th>
              <th scope="col" width="170px">Aksi</th>
            </tr>
          </thead>
          <tbody class="search-table">
            @php
            $no = 1  
            @endphp
            @foreach ($toko as $key => $item)              
            <tr>                                         
                <th scope="row">{{$no++}}</th>
                <td>{{$item->nama}}</td>                
                <td>{{$item->no_hp}}</td>                
                <td>{{$item->kabupaten}}</td>
                <td>{{$item->kecamatan}}</td>
                <td>{{$item->alamat}}</td>                                                         
                <td>                  
                    <form action="{{route('delete_toko', $item->id)}}" method="POST" id="form_delete{{$item->id}}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE')}}                      
                      <div class="d-flex">                                                  
                      <div class="p-1">
                        <a href="{{route('edit_toko', $item->id)}}" class="btn-custom-manage btn-custom-warning"><span class="fa fa-pen"></span></a>                          
                      </div>
                      <div class="p-1">
                        <button type="button" class="btn-custom-manage btn-custom-danger delete_confirm" data-id="{{$item->id}}" data-toggle="modal"><span class="fa fa-times"></span></button>                          
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
          <p class="text-card" style="margin-bottom: 0">Total Toko : <span class="total-row"></span></p>              
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
