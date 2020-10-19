<?php
require_once("connMysql.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: page1.php");
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["memberLevel"]);
	header("Location: page1.php");
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
            <img class="pokemon__img" src="https://s4.postimg.org/fucnrdeq5/pikachu.png" />
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
            <img class="pokemon__img" src="https://s4.postimg.org/sa9dl4825/pilup.png" />
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
            <img class="pokemon__img" src="https://s4.postimg.org/6795hnlql/blaziken.png" />
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
            <img class="pokemon__img" src="https://s4.postimg.org/43yq9zlxp/dialga.png" />
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
            <img class="pokemon__img" src="https://s4.postimg.org/malmhgn9p/zekrom.png" />
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