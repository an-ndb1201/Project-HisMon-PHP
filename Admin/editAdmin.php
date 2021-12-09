<?php
require_once('lib/database.php');
require_once('lib/function.php');
$loi= [];

function isFormValidated(){
    global $loi;
    return count($loi) == 0;
}
if(isset($_GET['adminID'])){
    $_SESSION['adm'] = $_GET['adminID'];
}
$admin = find_book_by_admID($_SESSION['adm']);

if ($_SERVER["REQUEST_METHOD"] == 'POST'){ 
        if(empty($_POST['name'])){
            $loi[]=' name is required';
        }
        if(empty($_POST['email'])){
            $loi[]=' email is required';
        }
        if(empty($_POST['phone'])){
            $loi[]='email is required';
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
      
     

       
  
} else { // form loaded
    if(!isset($_GET['adminID'])) {
        redirect_to('selectAdmin.php');
    }

  
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit admin</title>
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
        h3{
            color: red;
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

    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isFormValidated()): ?> 
        <div class="loi">
            <span> Please fix the following errors </span>
            <ul>
                <?php
                foreach ($loi as $key => $value){
                    if (!empty($value)){
                        echo '<li>', $value, '</li>';
                    }
                }
                ?>
            </ul>
        </div><br><br>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2> Edit Admin </h2>
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    <input type="hidden" class="form-control" name="adminID" 
                    value="<?php echo $_SESSION['adm']; ?>" >
                <div class="form-group">   
                    <label for="name">Full Name &emsp;&emsp;</label>
                    <input type="text" class="form-control" name="name" 
                    value="<?php echo isFormValidated()?  $admin['name']: $_POST['name'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" name="email" 
                    value="<?php echo isFormValidated()? $admin['email']: $_POST['email'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="number" class="form-control" name="phone" 
                    value="<?php echo isFormValidated()? $admin['phone']: $_POST['phone'] ?>">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address"
                    value="<?php echo isFormValidated()? $admin['address']: $_POST['address'] ?>">
                </div>

                
                <div class="form-group">
                    <label for="password"> Current password:</label>
                    <input type="password" class="form-control" name="cpwd"
                    value="<?php echo isFormValidated()? '': $_POST['password'] ?>">
                </div>

                <?php
                    if (isFormValidated()){
                        //do update 
                        if ($_SERVER["REQUEST_METHOD"] == 'POST'){
                            if(md5($_POST['cpwd']) == $admin['password']){ 
                                $admin = [];
                                $admin['adminID'] = $_POST['adminID'];
                                $admin['name'] = $_POST['name'];
                                $admin['email'] = $_POST['email'];
                                $admin['phone'] = $_POST['phone'];
                                $admin['address'] = $_POST['address'];
                                $admin['password'] = $_POST['password'];
                               
                            //db delete
                            update_admin($admin);
                            redirect_to('selectAdmin.php');
                            
                            } else { // form loaded
                            echo "<h3>Wrong password</h3>";
                            }
                        }
                    }   
                ?>
            

                <div class="form-group">
                    <label for="password"> New Password</label>
                    <input type="password" class="form-control" name="password"
                    value="<?php echo isFormValidated()? '': $_POST['password'] ?>">
                </div>
            
                <div class="form-group">
                    <label for="password2">Confirm New Password</label>
                    <input type="password" class="form-control" name="password2"
                    value="<?php echo isFormValidated()?  '': $_POST['password2'] ?>">
                </div>
                <br><br>


                    <input type="submit" class="btn btn-info btn-sm" name="submit" value="submit">
                    <button type="button" class="btn btn-success btn-sm">
                        <a href="selectAdmin.php" class="glyphicon glyphicon-share-alt"> Back to</a>
                    </button>
                
                </form>

               
            </div> 
        </div>
    </div>    
    <br><br>
   
</body>
</html>


<?php
db_disconnect($db);
?>