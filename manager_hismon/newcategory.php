<?php
require_once('database.php');
require_once('../Admin/lib/function.php');
$errors=[];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){

    if (empty($_POST['category'])){
        $errors[] = 'Category is required';
    }
    
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Category</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
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
        <h2> Edit Category </h2>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form-group">
                    <label for="category">Category&nbsp;</label>
                    <input type="text" name="category" value="<?php echo isFormValidated()? '': $_POST['category'] ?>" class="form-control" placeholder="Name">
                </div>
                <br>
                <input type="submit" class="btn btn-danger btn-sm" name="submit" value="submit">
                <button type="button" class="glyphicon glyphicon-share-alt btn btn-success btn-sm">
                  <a  href="indexcategory.php">Back to </a>
                </button>
            </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?>
        <?php
            $category = [];
            $category['category'] = $_POST['category'];
            $result = insert_category($category);
            
            $newcategoryID = mysqli_insert_id($db);

        ?>
        <h2>A new Hismon (ID: <?php echo $newcategoryID ?>) has been created:</h2>
        <ul>
        <?php 
            foreach ($_POST as $key => $value) {
                if ($key == 'submit') continue;
                if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
            }        
        ?>
        </ul>
    <?php endif; ?> <br> <br>
  
</div>
</body>
</html>