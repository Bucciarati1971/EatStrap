<?php
require_once("connMysql.php");
session_start();
//判斷登入
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
	if($_SESSION["memberLevel"]=="member"){
		header("Location: eHome2.php");
	}else{
		header("Location: eHome.php");	
	}
}


//會員登入
if(isset($_POST["username"]) && isset($_POST["passwd"])){
	//繫結登入資料
	$query_RecLogin = "SELECT m_username, m_passwd, m_level FROM memberdata WHERE m_username=?";
	$stmt=$db_link->prepare($query_RecLogin);
	$stmt->bind_param("s", $_POST["username"]);
	$stmt->execute();
	$stmt->bind_result($username, $passwd, $level);	
	$stmt->fetch();
	$stmt->close();
	if(password_verify($_POST["passwd"],$passwd)){
		//計算登入次數及更新登入時間
		$query_RecLoginUpdate = "UPDATE memberdata SET m_login=m_login+1, m_logintime=NOW() WHERE m_username=?";
		$stmt=$db_link->prepare($query_RecLoginUpdate);
	    $stmt->bind_param("s", $username);
	    $stmt->execute();	
	    $stmt->close();
		$_SESSION["loginMember"]=$username;
		$_SESSION["memberLevel"]=$level;
		//使用Cookie記錄登入資料
		if(isset($_POST["rememberme"])&&($_POST["rememberme"]=="true")){
			setcookie("remUser", $_POST["username"], time()+365*24*60);
			setcookie("remPass", $_POST["passwd"], time()+365*24*60);
		}else{
			if(isset($_COOKIE["remUser"])){
				setcookie("remUser", $_POST["username"], time()-100);
				setcookie("remPass", $_POST["passwd"], time()-100);
			}
		}
		if($_SESSION["memberLevel"]=="member"){
			header("Location: eHome2.php");
		}else{
			header("Location: eHome.php");	
		}
	}else{
		header("Location: eHome.php?errMsg=1");
	}
}
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
<div id="bg-image"></div>

<body style="padding-top:80px;">

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand mb-0 h3" href="#">
  <h1 style="font-family: 'Metal Mania', cursive;">
                <img src="img/RNZTXHK4OQS11555957772004.png" width="35" height="35" class="d-inline-block align-top " alt="">
                EatStrap
            </h1>

  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText" >
    <ul class="navbar-nav mr-auto"style="font-family: 'Metal Mania', cursive;">
      <li class="nav-item active">
        <a class="nav-link mb-0 h3" href="eHome.php" >Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link mb-0 h3" href="page1.php">popular <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link mb-0 h3" href="phpboard/board.php">message <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
        <div class="bg-warning  rounded text-cente"> 登入帳號或密碼錯誤！</div>
    <?php }?>

    <div class="">

        <button type="submit" class="btn btn-primary my-2 my-sm-0" name="logBtn" data-toggle="modal" data-target="#exampleModal">
            登入
        </button>

</div>

    </nav>




    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">使用者登入</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container">

                        <fieldset>

                            <!-- Form Name -->
                            <legend></legend>
                    <form class="form-horizontal" action="" method="POST" >

                            <!-- Password input-->
                            <div class="form-group" >
                                <label class="col-md-3 control-label" for="username"></label>
                                <input id="username" name="username" class="form-control input-md"
                                value="<?php if(isset($_COOKIE["remUser"]) && ($_COOKIE["remUser"]!="")) echo $_COOKIE["remUser"];?>" placeholder="帳號">
                            </div>
                            

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="passwd"></label>
                                <input id="passwd" name="passwd" type="password" placeholder="密碼"
                                value="<?php if(isset($_COOKIE["remUser"]) && ($_COOKIE["remUser"]!="")) echo $_COOKIE["remUser"];?>" class="form-control input-md"value="">
                            </div>

                            <!-- Multiple Checkboxes -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="rememberme"></label>
                                <div class="col">
                                    <input type="checkbox" name="rememberme" id="rememberme" value="true">
                                    Remember
                                    <button id="myLog" type="submit" name="myLog" class="btn btn-primary">登入</button>
                                    <a name="registered" class="float-right mb-0 h3" href="registered.php">申請帳號<span class="sr-only">(current)</span></a>
                                </div>
                            </div>

                    </form>


                        </fieldset>
                  </div>
                </div>



            </div>
        </div>
    </div>
    <div class="demo-description">
        <h1 class="demo-description__title">Full Course Dinner</h1>
        <p class="demo-description__">Resize the browser to see the <picture> effect.</p>
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

    

<footer>
    
</footer>

 </body>

</html>