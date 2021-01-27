@extends('navigation.navigation')
@section('title')
    User
@endsection
@section('header')
    User
@endsection
@section('content')
<div class="col-sm-12">
    <div class="custom-card">                  
      <div class="custom-card-header with-tools">                                                                  
            <h5>Mengelola User</h5>                                                                                                                                                                      
      </div>        
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="d-flex row">            
            <div class="p-2">
              <a href="{{route('create_user')}}" class="btn btn-custom-success"><span class="fa fa-plus"></span> Tambah User</a>                                           
            </div>            
            <div class="p-2">
              <nav class="pagination-table" aria-label="Page navigation example">
                <ul class="pagination">
                 
                </ul>
              </nav>
            </div>
            <div class="align-self-center p-2">
              <p class="text-card" style="margin-bottom: 0">Total Users : <span class="total-user"></span></p>              
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
            <tr>                           
              @php
                $no = 1  
              @endphp
              @foreach ($users as $key => $item)
              @if ($item->id == 1)
                @continue  
              @endif
              @if (\Auth::user()->id == $item->id)
                  @continue
              @endif
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
      $('#modal_delete_user').modal('show');
    });
      $('#btn_delete').click(function(){                
        $('#delete_user'+$(this).data('id')).submit();
      });
    </script>
@endpush
