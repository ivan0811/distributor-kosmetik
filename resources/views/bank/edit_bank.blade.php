@extends('navigation.navigation')
@section('title')
    Bank
@endsection
@section('header')
    Create Bank
@endsection
@section('content')                         
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Tambah Bank</h5>                    
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
          <form action="{{route('update_bank')}}" id="form_bank" method="POST">       
            {{ csrf_field() }}
            {{ method_field('PATCH')}}
            <input type="hidden" name="kode_bank" value="{{$bank->kode_bank}}">
            <div class="container-fluid">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="kode_bank">Kode Bank</label> 
                    <div class="col-sm-10">
                      <input type="number" name="kode_bank" value="{{$bank->kode_bank}}" class="form-control" id="kode_bank" placeholder="Kode Bank" readonly>
                    </div>                  
                  </div>
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="nama_bank">Nama Bank</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_bank" value="{{$bank->nama_bank}}" class="form-control" id="nama_bank" placeholder="Nama Bank" required>                    
                  </div>                  
                </div>                                                                                                 
              <div class="footer-card-btn">
                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#confirm_modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>                                        
          </form>                                                
      </div>
    </div>
  </div>        
@endsection
@push('scripts')
<script type="text/javascript">      
    $('button#btn_submit').on('click', function(){            
      $('#form_bank').submit();
    });    
</script> 
@endpush