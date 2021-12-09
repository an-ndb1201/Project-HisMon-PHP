<?php
    require_once('lib/database.php');
    require_once('lib/function.php');

    if(isset($_GET['adminID'])){
        $_SESSION['adm'] = $_GET['adminID'];
    }
    $admin = find_book_by_admID($_SESSION['adm']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>   
     .lable {
            margin: 5% auto;
            padding: 0;
        } 
        body {
            text-align: center;           
            margin: 0;
            padding: 0;
            background: #DDD;
            font-size: 16px;
            color: #222;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
          }
        #login-box {
            position: relative;
            margin: 5% auto;
            width: 800px;
            height: 500px;
            background: #F4A460;
            border-radius: 2px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }
        .lable {
            margin: 5% auto;
        }
        h3{
            color: red;
        }
    
     
      
       
       
    </style>
</head>
<body>
 
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
        <div id="login-box">
            <div >
                <h1>Delete adminID</h1>
                <h2>Are you sure you want to delete this admin?</h2>
                <p><span class="label">Name: </span><?php echo $admin['name']; ?></p>
                <p><span class="label">Email: </span><?php echo $admin['email']; ?></p>
                <p><span class="label">Phone: </span><?php echo $admin['phone']; ?></p>
                <p><span class="label">Address: </span><?php echo $admin['address']; ?></p>
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    <label for="user_name_lg">Confirm Password:</label>
                    <input type="password" class="form-control"  name="cfpwd" placeholder="Nhập lại password">   

                    <input type="hidden" name="adminID" value="<?php echo $_SESSION['adm']; ?>" >
                    <input type="submit" class="btn btn-danger btn-sm" name="submit" value="Delete ">
                    <a href="selectAdmin.php">
                        <button type="button" class="btn btn-success btn-sm">
                            <span class="glyphicon glyphicon-share-alt"> Back to </span>
                        </button>
                    </a> 
                
                </form>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
                        if(md5($_POST['cfpwd']) == $admin['password']){ 
                        //db delete
                        delete_admin($_POST['adminID']);
                        redirect_to('selectAdmin.php');
                        
                        } else { // form loaded
                       
                            echo "<h3>Wrong password</h3>";
                        }
                    }
                    
                ?>
            </div> 
    </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>


<?php
db_disconnect($db);
?>