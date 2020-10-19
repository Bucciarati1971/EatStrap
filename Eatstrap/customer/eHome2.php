<?php
require_once("connMysql.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: eHome.php");
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["memberLevel"]);
	header("Location: eHome.php");
}
//繫結登入會員資料
$query_RecMember = "SELECT * FROM memberdata WHERE m_username = '{$_SESSION["loginMember"]}'";
$RecMember = $db_link->query($query_RecMember);	
$row_RecMember=$RecMember->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="_css/bootstrap.min.css">
    <link rel="stylesheet" href="_css/Full Course Dinner.css">
    <link rel="stylesheet" href="_css/UEO.css">
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">


    <script src="_js/jquery.min.js"></script>
    <script src="_js/popper.min.js"></script>
    <script src="_js/bootstrap.min.js"></script>

    <title>Document</title>
</head>

<body style="padding-top:80px;">

    <!-- <nav class="navbar  bg-light  navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="#">
            <h2 style="font-family: 'Metal Mania', cursive;">
                <img src="img/RNZTXHK4OQS11555957772004.png" width="40" height="40" class="d-inline-block align-top " alt="">
                EatStrap
            </h2>
        </a>
        <div class=" collapse navbar-collapse " id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="page1.php">
                        <h4 style="font-family: 'Metal Mania', cursive;">Popular</h4>
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>


            <li class="nav-item dropdown navbar-text">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="img/pngtree-menu-vector-icon-png-image_3791388.jpg" width="40" height="40" class="d-inline-block align-top " alt="">
                </a>
                <form class=" form-horizontal " method="post" action="">
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                        <div class="form-group">
                            <a class="dropdown-item" href="userRegistered.php">會員中心</a>
                            <div class="dropdown-divider"></div>


                            <a type="submit" id=" logOut" name=" logOut" class="dropdown-item">登出</a>
                        </div>
                    </div>
                </form>
            </li>
        </div>



        </div>


    </nav> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="#">
  <h1 style="font-family: 'Metal Mania', cursive;">
                <img src="img/RNZTXHK4OQS11555957772004.png" width="35" height="35" class="d-inline-block align-top " alt="">
                EatStrap
            </h1>

  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto" style="font-family: 'Metal Mania', cursive;">
      <li class="nav-item active">
        <a class="nav-link mb-0 h3" href="eHome.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link nav-link mb-0 h3" href="page1.php">popular <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link mb-0 h3" href="phpboard/board.php">message <span class="sr-only">(current)</span></a>
      </li>

    </ul>
    <!-- <ul class="navbar-nav mr-auto"> -->
      <form class=" form-horizontal form-inline my-2 my-lg-0" method="post" action="">

      <div class="nav-item active">
      <p class="navbar-brand mb-0 h1"><span ><?php echo $row_RecMember["m_name"];?></span> 歡迎</p>      
      </div>
      <div class="nav-item active">
      <a class="nav-link" href="registered2.php">會員中心</a>
      </div>

      <div class="nav-item active">
      <a type="submit"  class="nav-link" href="?logout=true">登出</a>
      </div>
      </form>
    <!-- </ul> -->
  </div>
</nav>




    <div class="demo-description">
        <h1 class="demo-description__title">Full Course Dinner</h1>
        <p class="demo-description__p">Resize the browser to see the <picture> effect.</p>
    </div>

    <div class="demo coursemeal">

        <!-- APPETIZERS-->
        <div class="coursemeal__div ">

            <picture class="responsive-img">
                <source media="(min-width: 990px)" srcset="https://i.postimg.cc/jSTZmp8H/appetizer-img-1.jpg">
                <source media="(min-width: 765px)" srcset="https://i.postimg.cc/1RTdCYhB/appetizer-img-2.jpg">
                <source srcset="https://i.postimg.cc/TwnctQr7/appetizer-img-3.jpg">
                <img src="https://i.postimg.cc/jSTZmp8H/appetizer-img-1.jpg" alt="Appetizer">
            </picture>

            <div class="coursemeal-info">
                <a href="#" class="coursemeal-info__link">Appetizer</a>
            </div>
        </div>

        <!-- MAIN COURSE-->
        <div class="coursemeal__div">

            <picture class="responsive-img">
                <source media="(min-width: 990px)" srcset="https://i.postimg.cc/V6NCCRK0/maindish-img-1.jpg">
                <source media="(min-width: 765px)" srcset="https://i.postimg.cc/9XYj186s/maindish-img-2.jpg">
                <source srcset="https://i.postimg.cc/pLY8dt4q/maindish-img-3.jpg">
                <img src="https://i.postimg.cc/V6NCCRK0/maindish-img-1.jpg" alt="Main Course">
            </picture>

            <div class="coursemeal-info">
                <a href="http://127.0.0.1:5500/%E5%B0%8F%E5%B0%88/test.html" class="coursemeal-info__link">Main
                    Course</a>
            </div>
        </div>

        <!-- DESSERTS-->
        <div class="coursemeal__div">

            <picture class="responsive-img">
                <source media="(min-width: 990px)" srcset="https://i.postimg.cc/9FfLh6ZZ/dessert-img-1.jpg">
                <source media="(min-width: 765px)" srcset="https://i.postimg.cc/FsRXBnKn/dessert-img-2.jpg">
                <source srcset="https://i.postimg.cc/ZKcFCVFZ/dessert-img-3.jpg">
                <img src="https://i.postimg.cc/ZKcFCVFZ/dessert-img-1.jpg" alt="Desserts">
            </picture>

            <div class="coursemeal-info">
                <a href="#" class="coursemeal-info__link">Dessert</a>
            </div>
        </div>



    </div>




</body>

</html>