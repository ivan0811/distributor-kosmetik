@extends('navigation.navigation')
@section('title')
    Rekening
@endsection
@section('header')
    Create Rekening
@endsection
@section('content')      
{{--
   NIM : 10119003
  Nama : Ivan Faathirza
  Kelas : IF1 
--}}                   
  <div class="col-md-12">
    <div class="custom-card">                  
      <div class="custom-card-header text-clear">
        <h5>Form Tambah Rekening</h5>                    
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
          <form action="{{route('update_rekening')}}" id="form_rekening" method="POST">       
            {{ csrf_field() }}
            {{ method_field('PATCH')}}
            <input type="hidden" name="norek" value="{{$rekening->norek}}">
            <div class="container-fluid">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="norek">No Rekening</label> 
                    <div class="col-sm-10">
                      <input type="number" name="norek" value="{{$rekening->norek}}" class="form-control" id="norek" placeholder="No Rekening" readonly>
                    </div>                  
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="kode_bank">Kode Bank</label> 
                    <div class="col-sm-10">
                      <input type="number" name="kode_bank" value="{{$rekening->kode_bank}}" class="form-control" id="kode_bank" placeholder="Kode Bank" readonly>
                    </div>                  
                  </div>
                <div class="form-group row">                          
                  <label class="col-sm-2 col-form-label" for="atas_nama">Atas Nama</label>
                  <div class="col-sm-10">
                    <input type="text" name="atas_nama" value="{{$rekening->atas_nama}}" class="form-control" id="atas_nama" placeholder="Atas Nama" required>                    
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