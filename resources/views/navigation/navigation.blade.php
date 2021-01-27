<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('template/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/layout.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/Chart.min.css')}}">
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
            <div class="navbar-logo justify-content-center">
              <!-- <div class=""></div> -->              
                <img src="{{asset('template/img/logo.svg')}}" alt="">
                <h5>Sinar Jaya</h5>
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
                    <li class="navbar-item">                                            
                      <a href="form.html" class="btn-custom-menu">
                        <span class="fa fa-cash-register"></span>
                        <p class="custom-menu-text">  
                          Transaksi
                        </p>
                      </a>
                    </li>      
                    <li class="navbar-item">                                            
                      <a href="form.html" class="btn-custom-menu">
                        <span class="fa fa-store"></span>
                        <p class="custom-menu-text">  
                          Toko
                        </p>
                      </a>
                    </li>     
                    <li class="navbar-item">                                            
                      <a href="form.html" class="btn-custom-menu">
                        <span class="fa fa-people-carry"></span>
                        <p class="custom-menu-text">  
                          Sales
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
                @endif                
                </ul>
            </div>
        </div>        
    </aside>   
    <nav class="navbar navbar-expand-lg navbar-light nav-light">                        
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="btn_side"><i class="fas fa-bars"></i></a>            
          </ul>          
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (\Auth::user()->foto == null)
                  <img src="{{asset('template/img/user1.svg')}}" alt="" class="user-profile-img-sm">
                @else
                <img src="{{asset('storage/profile/'.\Auth::user()->foto)}}" alt="" class="user-profile-img-sm">
                @endif               
                {{\Auth::user()->username}}                 
              </a>
              <div class="dropdown-menu user-area" aria-labelledby="navbarDropdown">
                <div class="row">
                  <div class="col-sm-12">                  
                    <div class="d-flex justify-content-center box-user-area">
                      @if (\Auth::user()->foto == null)                        
                        <img src="{{asset('template/img/user1.svg')}}" alt="" class="user-profile-img-area">
                      @else
                        <img src="{{asset('storage/profile/'.\Auth::user()->foto)}}" alt="" class="user-profile-img-area">
                      @endif                                                   
                    </div>
                  </div>                   
                    <div class="col-sm-6">                      
                      <a href="{{route('profile_user')}}" class="btn-custom-sm btn-custom-success">Profile</a>
                    </div>
                    <div class="col-sm-6">                                              
                        <a href="#" id="logout_button" class="btn-custom-sm btn-custom-danger" onclick="$('#logout').submit()">Logout</a>
                        {{-- <a href="login.html" id="logout_button" class="btn-custom-sm btn-custom-danger">Logout</a> --}}                                      
                    </div>                
                    <form action="{{route('logout')}}" method="POST" id="logout">            
                      @csrf
                  </form>                  
                </div>                                                
              </div>
            </li>
          </ul>
        </div>
      </nav>          
      <section class="content">           
          <div class="container-fluid">
            <div class="content-header">
              <h3>@yield('header')</h3>
          </div>   
          <div class="row">
            @yield('content')
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
      @if (session('status'))
        {!!session('status')!!}
      @endif
      @stack('scripts')      
</body>
</html>