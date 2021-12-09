<?php
require_once('database.php');
require_once('../Admin/lib/function.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Category</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
     
     
        table.list tr th {
        border: 1px solid #0055DD;
        background: #0055DD;
        color: white;
        
        }
        #th {
            background: #F4A460 ;
        }
        #test123{
            height: 2000px;
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
        </nav><br><br><br>
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
            <H1>TABLE Category
                <a href = "newcategory.php">
                    <button type="button" class="btn btn-danger btn-lg">
                        <span class="glyphicon glyphicon-plus"> New</span>
                    </button>
                </a>
            </H1><br>
            <table class="list table table-striped">
                <tr>
                    <th>Name Category</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <?php  
                $category_set = find_all_category();
                $count = mysqli_num_rows($category_set);
                for ($i = 0; $i < $count; $i++):
                    $category = mysqli_fetch_assoc($category_set); 
                ?>
                    <tr>
                        <td><?php echo $category['namecategory']; ?></td>
                        <td><a href="<?php echo 'editcategory.php?categoryID='.$category['categoryID']; ?>">
                            <button type="button" class="btn btn-warning btn-xs">
                                <span class="gglyphicon glyphicon-pencil"></span>
                            </button>
                        </a></td>
                        <td><a href="<?php echo 'deletecategory.php?categoryID='.$category['categoryID']; ?>">
                            <button type="button" class="btn btn-danger btn-xs">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </a></td>
                    </tr>
                <?php 
                endfor; 
                mysqli_free_result($category_set);
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