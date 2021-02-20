<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinar Jaya Kosmetik | @yield('title')</title>
    <link rel="shortcut icon" href="{{asset('template/img/logo_favicon.png')}}">
    <link rel="stylesheet" href="{{asset('template/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/layout.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/Chart.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/bootstrap-select.min.css')}}">
</head>
<style>
  .navbar-nav{
    flex-direction: row;
  }
  .nav-link {
      padding-right: .5rem !important;
      padding-left: .5rem !important;
    }
    
    /* Fixes dropdown menus placed on the right side */
    .ml-auto .dropdown-menu {
      left: auto !important;
      right: 0px;
    }
</style>
<body class="wrap">         
    <aside class="main-side bg-side">
        <div class="container">
          <div class="slide-button d-flex">
            <a class="ml-auto btn-side" data-widget="pushmenu" href="#" role="button" id="btn_side"><i class="fa fa-arrow-left"></i></a>
          </div>
          <div class="navbar-logo justify-content-center">
              <!-- <div class=""></div> -->              
                <img src="{{asset('template/img/logo.svg')}}" alt="">                
            </div>            
            <div class="navbar-main">              
                <ul>
                     <li class="navbar-item {{Request::segment(1) == '' ? 'active' : ''}}">
                      <a href="{{route('dashboard')}}" class="btn-custom-menu active">
                        <span class="fa fa-dashboard"></span>
                        <p class="custom-menu-text">                          
                          Dashboard
                        </p>                        
                        </a>
                    </li>
                    <li class="navbar-item {{Request::segment(1) == 'transaksi' ? 'active' : ''}}">                                            
                      <a href="{{route('transaksi')}}" class="btn-custom-menu">
                        <span class="fa fa-cash-register"></span>
                        <p class="custom-menu-text">  
                          Transaksi
                        </p>
                      </a>
                    </li>                    
                    <li class="navbar-item {{Request::segment(1) == 'toko' ? 'active' : ''}}">                                            
                      <a href="{{route('toko')}}" class="btn-custom-menu ">
                        <span class="fa fa-store"></span>
                        <p class="custom-menu-text">  
                          Toko
                        </p>
                      </a>
                    </li>     
                    <li class="navbar-item {{Request::segment(1) == 'sales' ? 'active' : ''}}">                                            
                      <a href="{{route('sales')}}" class="btn-custom-menu">
                        <span class="fa fa-people-carry"></span>
                        <p class="custom-menu-text">  
                          Sales
                        </p>
                      </a>
                    </li>    
                    <li class="navbar-item {{Request::segment(1) == 'bank' ? 'active' : ''}}">                                            
                      <a href="{{route('bank')}}" class="btn-custom-menu">
                        <span class="fa fa-university"></span>
                        <p class="custom-menu-text">  
                          Bank
                        </p>
                      </a>
                    </li>  
                    <li class="navbar-item {{Request::segment(1) == 'rekening' ? 'active' : ''}}">                                            
                      <a href="{{route('rekening')}}" class="btn-custom-menu">
                        <span class="fa fa-credit-card"></span>
                        <p class="custom-menu-text">  
                          Rekening
                        </p>
                      </a>
                    </li>   
                    <li class="navbar-item {{Request::segment(1) == 'pemasok' ? 'active' : ''}}">                                            
                      <a href="{{route('pemasok')}}" class="btn-custom-menu">
                        <span class="fa fa-industry"></span>
                        <p class="custom-menu-text">  
                          Pemasok
                        </p>
                      </a>
                    </li>        
                    <li class="navbar-item {{Request::segment(1) == 'barang' ? 'active' : ''}}">                                            
                      <a href="{{route('barang')}}" class="btn-custom-menu">
                        <span class="fa fa-box"></span>
                        <p class="custom-menu-text">  
                          Barang
                        </p>
                      </a>
                    </li>                                                   
                    
                @if (\Auth::user()->role_id == 1) 
                  <li class="navbar-item {{Request::segment(1) == 'user' ? 'active' : ''}}">
                    <a href="{{route('user')}}" class="btn-custom-menu">
                    <span class="fa fa-user"></span>
                    <p class="custom-menu-text">                                          
                      User
                    </p>
                  </a>
                  </li>    
                  {{-- <li class="navbar-item {{Request::segment(1) == 'user' ? 'active' : ''}}">
                    <a href="{{route('user')}}" class="btn-custom-menu">
                    <span class="fa fa-file-alt"></span>
                    <p class="custom-menu-text">                                          
                      Laporan
                    </p>
                  </a>
                  </li>     --}}
                @endif                
                </ul>
            </div>
        </div>        
    </aside>   
    <nav class="navbar navbar-expand-lg navbar-light nav-light">                        
        <div class="collapse navbar-collapse" id="navbarNav">          
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <div class="content-header ml-4 mt-2">
                <h2>@yield('title')</h2>
              </div> 
            </li>            
          </ul> 
          <ul class="navbar-nav ml-auto navbar-user-profile">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (\Auth::user()->foto == null)
                <img src="{{asset('template/img/user1.svg')}}" alt="" class="user-profile-img-sm">
              @else
              <img src="{{asset('storage/profile/'.\Auth::user()->foto)}}" alt="" class="user-profile-img-sm">
              @endif   
                {{\Auth::user()->username}} 
              </a>
              <div class="dropdown-menu user-area" aria-labelledby="navbarDropdown">                
                  <!-- <div class="col-sm-12">                  
                    <div class="d-flex justify-content-center box-user-area">
                      <img src="/img/programmer.png" alt="" class="user-profile-img-area">
                    </div>
                  </div>                    -->                    
                      <a href="{{route('profile_user')}}" class="dropdown-item btn-custom-sm"><i class="fa fa-user"></i> &nbsp; Edit Profile</a>                                        
                      <a href="#" onclick="$('#logout').submit()" id="logout_button" class="dropdown-item btn-custom-sm btn-logout"><i class="fa fa-sign-out-alt"></i> &nbsp; Logout</a>                    
                      <form action="{{route('logout')}}" method="POST" id="logout">            
                        @csrf
                    </form> 
              </div>
            </li>
          </ul>         
        </div>
      </nav>          
      <section class="content">           
          <div class="container-fluid">            
            <div class="container">
          <div class="row">            
              @yield('content')                   
          </div>            
        </div>     
          </div>
               
      </section>    
      @isset($confirmModal)
          {!! $confirmModal !!}
      @endisset          
      <footer>
        <div class="d-flex justify-content-center">                                                         
            <div class="d-flex align-items-center">                                        
                <p>Copyright &copy; Sinar Jaya 2021</p>
            </div>                                                                            
        </div>                      
      </footer> 
      <script src="{{asset('template/js/fontawesome.js')}}" crossorigin="anonymous"></script>
      <script src="{{asset('template/js/jquery-3.3.1.slim.min.js')}}"></script>
      <script src="{{asset('template/js/popper.min.js')}}"></script>
      <script src="{{asset('template/js/jquery-3.5.1.min.js')}}"></script>
      <script src="{{asset('template/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('template/js/app.js')}}"></script>
      <script src="{{asset('template/js/Chart.min.js')}}"></script>
      <script src="{{asset('template/js/sweetalert2.all.min.js')}}"></script>            
      <script src="{{asset('template/js/bootstrap-select.min.js')}}"></script>
      @if (session('status'))
        {!!session('status')!!}
      @endif
      @stack('scripts')      
</body>
</html>