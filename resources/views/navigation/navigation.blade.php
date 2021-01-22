<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navigation</title>
    <link rel="stylesheet" href="{{asset('template/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/layout.css')}}">
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
                     <li class="navbar-item active">
                      <a href="../index.html" class="btn-custom-menu active">
                        <span class="fa fa-dashboard"></span>
                        <p class="custom-menu-text">                          
                          Dashboard
                        </p>                        
                        </a>
                    </li>
                    <li class="navbar-item">                                            
                      <a href="form.html" class="btn-custom-menu">
                        <span class="fa fa-edit"></span>
                        <p class="custom-menu-text">  
                        Form
                        </p>
                      </a>
                    </li>                                          
                  <li class="navbar-item">
                    <a href="manage.html" class="btn-custom-menu">                      
                    <span class="fa fa-tasks"></span>
                    <p class="custom-menu-text">  
                    Manage
                    </p></a>
                </li>                    
                <li class="navbar-item">
                  <a href="toast.html" class="btn-custom-menu">
                  <span class="fa fa-exclamation"></span>
                  <p class="custom-menu-text">  
                  Alert
                  </p></a>
              </li>                    
                </ul>
            </div>
        </div>        
    </aside>   
    <nav class="navbar navbar-expand-lg navbar-light nav-light">                
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> -->        
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="btn_side"><i class="fas fa-bars"></i></a>
            <!-- <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>             -->
          </ul>          
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="/img/programmer.png" alt="" class="user-profile-img-sm">
                Admin Name
              </a>
              <div class="dropdown-menu user-area" aria-labelledby="navbarDropdown">
                <div class="row">
                  <div class="col-sm-12">                  
                    <div class="d-flex justify-content-center box-user-area">
                      <img src="/img/programmer.png" alt="" class="user-profile-img-area">
                    </div>
                  </div>                   
                    <div class="col-sm-6">
                      <a href="profile.html" class="btn-custom-sm btn-custom-success">Profile</a>
                    </div>
                    <div class="col-sm-6">
                      <a href="login.html" id="logout_button" class="btn-custom-sm btn-custom-danger">Logout</a>
                    </div>                                        
                </div>                

                <!-- <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a> -->
              </div>
            </li>
          </ul>
        </div>
      </nav>    
      <section class="content">          
          <div class="container-fluid"></div>
      </section>
      <footer>
        <div class="d-flex justify-content-center">                                                         
            <div class="d-flex align-items-center">                                        
                <p>Copyright &copy; Sinar Jaya 2021</p>
            </div>                                                                            
        </div>                      
      </footer> 
      <script src="https://kit.fontawesome.com/5e28bc552a.js" crossorigin="anonymous"></script>
      <script src="{{asset('template/js/jquery-3.3.1.slim.min.js')}}"></script>
      <script src="{{asset('template/js/popper.min.js')}}"></script>
      <script src="{{asset('template/js/jquery-3.5.1.min.js')}}"></script>
      <script src="{{asset('template/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('template/js/app.js')}}"></script>
</body>
</html>