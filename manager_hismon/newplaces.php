<?php
require_once('database.php');
require_once('../Admin/lib/function.php');
$errors=[];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){

    if (empty($_POST['namehismon'])){
        $errors[] = 'Name is required';
    }
    if (empty($_POST['country'])){
        $errors[] = 'Country is required';
    }
    if (empty($_POST['content'])){
        $errors[] = 'Content is required';
    }
    if (empty($_POST['fileToUpload'])){
        $errors[] = 'img is required';
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Places</title>
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
                <h2> Create Please</h2>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                        <div class="form-group">
                            <label for="namehismon">Name&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text" name="namehismon" value="<?php echo isFormValidated()? '': $_POST['namehismon'] ?>" class="form-control" id="namehismin" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="country">Country&nbsp;</label>
                            <input type="text" name="country" value="<?php echo isFormValidated()? '': $_POST['country'] ?>" class="form-control" id="country" placeholder="Country">
                        </div>
                        <div class="form-group">
                            <label for="content">Content&nbsp;</label>
                            <textarea type="text" name="content"  rows="10" cols="30" value="<?php echo isFormValidated()? '': $_POST['content'] ?>" class="form-control" id="country" placeholder="content">
                            </textarea>
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
                                <option value="<?php echo $category['categoryID'] ?>"><?php echo $category['namecategory'] ?></option>
                                <?php endfor; ?>
                            </select>

                        </div>
                        <div class="form-groupow">
                            <label for="img">Image </label>
                            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-danger btn-sm" name="submit" value="submit">
                        <a class="glyphicon glyphicon-share-alt btn btn-success btn-sm" href="indexplaces.php">Back to </a>
                       
                    </form>
                </div>
            </div>
        </div>

        <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?>
            <?php
                $places = [];
                $places['namehismon'] = $_POST['namehismon'];
                $places['country'] = $_POST['country'];
                $places['content'] = $_POST['content'];
                $places['categoryID'] = $_POST['categoryID'];
                $places['img'] ='<img src="../img/' . $_POST['fileToUpload'] .'" class="img-rounded" alt="image" width="330" height="236"/>';
                $result = insert_places($places);
                $newplacesID = mysqli_insert_id($db);
                $places['placesID'] = mysqli_insert_id($db);

                $result = insert_img($places);
            ?>
            <h2>A new Hismon (ID: <?php echo $newplacesID ?>) has been created:</h2>
            <ul>
            <?php 
                foreach ($_POST as $key => $value) {
                    if ($key == 'submit') continue;
                    if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
                }        
            ?>
            </ul>
        <?php endif; ?><br><br>
       
    </div>
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>