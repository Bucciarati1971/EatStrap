<?php
require_once("connMysql.php");
session_start();
//檢查是否經過登入，若有登入則重新導向
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
	//若帳號等級為 member 則導向會員中心
	if($_SESSION["memberLevel"]=="member"){
		header("Location: page2.php");
	//否則則導向管理中心
	}else{
		header("Location: page1.php");	
	}
}
//執行會員登入
if(isset($_POST["username"]) && isset($_POST["passwd"])){
	//繫結登入會員資料
	$query_RecLogin = "SELECT m_username, m_passwd, m_level FROM memberdata WHERE m_username=?";
	$stmt=$db_link->prepare($query_RecLogin);
	$stmt->bind_param("s", $_POST["username"]);
	$stmt->execute();
	$stmt->bind_result($username, $passwd, $level);	
	$stmt->fetch();
	$stmt->close();
	//比對密碼，若登入成功則呈現登入狀態
	if(password_verify($_POST["passwd"],$passwd)){
		//計算登入次數及更新登入時間
		$query_RecLoginUpdate = "UPDATE memberdata SET m_login=m_login+1, m_logintime=NOW() WHERE m_username=?";
		$stmt=$db_link->prepare($query_RecLoginUpdate);
	    $stmt->bind_param("s", $username);
	    $stmt->execute();	
	    $stmt->close();
		//設定登入者的名稱及等級
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
		//若帳號等級為 member 則導向會員中心
		if($_SESSION["memberLevel"]=="member"){
			header("Location: page2.php");
		//否則則導向管理中心
		}else{
			header("Location: page1.php");	
		}
	}else{
		header("Location: page1.php?errMsg=1");
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="_css/bootstrap.min.css">
    <link rel="stylesheet" href="_css/Flex Panel - Flex box .css">
    <link rel="stylesheet" href="_css/UEO.css">
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">


    <script src="_js/jquery.min.js"></script>
    <script src="_js/popper.min.js"></script>
    <script src="_js/bootstrap.min.js"></script>
    <script type="text/javascript" src="_js/mySlider.js"></script>

    <title>Document</title>
</head>
<style></style>

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


        <button type="submit" class="btn btn-primary my-2 my-sm-0" name="logBtn" data-toggle="modal" data-target="#exampleModal">
            登入
        </button>

    </nav>

        <!-- Modal -->
        <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">會員登入</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container">

                    <form class="form-horizontal" action="" method="POST" >
                        <fieldset>

                            <!-- Form Name -->
                            <legend></legend>

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


                        </fieldset>
                    </form>
                  </div>
                </div>



            </div>
        </div>
    </div>


    <div class="slider__warpper">
        <div class="flex__container flex--pikachu flex--active" data-slide="1">
            <div class="flex__item flex__item--left">
                <div class="flex__content">
                    <p class="text--sub">JoJo Gen I</p>
                    <h1 class="text--big">the world</h1>
                    <p class="text--normal">Pikachu is an Electric-type Pokémon introduced in Generation I. Pikachu are
                        small, chubby, and incredibly cute mouse-like Pokémon. They are almost completely covered by
                        yellow fur.</p>
                </div>
                <p class="text__background">Pikachu</p>
            </div>
            <div class="flex__item flex__item--right"></div>
            <img class="pokemon__img" src="img/1543310-XXL.jpg" />
        </div>
        <div class="flex__container flex--piplup animate--start" data-slide="2">
            <div class="flex__item flex__item--left">
                <div class="flex__content">
                    <p class="text--sub">JoJo Gen IV</p>
                    <h1 class="text--big">Piplup</h1>
                    <p class="text--normal">Piplup is the Water-type Starter Pokémon of the Sinnoh region. It was
                        introduced in Generation IV. Piplup has a strong sense of self-esteem. It seldom accepts food
                        that people give because of its pride.</p>
                </div>
                <p class="text__background">Piplup</p>
            </div>
            <div class="flex__item flex__item--right"></div>
            <img class="pokemon__img" src="img/6207.jpg_wh300.jpg" />
        </div>
        <div class="flex__container flex--blaziken animate--start" data-slide="3">
            <div class="flex__item flex__item--left">
                <div class="flex__content">
                    <p class="text--sub">JoJo Gen III</p>
                    <h1 class="text--big">Blaziken</h1>
                    <p class="text--normal">Blaziken is the Fire/Fighting-type Starter Pokémon of the Hoenn region,
                        introduced in Generation III. Blaziken is a large, bipedal, humanoid bird-like Pokémon that
                        resembles a rooster.</p>
                </div>
                <p class="text__background">Blaziken</p>
            </div>
            <div class="flex__item flex__item--right"></div>
            <img class="pokemon__img" src="img/641.jpg" />
        </div>
        <div class="flex__container flex--dialga animate--start" data-slide="4">
            <div class="flex__item flex__item--left">
                <div class="flex__content">
                    <p class="text--sub">JoJo Gen IV</p>
                    <h1 class="text--big">Dialga</h1>
                    <p class="text--normal">Dialga is a Steel/Dragon-type Legendary Pokémon. Dialga is a sauropod-like
                        Pokémon. It is mainly blue with some gray, metallic portions, such as its chest plate, which has
                        a diamond in the center. It also has various, light blue lines all over
                        its body.</p>
                </div>
                <p class="text__background">Dialga</p>
            </div>
            <div class="flex__item flex__item--right"></div>
            <img class="pokemon__img" src="img/d4598952.jpg" />
        </div>
        <div class="flex__container flex--zekrom animate--start" data-slide="5">
            <div class="flex__item flex__item--left">
                <div class="flex__content">
                    <p class="text--sub">JoJo Gen V</p>
                    <h1 class="text--big">Zekrom</h1>
                    <p class="text--normal">Zekrom is a Dragon/Electric-type Legendary Pokémon. It is part of the Tao
                        Trio, along with Reshiram and Kyurem. Zekrom is a large, black draconian Pokémon that seems to
                        share its theme with its counterpart, Reshiram. It has piercing red eyes and
                        dark gray to black skin that seems to be armor-like.</p>
                </div>
                <p class="text__background">Zekrom</p>
            </div>
            <div class="flex__item flex__item--right"></div>
            <img class="pokemon__img" src="img/4572434.jpg" />
        </div>
    </div>

    <div class="slider__navi">
        <a href="#" class="slide-nav active" data-slide="1">pikachu</a>
        <a href="#" class="slide-nav" data-slide="2">piplup</a>
        <a href="#" class="slide-nav" data-slide="3">blaziken</a>
        <a href="#" class="slide-nav" data-slide="4">dialga</a>
        <a href="#" class="slide-nav" data-slide="5">zekrom</a>
    </div>
    <script>
        $('.slide-nav').on('click', function (e) {
            e.preventDefault();
            // get current slide
            var current = $('.flex--active').data('slide'),
                // get button data-slide
                next = $(this).data('slide');

            $('.slide-nav').removeClass('active');
            $(this).addClass('active');

            if (current === next) {
                return false;
            } else {
                $('.slider__warpper').find('.flex__container[data-slide=' + next + ']').addClass('flex--preStart');
                $('.flex--active').addClass('animate--end');
                setTimeout(function () {
                    $('.flex--preStart').removeClass('animate--start flex--preStart').addClass('flex--active');
                    $('.animate--end').addClass('animate--start').removeClass('animate--end flex--active');
                }, 800);
            }
        });
    </script>

</body>

</html>