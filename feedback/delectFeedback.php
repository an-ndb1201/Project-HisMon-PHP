<?php
require_once('database.php');
require_once('../Admin/lib/function.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    delete_feedback($_POST['id']);
    redirect_to('selectFeedback.php');
} else { // form loaded
    if(!isset($_GET['id'])) {
        redirect_to('selectFeedback.php');
    }
    $feedID = $_GET['id'];
    $feedback = find_feedback_by_ID($feedID);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete feedback</title>
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
    
     
      
       
       
    </style>
</head>
<body>
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
    <div id="login-box">
        <div >
            <h1>Delete feedback</h1>
            <h2>Are you sure you want to delete this feedback?</h2>
            <p><span class="label">Email: </span><?php echo $feedback['email']; ?></p>
            <p><span class="label">Feedback: </span><?php echo $feedback['feedback']; ?></p>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <input type="hidden" name="id" value="<?php echo $feedback['id']; ?>" >
                <input type="submit" class="btn btn-danger btn-sm" name="submit" value="Delete ">
            <a href="selectFeedback.php">
                <button type="button" class="btn btn-success btn-sm">
                    <span class="glyphicon glyphicon-share-alt"> Back to index</span>
                </button>
            </a> 
            
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>


<?php
db_disconnect($db);
?>