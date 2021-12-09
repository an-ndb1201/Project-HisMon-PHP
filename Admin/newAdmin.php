<?php
require_once('lib/database.php');
require_once('lib/function.php');
$loi = [];


function isFormValidated(){
    global $loi;
    return count($loi) == 0;
}
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(empty($_POST['name'])){
        $loi[]='admim name is required';
    }
    if(empty($_POST['email'])){
        $loi[]=' email is required';
    }
    if(empty($_POST['phone'])){
        $loi[]='phone is required';
    }
    if(strlen($_POST['phone']) != 10){
        $loi[]='phone must  be 10 characters';
    }
    if(empty($_POST['address'])){
        $loi[]='address is required';
    }
    if(empty($_POST['password'])){
        $loi[]='password is required';
    }
    if(strlen($_POST['password']) < 6 || strlen($_POST['password']) > 15 ){
        $loi[]='password in between 6 - 15';
    }
    if($_POST['password2'] != $_POST['password']){
        $loi[]='The password is not the same';
    }
   
    

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>new employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
           
        label {
            font-weight: bold;
        }
        .loi {
            color: #FF0000;
        }
        div.loi{
            border: thin solid red; 
            display: inline-block;
            padding: 5px;
        }
        body {
    
            
            background: #EEE8CD;
        }



  

    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top w3-container">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Historical-Monuments</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="nav active"><a href="home_manager.php">
                        <span class="glyphicon glyphicon-home"></span>
                        Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav">
                        <a >
                            <!-- <span class="glyphicon glyphicon-log-out"></span> -->
                            <?php include('../Admin/shared/user.php'); ?>    
                        </a>
                    </li>
                </ul>
            </div>
        </nav><br><br><br><br><br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <?php if ($_SERVER["REQUEST_METHOD"]== 'POST' && !isFormValidated()): ?>
                    <div class="loi">
                        <span> Please fix the following errors </span>
                        <ul>
                            <?php   
                                foreach($loi as $key => $value){
                                    if (!empty($value)){
                                        echo '<li>', $value , '</li>';
                                    }
                                }
                            ?>
                        </ul>
                    </div><br><br>
                <?php endif; ?>   

                <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
                    <?php 
                        $admim = [];
                        $admim['name'] = $_POST['name'];
                        $admim['email'] = $_POST['email'];
                        $admim['phone'] = $_POST['phone'];
                        $admim['address'] = $_POST['address'];
                        $admim['password'] = $_POST['password'];
                        $result = insert_admins($admim);
                        $newAdminID= mysqli_insert_id($db);
                    ?>
                    <h2>A new admim (ID: <?php echo $newAdminID ?>) has been created:</h2>
                    <ul>
                    <?php 
                        foreach ($_POST as $key => $value) {
                            if ($key == 'submit') continue;
                            if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
                        }        
                    ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2> Create Admin</h2><br>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <div class="form-group">
                        <label for="name">Full Name &emsp;&emsp;</label>
                        <input type="text" class="form-control" name="name" 
                        value="<?php echo isFormValidated()? '': $_POST['name'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" 
                        value="<?php echo isFormValidated()? '': $_POST['email'] ?>">
                    </div>
            
                    <br>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="number" class="form-control" name="phone" 
                        value="<?php echo isFormValidated()? '': $_POST['phone'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address"
                        value="<?php echo isFormValidated()? '': $_POST['address'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password"
                        value="<?php echo isFormValidated()? '': $_POST['password'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" class="form-control" name="password2"
                        value="<?php echo isFormValidated()? '': $_POST['password2'] ?>">
                    </div>
                    <br>
                    
                    <input type="submit" class="btn btn-info btn-sm" name="submit" value="submit">
                    <button type="button" class="btn btn-success btn-sm">
                        <a href="selectAdmin.php" class="glyphicon glyphicon-share-alt"> Back to </a>
                    </button>
                    
                </form>
                <br>
            </div>
            <div class="col-md-2"></div>
        </div>   
    </div>
    <div><br><br></div>

</body>
</html>

