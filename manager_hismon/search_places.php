<?php
require_once('database.php');
require_once('../Admin/lib/function.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
     
     
        table.list tr th {
        border: 1px solid #999999;
        background: #FFCC99;
        }
        table.list tr td  {
            border: 1px solid #999999;
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
        </nav><br><br>
     
      
        <br>
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
            <H1>TABLE Historical-Monuments
                    <a href = "newplaces.php">
                        <button type="button" class="btn btn-danger btn-lg">
                            <span class="glyphicon glyphicon-plus"> New</span>
                        </button>
                    </a>          
            </H1>  
            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-center" action="search_places.php"  method="get">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search name" name="search">
                    <div class="input-group-btn">
                        <button class="btn btn-danger" type="submit">
                        <i class="glyphicon glyphicon-search "></i>
                        </button>
                    </div>
                    </div>
                </form>
            </ul>    
            <table class="list table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Content</th>
                    <th>CategoryID</th>
                    <th>Image</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <?php  
                $search_set = find_all_search($_GET['search']);
                $count = mysqli_num_rows($search_set);
                    if ($count >= 1) {
                    for ($i = 0; $i < $count; $i++):
                        $search = mysqli_fetch_assoc($search_set);
                        //alternative: mysqli_fetch_row($book_set) returns indexed array
                    ?>
                        <tr>
                            <td><?php echo $search['name']; ?></td>
                            <td><?php echo $search['country']; ?></td>
                            <td><?php echo $search['content']; ?></td>
                            <td><?php echo $search['categoryID']; ?></td>
                            <td><?php echo $search['img']; ?></td>
                            <td><a  href="<?php echo 'editplaces.php?placesID='.$search['placesID']; ?>">
                                <button type="button" class="btn btn-warning btn-lg">
                                    <span class="gglyphicon glyphicon-pencil"></span>
                                </button>
                            </a></td>
                            <td><a href="<?php echo 'deleteplaces.php?placesID='.$search['placesID']; ?>">
                                <button type="button" class="btn btn-danger btn-lg">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </a></td>
                        </tr>
                    <?php 
                    endfor; 
                    mysqli_free_result($search_set);
                }else {
                    echo "No results found !";
                }
                ?>
            </table>
        </div>
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
db_disconnect($db);
?>