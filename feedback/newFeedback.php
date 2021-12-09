<?php
require_once('database.php');
require_once('../Admin/lib/function.php');
$loi = [];
function isFormValidated(){
    global $loi;
    return count($loi) == 0;
}
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(empty($_POST['email'])){
        $loi[]=' email is required';
    }
    if(empty($_POST['feedback'])){
        $loi[]='feedback is required';
    }
}
$now = getdate();
$currentTime = $now["hours"] . ":". $now["minutes"] . ":". $now["seconds"];
$currentDate = $now["mon"] . "/". $now["mday"] . "/". $now["year"];
$datetime = $currentDate . "-" . $currentTime;
// echo $datetime; # hiển thị năm
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>new employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="mystyle.css">
    <style>
        label {
            font-weight: bold;
        }
        .loi {
            color: #FF0000;
        }
        div.loi{
            border: thin solid red; 
            display: inline-block;
            padding: 5px;
        }
        body {
            text-align: left;
            background: #FFE4B5;
        }
        .container {
            min-height: 600px;
        }
        body {
        background: #EEE8CD;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top w3-container">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../user/index.php">Historical-Monuments</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="nav active"><a href="../user/index.php">
                        <span class="glyphicon glyphicon-home"></span>
                        Home</a></li>
                </ul>
            </div>
        </nav>
        <br><br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-5">
                <?php if ($_SERVER["REQUEST_METHOD"]== 'POST' && !isFormValidated()): ?>
                    <div class="loi">
                        <span>Please fix the following errors</span>
                        <ul>
                            <?php   
                                foreach($loi as $key => $value){
                                    if (!empty($value)){
                                        echo '<li>', $value , '</li>';
                                    }
                                }
                            ?>
                        </ul>
                    </div><br><br>
                <?php endif; ?>   
                <p id="time"> </p>
                <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
                    <?php 
                        $feedback = [];
                        $feedback['email'] = $_POST['email'];
                        $feedback['feedback'] = $_POST['feedback'];
                        $feedback['time'] = $_POST['time'];
                        $result = insert_feedback($feedback);
                        $newFeedbackID= mysqli_insert_id($db);
                    ?>
                    <h2>Thank you for your comments!!!!</h2>  
                <?php endif; ?>   
            </div>
            <div class="col-md-3"></div>
        </div>    
        <div class="row">
            <div class="col-md-2 text-center"></div>
            <div class="col-md-8" id="form">
                <h2> Feedback</h2>
                <p id="time"></p>   
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <br><br>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" class="form-control" name="email" 
                        value="<?php echo isFormValidated()? '': $_POST['email'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="feedback">Feedback</label>
                        <textarea class="form-control" name="feedback" rows="10" cols="50" value="<?php echo isFormValidated()? '': $_POST['feedback'] ?>">                
                        </textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="time" name="time" value="<?php echo $datetime; ?>">
                    </div>
                    <br>
                    <input type="submit" class="btn btn-info btn-sm" name="submit" value="submit">
                    <button type="button" class="btn btn-success btn-sm">
                        <a href="../user/index.php" class="glyphicon glyphicon-share-alt"> Back to </a>
                    </button>
                    <br><br><br>
                </form>
            </div>
            <div class="col-md-2 text-center"></div>
        </div>
    </div>
    <br><br>
    <footer class="footer">
    <div class="container-fluid">
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <h5 class="text-uppercase">TAT Travel Limited Company</h5>
            <p>Head office: 285 Doi Can, Ba Dinh, Ha Noi, Viet Nam</p>
            <p>Email: vuongtoantuan2001@gmail.com</p>
            <p>Hotline: 0931502001</p>
            <p>International Tour Operator License: 01-1188/2018 TCDL- GP LHQT</p>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
            <h5 class="text-uppercase">About Us</h5>
            <p><a href="../user/introduce.php"><span class="glyphicon glyphicon-chevron-right"></span>Introduce</a></p>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
            <h5 class="text-uppercase">Follow Us</h5>
            <a target="_blank" href="https://www.facebook.com/?_rdr=p"><i class="fa fa-facebook"></i></a>&nbsp;
            <a target="_blank" href="https://twitter.com/"><i class="fa fa-twitter"></i></a>&nbsp;
            <a target="_blank" href="https://www.google.com"><i class="fa fa-google"></i></a>&nbsp;
            <a target="_blank" href="https://www.youtube.com"><i class="fa fa-youtube"></i></a>
            <a target="_blank" href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>
        </div>
        </div>
        <div><br><br><br></div>
        <div class="footer-bottom">
        &copy; HisMonTAT.com | Designed by group 6
        </div>
    </div>
    </footer>
    
    <script src="bootstrap3/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap3/js/bootstrap.min.js"></script>
</body>
</html>
</html>