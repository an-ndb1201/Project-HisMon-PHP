<?php
require_once('lib/database.php');
require_once('lib/function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="mystyle.css">
    <style>
         #test123{
            height: 800px;
            background-color: #F4A460;

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
                    <li class="nav active"><a href="#">
                        <span class="glyphicon glyphicon-home"></span>
                        Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav">
                        <a >
                            <!-- <span class="glyphicon glyphicon-log-out"></span> -->
                            <?php include('shared/user.php'); ?>    
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="col-md-2" id="test123"> 
            <ul class="nav nav-pills nav-stacked">
                <br><br><br><br>
                <li><a href="selectAdmin.php">
                    <span class="glyphicon glyphicon-user"></span> 
                    Admin</a>
                </li> 
                <li><a href="../manager_hismon/indexplaces.php">
                    <span class="glyphicon glyphicon-user"></span> 
                    Places </a>
                </li> 
                <li><a href="../manager_hismon/indexcategory.php">
                    <span class="glyphicon glyphicon-user"></span> 
                    Category</a>
                </li> 
                <li><a href="../feedback/selectFeedback.php">
                    <span class="glyphicon glyphicon-user"></span> 
                    Feedback</a>
                </li> 
              
            </ul>
        </div>
 

    <script src="bootstrap3/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap3/js/bootstrap.min.js"></script>
</body>
</html>