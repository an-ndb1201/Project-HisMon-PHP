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

    if (empty($_POST['name'])){
        $errors[] = 'Name is required';
    }
    if (empty($_POST['country'])){
        $errors[] = 'Country is required';
    }
    if (empty($_POST['content'])){
        $errors[] = 'Content is required';
    }
    if (empty($_POST['categoryID'])){
        $errors[] = 'Content is required';
    }
    // if (empty($_POST['fileToUpload'])){
    //     $errors[] = 'img is required';
    // }
}
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    if (isFormValidated()){
        //do update
        $places = [];
        $places['placesID'] = $_POST['placesID'];
        $places['name'] = $_POST['name'];
        $places['country'] = $_POST['country'];
        $places['content'] = $_POST['content'];
        $places['categoryID'] = $_POST['categoryID'];
        $places['img'] ='<img src="../img/' . $_POST['img'] .'" class="img-rounded" alt="image" width="330" height="236"/>';

        update_places($places);
        update_img($places);
        redirect_to('indexplaces.php');
    }
} else {
    if(!isset($_GET['placesID'])) {
        redirect_to('indexplaces.php');
    }
    $id = $_GET['placesID'];
    $places = find_places_by_id($id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Subject</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="mystyle.css">
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
    <div class="wrapper">
        <div class="container">
            <div class="row">
            <h2> Edit Places </h2>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <input type="hidden" name="placesID"   class="form-control"
                    value="<?php echo isFormValidated()? $places['placesID']: $_POST['placesID'] ?>" >

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name"  class="form-control" value="<?php echo isFormValidated()? $places['name']: $_POST['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="country"  class="form-control" value="<?php echo isFormValidated()? $places['country']: $_POST['country'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea type="text" name="content" id="contenttt" rows="10" cols="30" class="form-control"><?php echo $places['content'];?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="categoryID">Category&nbsp;</label>
                        
                    <select name="categoryID">
                                <?php
                                $arrcategory = find_all_category();
                                $count = mysqli_num_rows($arrcategory);
                                    for ($i=0; $i<$count; $i++) :
                                        $category = mysqli_fetch_array($arrcategory);
                                ?>
                                <option value="<?php echo $category['categoryID'] ?>"
                                <?php if(!empty($places['categoryID']) && $places['categoryID'] == $category['categoryID']) echo 'selected'; ?>
                                ><?php echo $category['namecategory'] ?></option>
                                <?php endfor; ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="img">Image</label>
                        <input type="file" name="img"  class="form-control" 
                        value="<?php echo isFormValidated()? '': $_POST['img'] ?>">
                    </div>
                    <br><br>

                    <input type="submit"  class="btn btn-danger btn-sm" name="submit" value="Submit">
                    <a href="indexplaces.php" class="glyphicon glyphicon-share-alt btn btn-success btn-sm" >Back to </a>
                </form>
            </div>
        </div>
    </div>

</div>
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
db_disconnect($db);
?>