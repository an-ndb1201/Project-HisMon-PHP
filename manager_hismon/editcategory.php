<?php
require_once('database.php');
// require_once('functions.php');
require_once('../Admin/lib/function.php');

$errors=[];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}
function checkForm(){
    global $errors;
        
    if ($_SERVER["REQUEST_METHOD"] == 'POST'){

        if (empty($_POST['namecategory'])){
            $errors[] = 'Category is required';
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    if (isFormValidated()){
        //do update
        $category = [];
        $category['categoryID'] = $_POST['categoryID'];
        $category['namecategory'] = $_POST['namecategory'];

        update_category($category);
        redirect_to('indexcategory.php');
    }
} else {
    if(!isset($_GET['categoryID'])) {
        redirect_to('indexcategory.php');
    }
    $id = $_GET['categoryID'];
    $category = find_category_by_id($id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        label {
            font-weight: bold;
        }
        .error {
            color: #FF0000;
        }
        div.error{
            border: thin solid red; 
            display: inline-block;
            padding: 5px;
        }
        body{
            border: thin solid red; 
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
    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isFormValidated()): ?> 
        <div class="error">
            <span> Please fix the following errors </span>
            <ul>
                <?php
                foreach ($errors as $key => $value){
                    if (!empty($value)){
                        echo '<li>', $value, '</li>';
                    }
                }
                ?>
            </ul>
        </div><br><br>
    <?php endif; ?>
    <h2> Edit Category </h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        <input type="hidden" name="categoryID" 
        value="<?php echo isFormValidated()? $category['categoryID']: $_POST['categoryID'] ?>" >

        <label for="category">Category&nbsp;</label>
        <input type="text" name="namecategory" 
        value="<?php echo isFormValidated()? $category['namecategory']: $_POST['namecategory'] ?>">
        <br><br>
        <br><br>


        <input type="submit" class="btn btn-danger btn-sm" name="submit" value="Submit">
        <a class="glyphicon glyphicon-share-alt btn btn-success btn-sm" href="indexcategory.php">Back to </a>
    </form>
    
    <br><br>

</body>
</html>

<?php
db_disconnect($db);
?>