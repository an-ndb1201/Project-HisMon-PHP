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
            height:740px;
            background-color: #F4A460;

        }
    </style>
</head>
<body>

    <!-- <div class="container"> -->
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
                            <?php include('shared/user.php'); ?>    
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <br><br><br>
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
        <div class="col-md-10"> 
            <H1>TABLE admin
                <a href = "newAdmin.php">
                    <button type="button" class="btn btn-danger btn-lg">
                        <span class="glyphicon glyphicon-plus"> New</span>
                    </button>
                </a>
            </H1><br>
            <table class="table table-striped">
                <tr id="th">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Password</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <?php 
                $admin_set = find_all_admin();
                $count = mysqli_num_rows($admin_set);
                for ($i = 0; $i < $count; $i++):
                    $admin = mysqli_fetch_assoc($admin_set);
                ?>
                    <tr>
                        <td><?php echo $admin['adminID']; ?></td>
                        <td><?php echo $admin['name']; ?></td>
                        <td><?php echo $admin['email']; ?></td>
                        <td><?php echo $admin['phone']; ?></td>
                        <td><?php echo $admin['address']; ?></td>
                        <td><?php echo $admin['password']; ?></td>
                        <td><a href="<?php echo 'editAdmin.php?adminID='.$admin['adminID']; ?>">
                            <button type="button" class="btn btn-warning btn-xs">
                                <span class="gglyphicon glyphicon-pencil"></span>
                            </button>
                        </a></td>
                        <td><a href="<?php echo 'deleteAdmin.php?adminID='.$admin['adminID']; ?>">
                            <button type="button" class="btn btn-danger btn-xs">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </a></td>
                    </tr>
                <?php
                endfor;
                mysqli_free_result($admin_set);
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