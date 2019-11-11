
<?php 

session_start();
if(isset($_SESSION['username']))
{
    header('location:index.php');
}

?>



<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
    #alert,#register-box,#forgot-box
        {
            display: none;
        }
    </style>
</head>

<body class="bg-dark">
   <div class="container mt-4">
       <div class="row">
           <div class="col-lg-4 offset-lg-4" id="alert">
               <div class="alert alert-success">
                   <strong id="result"></strong>
               </div>
           </div>
       </div>
          <!-- Login Form -->
           <div class="row">
               <div class="col-lg-4 offset-lg-4 bg-light rounded" id="login-box">
                   <h2 class="text-center mt-2">Login</h2>
                   <form action="" method="post" role="form" class="p-2" id="login-form">
                       <div class="form-group">
                           <input type="text" name="username" class="form-control" placeholder="Username" required minlength="4" value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];}?>">
                       </div>
                       <div class="form-group">
                           <input type="password" name="password" class="form-control" placeholder="Password" required minlength = "8" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>">
                       </div>
                       <div class="form-group">
                           <div class="custom-control custom-checkbox">
                               <input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if(isset($_COOKIE['username'])) { ?>checked <?php } ?>>
                               <label for="customCheck" class="custom-control-label">Remember Me</label>
                               <a href="#" id="forgot-btn" class="float-right">Forgot Password?</a>
                           </div>
                       </div>
                       <div class="form-group">
                           <input type="submit" name="login" id="login" value="Login" class="btn btn-primary btn-block">
                       </div>
                       <div class="form-group">
                           <p class="text-center" >New User? <a href="#" id="register-btn">Register Here</a></p>
                       </div>
                   </form>
               </div>
           </div>
              <!-- registration form -->
              <div class="row">
               <div class="col-lg-4 offset-lg-4 bg-light rounded" id="register-box">
                   <h2 class="text-center mt-2">Register</h2>
                   <form action="" method="post" role="form" class="p-2" id="register-form">
                       <div class="form-group">
                           <input type="text" name="name" class="form-control" placeholder="Full Name" required minlength="4">
                       </div>
                       <div class="form-group">
                           <input type="text" name="username" class="form-control" placeholder="Username" required minlength="4">
                       </div>
                          <div class="form-group">
                           <input type="email" name="email" class="form-control" placeholder="E-Mail" required>
                       </div>
                       <div class="form-group">
                           <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required minlength = "8" >
                       </div>
                          <div class="form-group">
                           <input type="password" name="cpass" id="cpass" class="form-control" placeholder="Confirm Password" required>
                       </div>
                       <div class="form-group">
                           <div class="custom-control custom-checkbox">
                               <input type="checkbox" name="rem" class="custom-control-input" id="customCheck2">
                               <label for="customCheck2" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
                               
                           </div>
                       </div>
                       <div class="form-group">
                           <input type="submit" name="register" id="register" value="Register" class="btn btn-primary btn-block">
                       </div>
                       <div class="form-group">
                           <p class="text-center" >Already Registered? <a href="#" id="login-btn">Login Here</a></p>
                       </div>
                   </form>
               </div>
           </div>
           <!-- Forgot Password -->
           <div class="row">
               <div class="col-lg-4 offset-lg-4 bg-light rounded" id="forgot-box">
                   <h2 class="text-center mt-2">Reset Password</h2>
                   <form action="" method="post" role="form" class="p-2" id="forgot-form">
                      <div class="form-group">
                          <small class="text-muted">
                              To reset your password enter the email address and we will send reset password instructions on your email.
                          </small>
                           
                       </div>
                       <div class="form-group">
                           <input type="email" name="femail" class="form-control" placeholder="E-mail" required>
                       </div>
                      
                       
                       
                       <div class="form-group">
                           <input type="submit" name="forgot" id="forgot" value="Reset" class="btn btn-primary btn-block">
                       </div>
                       <div class="form-group text-center">
                           <a href="#" id="back-btn" >Back</a>
                       </div>
                   </form>
               </div>
           </div>
           
       </div>
   
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#forgot-btn').click(function(){
               $('#login-box').hide();
                $('#forgot-box').show();
            });
            $('#back-btn').click(function(){
               $('#login-box').show();
                $('#forgot-box').hide();
            });
            $('#register-btn').click(function(){
               $('#login-box').hide();
                $('#register-box').show();
            });
            $('#login-btn').click(function(){
               $('#login-box').show();
                $('#register-box').hide();
            });
            $('#login-form').validate();
            $('#register-form').validate({
                rules:{
                    cpass:{
                        equalTo:"#pass",
                    }
                }
            });
            $('#forgot-form').validate();
            $('#register').click(function(e){
                if(document.getElementById('register-form').checkValidity())
                    {
                        e.preventDefault();
                        $.ajax({
                            url:'actionregister.php',
                            method:'post',
                            data:$('#register-form').serialize()+'&action=register',
                            success:function(response)
                            {
                                $('#alert').show();
                                $('#result').html(response);
                            }
                            
                        });
                    }
                return true;
            });
            $('#login').click(function(e){
                if(document.getElementById('login-form').checkValidity())
                    {
                        e.preventDefault();
                        $.ajax({
                            url:'actionregister.php',
                            method:'post',
                            data:$('#login-form').serialize()+'&action=login',
                            success:function(response)
                            {
                                if(response==='ok')
                                    {
                                        window.location='index.php';
                                    }
                                $('#alert').show();
                                $('#result').html(response);
                            }
                            
                        });
                    }
                return true;
            });
            $('#forgot').click(function(e){
                if(document.getElementById('forgot-form').checkValidity())
                    {
                        e.preventDefault();
                        $.ajax({
                            url:'actionregister.php',
                            method:'post',
                            data:$('#forgot-form').serialize()+'&action=forgot',
                            success:function(response)
                            {
                                $('#alert').show();
                                $('#result').html(response);
                            }
                            
                        });
                    }
                return true;
            });
        });
    </script>
</body>

</html>
