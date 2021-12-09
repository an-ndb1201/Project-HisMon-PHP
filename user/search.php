<?php
require_once('database.php');
// require_once('../Admin/lib/function.php');
// $search_count = find_all_search($_GET['search']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historical-Monuments</title>
  <link rel="stylesheet" href="bootstrap3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="mystyle.css">
  <style>
      body {
        background: #EEE8CD;
      }
      #logo{
      font-family: 'Aguafina Script';
      font-size: 25px;
   
      color: black;
      }
  </style>
</head>
<body>
<!-- home -->
<div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top w3-container w3-brown">
      <div class="container-fluid">
        <div div class="navbar-header">
          <!-- Logo -->
          <a class="navbar-brand" id="logo" href="index.php">Historical-Monuments |</a>
          <!-- Responsive -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="nav  "><a href="index.php">Home</a></li>
            <li class="nav"><a href="introduce.php">Introduce</a></li>

            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown">Continents
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">                      
                <?php
                  $arrcategory = find_all_category();
                  $count = mysqli_num_rows($arrcategory);
                      for ($i=0; $i<$count; $i++) :
                        $category = mysqli_fetch_array($arrcategory);
                ?>
                <li><a href="<?php echo 'category.php?categoryID='.$category['categoryID']; ?>"><?php echo $category['namecategory'] ?></a></li>
                <?php endfor; ?>
              </ul>
            </li>

            <li class="nav"><a href="../feedback/newFeedback.php">Feedback Us</a></li>          
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <form class="navbar-form navbar-center" action="search.php" method="get">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="search">
                <div class="input-group-btn">
                  <button class="btn btn-danger" type="submit">
                    <i class="glyphicon glyphicon-search "></i>
                  </button>
                </div>
              </div>
            </form>
          </ul>
        </div>   
      </div>
    </nav>
  </div>
<!-- end home    -->
<!-- slide -->
  
<!-- end slide  -->

    <br>
    <div class="container" id="container">
        <div class="row">
        
          <?php 
            $search_set = find_all_search($_GET['search']);
            $count = mysqli_num_rows($search_set);
            if ($count >= 1) {
              for ($i = 0; $i < $count; $i++):
                  $search = mysqli_fetch_assoc($search_set);
          ?>
                <div class="col-xs-7 col-sm-6 col-md-5 col-lg-4" id="dong1">
                  <br><br>
                    <div class="item">
                    <?php echo $search['img']; ?>
                      <div class="carousel-caption text-center">
                        <h3 id="text"><?php echo $search['name'];  ?></h3>
                      <div><button type="button" class="chitiet btn btn-info"><a href="<?php echo 'details.php?placesID='.$search['placesID']; ?>">Detail</a></div>
                      </div>
                    <br>
                    </div>
                </div>
          <?php
          endfor;
          mysqli_free_result($search_set);
          }else{
            echo "No results found !";
          }
          ?>
          
        </div>
    </div>
    <br>

<!-- Footer -->
<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <h5 class="text-uppercase">TAT Travel Limited Company</h5>
        <p>Head office: 285 Doi Can, Ba Dinh, Ha Noi, Viet Nam</p>
        <p>Email: tattravel2001@gmail.com</p>
        <p>Hotline:0965057556</p>
        <p>International Tour Operator License: 01-1188/2018 TCDL- GP LHQT</p>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
        <h5 class="text-uppercase">About Us</h5>
        <p><a href="introduce.php"><span class="glyphicon glyphicon-chevron-right"></span>Introduce</a></p>
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
<!-- Footer -->
<!-- end đuôi -->

    <script src="bootstrap3/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap3/js/bootstrap.min.js"></script>
</body>
</html>

