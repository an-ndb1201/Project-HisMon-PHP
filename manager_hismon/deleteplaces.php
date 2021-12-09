<?php
require_once('database.php');
// require_once('functions.php');
require_once('../Admin/lib/function.php');


if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    delete_img($_POST['placesID']);
    delete_places($_POST['placesID']);
    
    redirect_to('indexplaces.php');
} else { // form loaded
    if(!isset($_GET['placesID'])) {
        redirect_to('indexplaces.php');
    }
    $id = $_GET['placesID'];
    $places = find_places_by_id($id);
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Places</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
       
        .label {
            font-weight: bold;
            font-size: large;
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
            height: 1200px;
            background: #F4A460;
            border-radius: 2px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }
        .lable {
            margin: 5% auto;
        }
    </style>
</head>
<body>
<div class="container " id="login-box">
        <nav class="navbar navbar-inverse navbar-fixed-top w3-container">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Historical-Monuments</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="nav active"><a href="../Admin/home_manager.php">
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
    <h1>Delete places</h1>
    <h2>Are you sure you want to delete this places?</h2>
    <p><span class="label">Places: </span><?php echo $places['name']; ?></p>
    <p><span class="label">Country: </span><?php echo $places['country']; ?></p>
    <p><span class="label">Content: </span><?php echo $places['content']; ?></p>
    <p><span class="label">Category: </span>
    <?php
        $a=$places['categoryID']; 
        if ($a == '1'){
            echo 'East';
        }else if ($a == '2'){
            echo 'West';
        }else if ($a == '3'){
            echo 'South';
        }else if ($a == '4'){
            echo 'North';
        }
    ?>
    </p>
    <p><span class="label">Image: </span><?php echo $places['img']; ?></p>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="placesID" value="<?php echo $places['placesID']; ?>" >
     
        <input type="submit" class="btn btn-danger btn-lg" name="submit" value="Delete places">
     
    </form>
    
    <br><br>
    <a href="indexplaces.php">
        <button type="button" class="btn btn-success btn-sm">
            <span class="glyphicon glyphicon-share-alt"> Back to </span>
        </button>
    </a> 
</div>
</body>
</html>


<?php
db_disconnect($db);
?>