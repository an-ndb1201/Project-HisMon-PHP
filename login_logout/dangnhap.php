<?php
require_once('../Admin/lib/database.php');
require_once('../Admin/lib/function.php');
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<body>
   
    <div class="bg-primary p-4 mb-2">
        <h1 class="text-white">Historical Monuments</h1>
    </div>
    <div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <form action="" method="post">
                <div class="alert alert-secondary">
                    <strong>Login</strong>
                </div> 
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="user_name_lg">User name:</label>
                            <input type="text" class="form-control" id="user" name="user_name_lg" placeholder="Nhập tên đăng nhập...">                      
                        </div>
                        <div class="form-group">
                            <label for="passlg">Password:</label>
                            <input type="password" class="form-control" id="password" name="passlg" placeholder="Nhập mật khẩu..." >
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="remember" name="rememberlg"/>
                                Remember me ?
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary" id="login" name="dangnhap">Login</button>
                    </div>
                </div>
            </form>
        </div>    
        <div class="col"></div>
    </div>
    </div>   
    

    <?php
		if(isset($_POST["dangnhap"])){
			if(check_login($_POST["user_name_lg"],md5($_POST["passlg"])) > 0){
                // $_SESSION["loged"] = true;
                $username = isset($_POST['user_name_lg'])? $_POST['user_name_lg']: '';

                $_SESSION['user_name_lg'] = $username;
                
                redirect_to('../Admin/home_manager.php');
				// header("location:selectAdmin.php");
			
			}
			
        }
    ?>
    <script>
        if(localStorage.getItem('user')){
            $('#user').val(localStorage.getItem('user'));
            $('#password').val(localStorage.getItem('pass'));
        }
        else{
            localStorage.setItem('user', '');
            localStorage.setItem('pass', '');
        }
    
        $('#login').mouseenter(function(){
            if($('#user').val() == '')
                warning_missing('Username');
            if($('#password').val() == '')
                warning_missing('Password');
            if($('#remember').prop('checked') == true){
                localStorage.setItem('user', $('#user').val());
                localStorage.setItem('pass', $('#password').val());
            }
            if($('#remember').prop('checked') == false){
            localStorage.setItem('user', '');
            localStorage.setItem('pass', '');
        }
            checked_infor();
        })
        function checked_infor(){
            if(($('#user').val() != '') && ($('#password').val() != ''))
                $('#login').attr('type', 'submit');
        }

        function warning_missing(empty){
            $('#warning').remove();
            $('#login').before('<div id="warning" class="alert alert-warning">Please enter ' + empty + '</div>');
            $('#login').attr('type', 'button');
        }
    </script>
</body>
</html>