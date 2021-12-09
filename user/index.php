<?php
require_once('database.php');
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
        /* background-image: url("../img/HaLongBay.jpg"); */
      }
       h4 {
        text-align: center;
        color: #666666;
      }
      h1 {
        text-align: center;
        font-weight: bold;
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
          <a class="navbar-brand" id="logo" href="index.php">Historical-Monuments</a>
          <!-- Responsive -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="nav active"><a href="index.php">Home</a></li>
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
  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width:100%;">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
    </ol>
  
    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item">
        <img src="../img/Taj-Mahal-5.jpg" alt="India" style="width:100%;">
        <div class="carousel-caption">
          <h3>Taj Mahal</h3>
          <p>Tomb area crystallizes the characteristics of Islamic art in India</p>
        </div>
      </div> 

      
      <div class="item">
        <img src="../img/ha-long-bay.jpg" alt="Viet Nam" style="width:100%;">
        <div class="carousel-caption">
          <h3>Ha Long Bay</h3>
          <p>One of the seven new natural wonders of The World in Vietnam</p>
        </div>
      </div>

      <div class="item active">
        <img src="../img/Gyeongju.jpg" alt="Korean" style="width:100%;">
        <div class="carousel-caption">
          <h3>Gyeongju Historic Areas</h3>
          <p>Where there are many extremely diverse Buddhist artworks</p>
        </div>
      </div>
    
      <div class="item">
        <img src="../img/horyu.jpg" alt="Japan" style="width:100%;">
        <div class="carousel-caption">
          <h3>Horyuji Temple</h3>
          <p>The largest Buddhist architectural complex in Japan</p>
        </div>
      </div>

      <div class="item">
        <img src="../img/kimtuthap.jpg" alt="India" style="width:100%;">
        <div class="carousel-caption">
          <h3>Pyramid Giza</h3>
          <p>The greatest artificial construction of all time in Egypt</p>
        </div>
      </div>
    </div>
  
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
    
  </div>
<!-- end slide  -->
<!-- tabel -->
  <br>
  <div class="container" id="container">
   
    <!-- <h1 class="titlerow" id="titlep">Historical-Monuments Europe</h1> -->
    <div class="row">
      
        <?php
          $category_set = find_all_category();
          $count = mysqli_num_rows($category_set);
          for ($i = 0; $i < $count; $i++):
              $category = mysqli_fetch_assoc($category_set);
              $id = $category['categoryID'];
              $places_set = find_all_flaces_by_categoryID($id);
              $count2 = mysqli_num_rows($places_set);

              $dem = 0;
              if($count2 >= 3){
                $dem = 3;
              }else{
                $dem = $count2;
              }
              for ($x = 0; $x < $dem; $x++):
                $places = mysqli_fetch_assoc($places_set);
        ?>
       
        <div class="col-xs-7 col-sm-6 col-md-5 col-lg-4" id="dong1">
        <br><br>
          <div class="item">
          <!-- <div class="title">
            <?php
            //  echo $category['namecategory']; 
             ?>
          </div> -->
            <?php echo $places['img']; ?>
              <div class="carousel-caption text-center">
              <h3 id="text"><?php echo $places['name'];  ?></h3>
                <div><button type="button" class="chitiet btn btn-info"><a href="<?php echo 'details.php?placesID='.$places['placesID']; ?>">Detail</a>
                </div>
              </div>
              <br>
          </div>
        </div>
              <?php endfor;
              mysqli_free_result($places_set);
              ?>
      <?php endfor;
      mysqli_free_result($category_set);
      ?>
    </div><br><br>
    <h4>---- We will bring you the most beautiful places in the world ---- </h4>
    

    
  </div>
  <br>
<!-- end table -->
<!-- đuôi -->
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



    <script src="bootstrap3/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap3/js/bootstrap.min.js"></script>
</body>
</html>