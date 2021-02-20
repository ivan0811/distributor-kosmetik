<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login distributor kosmetik</title>
    <link rel="stylesheet" href="{{asset('template/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/main.css')}}">
</head>
<style>
    body{
        overflow: hidden;
    }
</style>
<body class="login-page">    
    {{--
   NIM : 10119003
  Nama : Ivan Faathirza
  Kelas : IF1 
--}}
    <div class="login-container">
        <div class="login-box">            
            <!-- <img src="/img/logo.svg" alt="" width="40px">                 -->
            <div class="login-header">                                
                <h3>Sign In To Sinar Jaya</h3>
            </div>                        
            <form action="{{ route('login') }}" method="POST">    
                @csrf                            
                <div class="row">           
                    <div class="col-md-12">                                                
                        <div class="form-group">
                            <input type="text" id="" placeholder="Username" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{old('email')}}" name="email" value="{{old('email')}}" required>                                                    
                            @if ($errors->has('email'))
                                <input type="hidden" value="{{ $errors->first('email') }}" id="email_error">                    
                            @endif
                        </div>                        
                        <div class="form-group">
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group custom-checkbox">
                                    <input type="checkbox" name="" id="custom_checkbox" placeholder="">                                                                                    
                                    <label for="custom_checkbox">
                                        <span class="checkmark"> <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' aria-hidden="true" focusable="false">
                                            <path fill='none' stroke='currentColor' stroke-width='3' d='M1.73 12.91l6.37 6.37L22.79 4.59' /></svg></span>                                
                                        <div class="checkbox-text">
                                            {{ __('Remember Me') }}
                                        </div>                                
                                    </label>                                                        
                                </div>                                                
                            </div> 
                            <div class="col-sm-6">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-ligth" id="poho_password">Lupa Password?</button>                                
                                </div>                                
                            </div>                            
                        </div>                        
                        <button type="submit" class="btn-login">Login</button>                                
                    </div>                             
                </div>
            </form>    
        </div>   
        <footer class="login-footer">
            <p class="bg-transparent">Copyright &copy; 2021 Sinar Jaya</p>            
        </footer>                   
    </div>        
    <script src="https://kit.fontawesome.com/5e28bc552a.js" crossorigin="anonymous"></script>
    <script src="{{asset('template/js/jquery-3.3.1.slim.min.js')}}"></script>
    <script src="{{asset('template/js/popper.min.js')}}"></script>
    <script src="{{asset('template/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('template/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/js/app.js')}}"></script>
    <script>        
    $('#poho_password').on('click', function(){
        Swal.fire(
        'Lupa Password?',
        'Jika Lupa Password silahkan menghubungi admin',
        'question'
        )
    })        
    </script>
</body>
</html>