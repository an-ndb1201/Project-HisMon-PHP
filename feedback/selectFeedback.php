<?php

require_once('database.php');
require_once('../Admin/lib/function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>table admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
        table {
        border-collapse: collapse;
        vertical-align: top;
        }

        table.list {
        width: 100%;
        }

        table.list tr td {
        border: 1px solid #FF4500;
        }

        table.list tr th {
        border: 1px solid #FF4500;
        background: #FFCC66;
        color: #008000;
        text-align: left;
        }
       
        h1{
            /* color : yellow; */
        }
        #th {
            background: #F4A460 ;
        }
        #test123{
            height: 740px;
            background-color: #F4A460;

        }
    </style>
</head>
<body>

    <div >
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
        </nav>
        <br><br><br>
      
        <div class="col-md-2" id="test123"> 
            <ul class="nav nav-pills nav-stacked">
                <br><br><br><br>
                <li><a href="../Admin/selectAdmin.php">
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
        <div class="col-md-10"> 
            <H1>TABLE feedback
            </H1><br>
            <table class="table table-striped">
                <tr id="th">
                    <th>ID</th>
                    <th>Email</th>
                    <th>Feedback</th>
                    <th>DateTime</th>
                    <th>&nbsp;</th>
                </tr>

                <?php 
                $feedback_set = find_all_feedback();
                $count = mysqli_num_rows($feedback_set);
                for ($i = 0; $i < $count; $i++):
                    $feedback = mysqli_fetch_assoc($feedback_set);
                ?>
                    <tr>
                        <td><?php echo $feedback['id']; ?></td>
                        <td><?php echo $feedback['email']; ?></td>
                        <td><?php echo $feedback['feedback']; ?></td>
                        <td><?php echo $feedback['time']; ?></td>
                        <td><a href="<?php echo 'delectFeedback.php?id='.$feedback['id']; ?>">
                            <button type="button" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </a></td>
                    </tr>
                <?php
                endfor;
                mysqli_free_result($feedback_set);
                ?>
            </table>
        </div>
    </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
db_disconnect($db);

?>